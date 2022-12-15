<?php
class Star
{
    private $conn;
    public $id;
    public $name;
    public $about;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function read()
    {
        $query = 'SELECT * 
        FROM stars 
        ORDER BY "name" desc';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

