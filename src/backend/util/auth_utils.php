<?php

class AuthUtils {
    public static function isAuthenticated(): bool {
        if (isset($_SESSION['username'])) {
            return true;
        } else {
            return false;
        }
    }
}