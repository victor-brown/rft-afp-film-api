<?php
class ApiKey
{
    private $connection;

    public $id;
    public $api_key;
    public $valid_until;

    public function __construct($db)
    {
        $this->connection = $db;
    }
    public function create()
    {
        $query = 'INSERT INTO api_keys SET api_key = :api_key, valid_until = :valid_until';

        $stmt = $this->connection->prepare($query);

        $this->api_key = uniqid();

        $this->valid_until = date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d'))));


        $stmt->bindParam(':api_key', $this->api_key);
        $stmt->bindParam(':valid_until', $this->valid_until);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            return false;
        }

        return json_encode(array("API_KEY" => $this->api_key, "valid" => $this->valid_until));

    }
}