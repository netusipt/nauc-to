<?php
declare(strict_types = 1);

use model\User;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    public function setEmailTest() {
        $user = new User();

        try {
            $user->setEmail("example@example.com");
        } catch(InvalidArgumentException $e) {
            
        }

        $this->assertEquals("example@example.com", $user->email);
    }
}