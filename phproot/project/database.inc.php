<?php

class Database {
    private $host;
    private $userName;
    private $password;
    private $database;
    private $conn;

    /**
     * Constructs a database object for the specified user.
     */
    public function __construct($host, $userName, $password, $database) {
        $this->host = $host;
        $this->userName = $userName;
        $this->password = $password;
        $this->database = $database;
    }

    /** 
     * Opens a connection to the database, using the earlier specified user
     * name and password.
     *
     * @return true if the connection succeeded, false if the connection 
     * couldn't be opened or the supplied user name and password were not 
     * recognized.
     */
    public function openConnection() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", 
                $this->userName,  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = "Connection error: " . $e->getMessage();
            print $error . "<p>";
            unset($this->conn);
            return false;
        }
        return true;
    }

    /**
     * Closes the connection to the database.
     */
    public function closeConnection() {
        $this->conn = null;
        unset($this->conn);
    }

    /**
     * Checks if the connection to the database has been established.
     *
     * @return true if the connection has been established
     */
    public function isConnected() {
        return isset($this->conn);
    }

    /**
     * Execute a database query (select).
     *
     * @param $query The query string (SQL), with ? placeholders for parameters
     * @param $param Array with parameters 
     * @return The result set
     */
    private function executeQuery($query, $param = null) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($param);
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            $error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
            die($error);
        }
        return $result;
    }

    /**
     * Execute a database update (insert/delete/update).
     *
     * @param $query The query string (SQL), with ? placeholders for parameters
     * @param $param Array with parameters 
     * @return The number of affected rows
     */
    private function executeUpdate($query, $param = null) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($param);
        } catch (PDOException $e) {
            $error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
            die($error);
        }
    }

    /**
     * Fetchets the recipe from the database. User provides name of recipe
     * 
     *
     * @param name Name of the recipe
     * @return list of ingridents
     */
    public function getRecipe($name) {
        $sql = 'select ingredientName, amount from ingredient where cookieName = ?';
        $result = $this->executeQuery($sql, array($name));
        return $result; 
    }

    public function getCookies() {
        $sql = 'select name from cookieType';
        $result = $this->executeQuery($sql);
        $array = array();
        foreach ($result as $row)
            $array[] = $row['name'];
        return $array;
    }

    /**
     * Return list of moviename
     *
     *
     *  
     * @return array of movies
     */
    public function getMovieNames() {
        $sql = "select name from movies";
        $result = $this->executeQuery($sql);
        $tempArray = array();
        foreach($result as $row){
            $tempArray[] = $row[0];
        }
        return $tempArray; 
    }

    public function getMovieDates($movieName) {
        $sql = "select date from performances where moviename = ?";
        $result = $this->executeQuery($sql,array($movieName));
        $tempArray = array();
        foreach($result as $row){
            $tempArray[] = $row["date"];
        }
        return $tempArray; 
    }

    public function getMovieData($movieName, $movieDate) {
        $sql = "select theatreName, (theatres.seats - performances.takenSeats) as freeSeats ".
            "from performances join theatres on ".
            "performances.theatreName = theatres.name where performances.movieName = ? ".
            "and performances.date = ?";
        $result = $this->executeQuery($sql,array($movieName, $movieDate));
        return $result[0]; 
    }


    public function bookTicket($movieName, $movieDate, $userName) {
        $this->conn->beginTransaction();
        if ($this->addReservation($movieName, $movieDate, $userName)) {
            $this->updateSeats($movieName, $movieDate);
            $this->conn->commit();
            return $this->getNumber();
        } else {
            $this->conn->rollback();
            return "nooooooooooooooooooooooo";
        }
    }

    public function updateSeats($movieName, $movieDate) {
        $sql = "update performances set takenSeats = takenSeats + 1 where ".
            "movieName = ? and date = ?";
        $this->executeUpdate($sql,array($movieName, $movieDate));
    }


    public function addReservation($movieName, $movieDate, $userName) {
        $sql = "select (theatres.seats - performances.takenSeats) as freeSeats ".
            "from performances join theatres on ".
            "performances.theatreName = theatres.name where performances.movieName = ? ".
            "and performances.date = ? for update";
        $igetcheezburger = $this->executeQuery($sql, array($movieName, $movieDate));

        $sql = "insert into reservations (movieName, date, username) ".
            "values (?, ?, ?)";
        $this->executeUpdate($sql,array($movieName, $movieDate, $userName));

        return $igetcheezburger[0][0] > 0;
    }

    public function getNumber() {
        $sql = "select last_insert_id()";
        $result = $this->executeQuery($sql);
        return $result[0][0];
    }
}

// ini_set('display_errors', 'On');        
// error_reporting(E_ALL | E_STRICT);

require_once('mysql_connect_data.inc.php');

$db = new Database($host, $userName, $password, $database);
$db->openConnection();

if (!$db->isConnected()) {
        exit();
}

?>
