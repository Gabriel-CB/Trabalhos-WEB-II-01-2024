<?php

class PDO
{

    private $SERVER_NAME = "localhost";
    private $USER_NAME = "root";
    private $PASSWORD = "";
    private $DB_NAME = "crud";
    private $instance;
    private $table;


    /**
     * Construct function
     */
    public function __construct($table)
    {
        $instance = $this->getInstance();
        require_once ("../Model/$table.php");
        $this->table = new $table();


    }

    /**
     * Create instance with database
     * @return PDO|null
     */
    function getInstance()
    {

        if (empty($instance)) {

            $instance = $this->connection();
        }

        return $instance;
    }

    private function connection()
    {
        try {

            $conn = new PDO("mysql:host=$this->SERVER_NAME;dbname=$this->DB_NAME", $this->USER_NAME, $this->PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {

            echo "Connection creation failed: " . $e->getMessage() . "<br>";
            if (strpos($e->getMessage(), "Unknown database '$this->DB_NAME'")) {
                echo "Conexão nula, criando o banco pela primeira vez" . "<br>";
                $conn = $this->createDB();
                return $conn;
            } else
                die("Connection failed: " . $e->getMessage() . "<br>");
        }
    }

    function createDB()
    {
        try {

            /** @var PDO $instance */
            $instance->beginTransaction();

            $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            $instance->exec($sql);
            return $instance;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function createTable()
    {
        try {

            $instance->exec($table->createTable());
        } catch (PDOException $e) {

            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function insert($values)
    {
        try {

            $sql = $this->table->insert($values);
            $this->instance->exec($sql);
        } catch (PDOException $e) {

            return "Fail when insert register" . "<br>";
        }
    }

    function select($conditions, $fields)
    {

        try {

            $sql = $this->table->select($conditions, $fields);
            $result = $this->instance->query($sql);

            return $result;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function update($sql)
    {

        try {
            $db = $this->getInstance();
            $this->createTable();
            $result = $db->query($sql);

            return $result;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function delete($sql)
    {

        try {
            $db = $this->getInstance();
            $this->createTable();
            $result = $db->query($sql);

            return $result;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}