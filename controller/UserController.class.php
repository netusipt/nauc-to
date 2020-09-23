<?php

declare(strict_types=1);

namespace Controller;

use Exception;
use InvalidArgumentException;
use Model\Impl\Uzivatel;
use Util\EntityDbConnector;

class UzivatelController extends AController
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function zpracuj($parametry)
    {
        $uzivatel = new Uzivatel();
        $dbConnector = new EntityDbConnector($this->container["db"]);

        if ($parametry[0] === "prihlaseni") {
            $this->pohled = "prihlaseni";
            $this->data["prihlasen"] = false;

            if (isset($_POST["odeslat"])) {
                try {
                    $uzivatel = $dbConnector->nacti($uzivatel, "login", $_POST["login"]);
                    if($uzivatel->jeHesloSpravne($_POST["heslo"])) {
                        $this->data["prihlasen"] = true;
                    } else {
                        $this->data["chybaPrihlaseni"] = "Zadal(a) jste chybné jméno nebo heslo";
                    }
                } catch (Exception $e) {
                    $this->data["chybaPrihlaseni"] = "Zadal(a) jste chybné jméno nebo heslo";
                }

            }
        } elseif ($parametry[0] === "registrace") {
            $this->pohled = "registrace";

            if (isset($_POST["odeslat"])) {

                if ($_POST["login"] !== "") {
                    try {
                        $uzivatel->setLogin($_POST["login"]);
                    } catch (InvalidArgumentException $e) {
                        $this->data["chybaLogin"] = $e->getMessage();
                    }
                } else {
                    $this->data["chybaLogin"] = "Zadejte uživatelské jméno";
                }

                if ($_POST["narozeni"] !== "") {
                    try {
                        $uzivatel->setNarozeni($_POST["narozeni"]);
                    } catch (InvalidArgumentException $e) {
                        $this->data["chybaNarozeni"] = $e->getMessage();
                    }
                } else {
                    $this->data["chybaNarozeni"] = "Zadejte datum narození";
                }

                if ($_POST["heslo"] !== "") {
                    try {
                        $uzivatel->setHeslo($_POST["heslo"]);
                    } catch (InvalidArgumentException $e) {
                        $this->data["chybaHeslo"] = $e->getMessage();
                    }
                } else {
                    $this->data["chybaHeslo"] = "Zadejte heslo";
                }

                if ($_POST["hesloZnovu"] !== "") {
                    if (!$uzivatel->jeHesloSpravne($_POST["hesloZnovu"])) {
                        $this->data["chybaHesloZnovu"] = "Heslo se neshoduje";
                    }
                } else {
                    $this->data["chybaHesloZnovu"] = "Zadejte heslo znovu";
                }

                if (!isset($_POST["souhlas"])) {
                    $this->data["chybaSouhlas"] = "Pro úspěšnou registraci je třeba souhlasit s obchodními podmínkami";
                }

                if
                (
                    !isset($this->data["chybaLogin"]) &&
                    !isset($this->data["chybaNarozeni"]) &&
                    !isset($this->data["chybaHeslo"]) &&
                    !isset($this->data["chybaHesloZnovu"]) &&
                    !isset($this->data["chybaSouhlas"])
                )
                {
                    $dbConnector->pridej($uzivatel);
                }
            }
        }
    }
}
