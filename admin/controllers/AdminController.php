<?php
namespace admin\controllers;

class AdminController{
    public function index() : void{
        require_once __DIR__ . '/../dashboard.php';
    }
}