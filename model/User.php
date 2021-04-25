<?php
class User {

    private $connection;
    public function __construct(mysqli $connection) {
        $this->connection = $connection;
    }

    public function getAllUsers() {

        $sql = 'SELECT * FROM users';
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

    //get user by email
    public function getUserByEmail(string $userEmail) {

        $sql = 'SELECT *
                FROM users
                WHERE email = ? ';


        $statement = $this->connection->prepare($sql);
        $statement->bind_param('i', $userEmail);
        $statement->execute();
        $result = $statement->get_result();
        // Fetch the data into a stdClass object.
        $row = $result->fetch_object();
        return $row;
    }
    //get user by email and PASSWORD
    public function getUserByEmailPass(string $userEmail, string $password) {

        $sql = 'SELECT *
                FROM users
                WHERE email = ?
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
    public function registerUser($user) {
        $sql = 'INSERT INTO users (firstName, lastName, email, gender, uname, password, recoveryEmail, type)
                VALUES (? ,? ,?, ?, ?, ?, ?, ?)';
        //$sql = 'INSERT INTO users (firstName, lastName, email, gender, uname, password, recoveryEmail, type)
                //VALUES ('$user["fname"]' ,'$user['lname']', '$user['email']', '$user['gender']', '$user['uname']','$user['password']', '$user['rEmail']', '$user['type']')';
        $statement = $this->connection->prepare($sql);
        $statement->bind_param('iiiiiiii', $user['fname'] ,$user['lname'], $user['email'], $user['gender'], $user['uname'], $user['password'], $user['rEmail'], $user['type']);
        //$statement->bind_param('i', $password);
        //$statement->bind_param(2, $password,  PDO::PARAM_STR, 12);
        //$dbh->beginTransaction();
        //$tmt->execute( array('user', 'user@example.com'));
        //$dbh->commit();
        //$result = $statement->get_result();
        //var_dump($user);
        //print_r($user['fname']);
        //echo $user['lname'];
        if ($statement->execute() === TRUE)
        {
          return 1;
        }
    }
} ?>
