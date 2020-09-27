<?php
declare(strict_types = 1);

namespace model;

use InvalidArgumentException;

class User {

    private int $id;
    private string $table;

    private string $email;
    private string $password;
    private string $firstName;
    private string $lastName;

    public function __construct()
    {
        $this->table = "users";
    }

    public function isPasswordCorrect($password): bool
    {
        return password_verify($password, $this->password);
    }

    public function getPropertyNames(): array
    {
        return array_keys($this->getProperities());
    }

    public function getProperities(): array
    {
        $atributy = get_object_vars($this);
        unset($atributy["table"]);
        return $atributy;
    }

    public function __get($atribut)
    {
        return $this->$atribut;
    }

    public function setEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new InvalidArgumentException("Nevalidní email");
        }
    }

    public function setPassword($password, $heshovane = false)
    {
        if (!$heshovane) {
            if (preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/", $password)) {
                $this->password = password_hash($password, PASSWORD_BCRYPT);
            } else {
                throw new InvalidArgumentException("Heslo musí obsahovat malá písmena, velká písmena a čísla.");
            }
        } else {
            $this->password = $password;
        }
    }


    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
}