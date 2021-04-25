<?php
class Book {

    private $connection;
    public function __construct(mysqli $connection) {
        $this->connection = $connection;
    }

    public function getAllBooks() {

        $sql = 'SELECT * FROM book';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        // Fetch the data into a stdClass[] array.
        $rows = [];
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        return $rows;
    }

    //get book by id
    public function getBookById(int $id) {

        $sql = 'SELECT *
                FROM book
                WHERE id = ?
                LIMIT 1';

        $statement = $this->connection->prepare($sql);
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();
        // Fetch the data into a stdClass object.
        $row = $result->fetch_object();
        return $row;
    }

    public function getBookByName(string $name) {

        $sql = 'SELECT *
                FROM book
                WHERE bname = ? ';

        $statement = $this->connection->prepare($sql);
        $statement->bind_param('i', $name);
        $statement->execute();
        $result = $statement->get_result();
        // Fetch the data into a stdClass object.
        $row = $result->fetch_object();
        return $row;
    }
    //get user by email and PASSWORD
    public function editBook(int $id) {

        $sql = 'SELECT *
                FROM book
                WHERE id = ?
                AND password = ?
                LIMIT 1';

        $statement = $this->connection->prepare($sql);
        $statement->bind_param('ii', $userEmail,$password);
        //$statement->bind_param('i', $password);
        //$statement->bind_param(2, $password,  PDO::PARAM_STR, 12);
        $statement->execute();
        $result = $statement->get_result();
        // Fetch the data into a stdClass object.
        $row = $result->fetch_object();
        return $row;
    }
} ?>
