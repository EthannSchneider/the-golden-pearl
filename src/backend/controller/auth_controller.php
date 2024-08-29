<?php 

require_once "model/user.php";

$entry = [
    "AuthController()" => [
        "POST" => [
            "/api/auth/login" => "login()"
        ],
        "GET" => [
            "/api/auth" => "is_login()",
            "/api/auth/logout" => "logout()"
        ]
    ]
];

class AuthController {
    public function is_login() {
        if(AuthUtils::isAuthenticated()) {
            echo '{"authenticated": true}';
        } else {
            echo '{"authenticated": false}';
        }
    }

    public function login() {
        if(AuthUtils::isAuthenticated()) {
            echo '{"success": true, "message": "Already logged in"}';
            return;
        }

        if(!(isset($_POST['username']) && isset($_POST['password']) && $_POST['username'])) {
            ResponseUtils::badRequest();
            return;
        }

        $user = "";

        try {
            $user = new User($_POST['username']);
        } catch (UserNotExistException) {
            $this->userNotExistException();
            return;
        }

        if (!$user->checkPassword($_POST['password'])) {
            $this->userNotExistException();
            return;
        }

        $_SESSION['username'] = $_POST['username'];

        echo '{"success": true, "message": "Logged in"}';
    }

    public function logout() {
        session_destroy();

        echo '{"success": true, "message": "Logged out"}';
    }

    private function userNotExistException() {
        ResponseUtils::response("User not found", 404);
    }
}