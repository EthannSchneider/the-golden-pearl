<?php 

require "model/databases_connector/sqlite3/sqlite3_access.php";

class DatabasesChoose {
    // static for now but should be in a dynamic config
    private string $databases = "sqlite3"; 
    private string $databasesPath = "database.db";

    public function __construct() {}

    public function getDatabase(): DatabasesAccess {
        switch ($this->databases) {
            default: 
                return new Sqlite3Access($this->databasesPath);
        }
    }
}