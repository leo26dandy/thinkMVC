<?php 
class Database {
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbHandler, $stmt, $error;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ); 

        try {
            $this->dbHandler = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            //throw $exception
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Statement the query
    public function query($sql)
    {
        $this->stmt = $this->dbHandler->prepare($sql);
    }

    // Bind the Value
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result in array of object form
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record 
    public function singleRecord()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Display Row Data
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}

?>