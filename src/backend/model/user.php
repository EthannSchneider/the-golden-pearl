<?php 

require_once "model/databases_connector/databases_choose.php";
require_once "exception/user_not_exist_exception.php";

class User {
    private DatabasesAccess $db;
    private string $username;

    public function __construct(string $username) {
        $databaseChoose = new DatabasesChoose();
        $this->db = $databaseChoose->getDatabase();

        if(!$this->db->isUserExist($username)) {
            throw new UserNotExistException();
        }

        $this->username = $username;
    }

    public function getUsername() : string {
        return $this->username;
    }

    public function checkPassword(string $password): bool {
        return $this->db->isUserPasswordCorrect($this->username, $password);
    }
}