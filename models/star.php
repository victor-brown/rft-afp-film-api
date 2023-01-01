<?php
class Star
{
    private $connection;

    public $id;
    public $name;
    public $about;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $query = 'SELECT * 
        FROM stars 
        ORDER BY "name" desc';

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $query = 'INSERT IGNORE INTO stars SET name = :name, about = :about';

        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->about = htmlspecialchars(strip_tags($this->about));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':about', $this->about);

        if ($stmt->execute())
            return $this->connection->lastInsertId();

        return -1;
    }

    public function delete()
    {
        try {
            $this->disconnectFromMovies();

            $query = 'DELETE FROM stars WHERE id = :id';
            $stmt = $this->connection->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(':id', $this->id);

            $stmt->execute();


        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }

        return true;
    }

    private function disconnectFromMovies()
    {
        $query = 'DELETE FROM movies_stars WHERE
                    stars_id IN (
                        SELECT id as stars_id FROM stars WHERE id = :stars_id
                    )';
        $stmt = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':stars_id', $this->id);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    public function update()
    {
        $query = 'UPDATE stars SET name = :name, about = :about WHERE id = :id';
        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->about = htmlspecialchars(strip_tags($this->about));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':about', $this->about);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }

        return true;
    }
}