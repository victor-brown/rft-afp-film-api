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


    public function isValid($key)
    {
        $query = 'SELECT * 
        FROM api_keys WHERE api_key = :api_key LIMIT 0,1';

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':api_key', $key);


        try {
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->api_key = $row['api_key'];
            $this->valid_until = $row['valid_until'];
        } catch (\Throwable $th) {
            return false;
        }

        if (strtotime($this->valid_until) > strtotime(date('Y-m-d'))) {
            return true;
        }

        return false;
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

    public function authenticate($headers)
    {
        foreach ($headers as $header => $value) {
            if ($header == "X-Api-Key") {
                if ($this->isValid($value)) {
                    return true;
                }

                http_response_code(401);
                echo json_encode(array('message' => 'Unathorized'));
                return false;
            }
        }
    }
}