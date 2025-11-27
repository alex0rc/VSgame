<?php
namespace admin\validators;

use admin\models\User;

class UserValidator
{
    private function noSpacesOrSlashes(string $str): bool {
        return !preg_match('/\s|\/|\\\\/', $str);
    }

    public function validateId(?int $id): bool {
        return $id === null || $id > 0;
    }

    public function validateUsername(string $username): bool {
        if (!$this->noSpacesOrSlashes($username)) return false;

        if (strlen($username) < 3 || strlen($username) > 30) return false;

        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) return false;

        return true;
    }

    public function validateEmail(string $email): bool {
        if (!$this->noSpacesOrSlashes($email)) return false;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;

        if (strlen($email) > 120) return false;

        return true;
    }

    public function validatePassword(string $password): bool {
        if (!$this->noSpacesOrSlashes($password)) return false;

        if (strlen($password) < 6) return false;

        return true;
    }

    public function validateRol(?int $rol): bool {
        if ($rol === null) return true;
        return in_array($rol, [0, 1], true);
    }

    public function validateUser(User $user): bool {
        return
            $this->validateId($user->getId()) &&
            $this->validateUsername($user->getUsername()) &&
            $this->validateEmail($user->getEmail()) &&
            $this->validatePassword($user->getPassword()) &&
            $this->validateRol($user->getRol());
    }
}
