<?php
class Movie
{
    private $connection;

    public $id;
    public $title;
    public $year;
    public $image_url;
    public $certificate;
    public $runtime;
    public $imdb_rating;
    public $description;

    public $directors;
    public $stars;
    public $genres;


    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $query = 'SELECT * 
        FROM movies 
        ORDER BY title asc';

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readSingle()
    {
        $query = 'SELECT * 
        FROM movies 
        WHERE id = :id
        ORDER BY title asc';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        //TODO: return genres,stars,directors

        return $movie;
    }

    public function create()
    {
        $query = 'INSERT IGNORE INTO movies 
                    SET title = :title, 
                        year = :year, 
                        image_url = :image_url,
                        certificate = :certificate, 
                        runtime = :runtime, 
                        imdb_rating = :imdb_rating, 
                        description = :description';

        $stmt = $this->connection->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->certificate = htmlspecialchars(strip_tags($this->certificate));
        $this->runtime = htmlspecialchars(strip_tags($this->runtime));
        $this->imdb_rating = htmlspecialchars(strip_tags($this->imdb_rating));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':certificate', $this->certificate);
        $stmt->bindParam(':runtime', $this->runtime);
        $stmt->bindParam(':imdb_rating', $this->imdb_rating);
        $stmt->bindParam(':description', $this->description);

        try {
            $stmt->execute();
            $this->id = $this->connection->lastInsertId();

            $i = 0;
            foreach ($this->directors as $director) {
                $this->connectWithDirectors($director);
                $i++;
            }

            $i = 0;
            foreach ($this->stars as $star) {
                $this->connectWithStars($star);
                $i++;
            }

            $i = 0;
            foreach ($this->genres as $genre) {
                $this->connectWithGenres($genre);
                $i++;
            }

        } catch (\Throwable $th) {
            echo $th->getMessage();
            return;
        }


        return $this->id;
    }

    private function connectWithDirectors($directors_id)
    {
        $query = 'INSERT IGNORE INTO movies_directors
                    SET movies_id = :movies_id,
                        directors_id = :directors_id';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':movies_id', $this->id);
        $stmt->bindParam(':directors_id', $directors_id);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return;
        }

    }

    private function connectWithStars($star_id)
    {
        $query = 'INSERT IGNORE INTO movies_stars
                    SET movies_id = :movies_id,
                        stars_id = :stars_id';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':movies_id', $this->id);
        $stmt->bindParam(':stars_id', $star_id);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return;
        }

    }

    private function connectWithGenres($genre_id)
    {
        $query = 'INSERT IGNORE INTO movies_genres
                    SET movies_id = :movies_id,
                        genres_id = :genres_id';

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(':movies_id', $this->id);
        $stmt->bindParam(':genres_id', $genre_id);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return;
        }

    }

    public function delete()
    {
        try {
            $this->disconnect("movies_directors");
            $this->disconnect("movies_stars");
            $this->disconnect("movies_genres");

            $query = 'DELETE FROM movies WHERE id = :id';
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

    private function disconnect($table)
    {
        $query = 'DELETE FROM ' . $table . ' WHERE
                    movies_id = :movies_id';
        $stmt = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':movies_id', $this->id);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    public function update()
    {
        $query = 'UPDATE movies 
                    SET title = :title, 
                        year = :year, 
                        image_url = :image_url,
                        certificate = :certificate, 
                        runtime = :runtime, 
                        imdb_rating = :imdb_rating, 
                        description = :description
                        WHERE id = :id';

        $stmt = $this->connection->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->certificate = htmlspecialchars(strip_tags($this->certificate));
        $this->runtime = htmlspecialchars(strip_tags($this->runtime));
        $this->imdb_rating = htmlspecialchars(strip_tags($this->imdb_rating));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':certificate', $this->certificate);
        $stmt->bindParam(':runtime', $this->runtime);
        $stmt->bindParam(':imdb_rating', $this->imdb_rating);
        $stmt->bindParam(':description', $this->description);

        try {
            $stmt->execute();
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }

        return true;
    }
}