<?php
class Genre
{
    private $connection;

    public $id;
    public $name;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $query = 'SELECT * 
        FROM genres 
        ORDER BY "name" desc';

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $query = 'INSERT IGNORE INTO genres SET name = :name';

        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(':name', $this->name);

        if ($stmt->execute())
            return $this->connection->lastInsertId();

        return -1;
    }

    public function delete()
    {
        try {
            $this->disconnectFromMovies();

            $query = 'DELETE FROM genres WHERE id = :id';
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
        $query = 'DELETE FROM movies_genres WHERE
                    genres_id IN (
                        SELECT id as genres_id FROM genres WHERE id = :genres_id
                    )';
        $stmt = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':genres_id', $this->id);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    public function update()
    {
        $query = 'UPDATE genres SET name = :name WHERE id = :id';
        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }

        return true;
    }
}