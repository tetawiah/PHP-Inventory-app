<?php

namespace Middleware;

class Auth {

    public function handle() {
        if (!$_SESSION['logged_in'] ?? false) {
            header('location:/login');
            exit();
        }
    }
}