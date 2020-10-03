<?php

declare(strict_types=1);

namespace controller;

use Exception;
use InvalidArgumentException;
use model\User;
use util\db\EntityDbConnector;

class UserController extends AController
{

    public function process($parametry)
    {
        $user = new User();
        $dbConnector = new EntityDbConnector();

        if ($parametry[0] === "login") {
            $this->view = "login";
            $this->data["loged"] = false;

            if (isset($_POST["submit"])) {
                try {
                    $user = $dbConnector->load($user, "email", $_POST["email"]);
                    if($user->isPasswordCorrect($_POST["password"])) {
                        $_SESSION["loggedIn"] = true;
                        $_SESSION["firstName"] = $user->firstName;
                        $this->redirect();
                    } else {
                        $this->data["loginEx"] = "Zadal(a) jste chybné jméno nebo heslo";
                    }
                } catch (Exception $e) {
                    $this->data["loginEx"] = "Zadal(a) jste chybné jméno nebo heslo";
                }

            }
        } elseif ($parametry[0] === "registration") {
            $this->view = "registration";

            if (isset($_POST["submit"])) {

                if ($_POST["firstName"] !== "") {
                    try {
                        $user->setFirstName($_POST["firstName"]);
                    } catch (InvalidArgumentException $e) {
                        $this->data["firstNameEx"] = $e->getMessage();
                    }
                } else {
                    $this->data["firstNameEx"] = "Zadejte jmeno";
                }

                if ($_POST["email"] !== "") {
                    try {
                        $user->setEmail($_POST["email"]);
                    } catch (InvalidArgumentException $e) {
                        $this->data["emailEx"] = $e->getMessage();
                    }
                } else {
                    $this->data["emailEx"] = "Zadejte e-mail";
                }

                if ($_POST["password"] !== "") {
                    try {
                        $user->setPassword($_POST["password"]);
                    } catch (InvalidArgumentException $e) {
                        $this->data["passwordEx"] = $e->getMessage();
                    }
                } else {
                    $this->data["passwordEx"] = "Zadejte heslo";
                }

                if ($_POST["passwordAgain"] !== "") {
                    if ($_POST["password"] != $_POST["passwordAgain"]) {
                        $this->data["passwordAgainEx"] = "Heslo se neshoduje";
                    }
                } else {
                    $this->data["passwordAgainEx"] = "Zadejte heslo znovu";
                }

                if (!isset($_POST["conditions"])) {
                    $this->data["conditionsEx"] = "Pro úspěšnou registraci je třeba souhlasit s obchodními podmínkami";
                }

                if
                (
                    !isset($this->data["emailEx"]) &&
                    !isset($this->data["passwordEx"]) &&
                    !isset($this->data["passwordAgainEx"]) &&
                    !isset($this->data["conditionsEx"])
                )
                {
                    $dbConnector->insert($user);
                }
            }
        } elseif ($parametry[0] === "logout") {
            session_destroy();
            $this->redirect();
        } else {
            $this->view = "error";
        }
    }
}
