<?php 
class Sqlite3Connector {
    private SQLite3 $__sqlite3;
    public function __construct(string $dbPath) {
        $this->__sqlite3 = new SQLite3($dbPath);
    }

    public function modify(string $query, array $params = []) {
        $qry = $this->__sqlite3->prepare($query);

        if (!$qry) {
            return [];
        }

        foreach ($params as $key => $value) {
            $qry->bindValue($key, $value);
        }

        if (!$qry) {
            throw new Exception("Query failed: " . $this->__sqlite3->lastErrorMsg());
        }
        $qry->execute();
    }

    public function get(string $query, array $params = []) 
    {
        $qry = $this->__sqlite3->prepare($query);

        if (!$qry) {
            return [];
        }

        foreach ($params as $key => $value) {
            $qry->bindValue($key, $value);
        }

        if (!$qry) {
            throw new Exception("Query failed: " . $this->__sqlite3->lastErrorMsg());
        }

        $result = $qry->execute();

        $rows = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }
        return $rows;
    }
}