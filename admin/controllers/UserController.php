<?php
namespace admin\controllers;

use admin\models\User;

require_once __DIR__ . '/../models/User.php';

class UserController {
    public function index(): void {
        $u = new User();
        $users = $u->getAllUsers();
        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/users/list.php';
    }

    public function create(): void {
        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/users/create.php';
    }

    public function store(): void {
        $u = new User();
        $u->setUsername($_POST['username'] ?? null);
        $u->setEmail($_POST['email'] ?? null);
        $u->setPassword($_POST['password'] ?? null);
        $u->setRol($_POST['rol'] ?? 0);

        $u->save();
        header('Location: /index.php?controller=game&action=index');
        exit;
    }

    public function update(): void {
        $id = $_POST['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        $u = new User($id);
        $u->setUsername($_POST['username'] ?? null);
        $u->setEmail($_POST['email'] ?? null);
        $u->setPassword($_POST['password'] ?? null);
        $u->setRol($_POST['rol'] ?? 0);
        $u->save();

        header('Location: /index.php?controller=user&action=index');
        exit;
    }

    public function edit(): void {
        $id = $_GET['id'] ?? null;
        if (!$id) throw new \InvalidArgumentException("No se proporcionó ID");

        $userModel = new User();
        $user = $userModel->find((int)$id);
        if (!$user) throw new \RuntimeException("Usuario no encontrado");

        require __DIR__ . '/../dashboard.php';
        require __DIR__ . '/../views/users/edit.php';
    }


    public function delete(): void {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            throw new \InvalidArgumentException("No se proporcionó ID");
        }

        $u = new User($id);
        $u->delete($id);

        header('Location: /index.php?controller=user&action=index');
        exit;
    }
}
