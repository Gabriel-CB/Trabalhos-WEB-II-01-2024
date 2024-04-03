<?php

class PdoAdapter
{

    private $SERVER_NAME = "localhost";
    private $USER_NAME = "root";
    private $PASSWORD = "";
    private $DB_NAME = "crud";
    /** @var PDO $this ->instance */
    private $instance;
    private $table;


    /**
     * Construct function
     * @param String $table
     */
    public function __construct($table)
    {

        $this->instance = $this->getInstance();
        require_once("../Model/$table.php");
        $this->table = new $table();
        $this->createTable();
    }

    /**
     * Create instance with database
     * @return PdoAdapter|null
     */
    function getInstance()
    {
        try {
            if (empty($instance)) {

                $instance = $this->connection();
            }

            return $instance;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
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

                echo "Connection null, creating DB for the first time" . "<br>";
                $conn = $this->createDB();
                return $conn;
            }
        }
    }

    function createDB()
    {
        try {

            $con = new PDO("mysql:host=$this->SERVER_NAME", $this->USER_NAME, $this->PASSWORD);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "CREATE DATABASE IF NOT EXISTS $this->DB_NAME";
            $con->exec($sql);

            return $con;
        } catch (PDOException $e) {

            die("Fail when try create database: $e->getMessage()");
        }
    }

    function createTable()
    {
        try {

            $this->instance->exec($this->table->createTable());
        } catch (PDOException $e) {

            die("Fail when try create table: {$e->getMessage()}");
        }
    }

    function insert($data)
    {
        try {
            $fields = "";
            $values = "";

            $sql = "INSERT INTO {$this->table->TABLE_NAME} (";

            foreach ($data as $field => $value) {

                if (!empty($value)) {

                    $fields .= "$field, ";
                    $values .= "'$value', ";
                }
            }

            $fields = substr($fields, 0, -2);
            $values = substr($values, 0, -2);
            $sql .= "$fields) VALUES($values);";

            $this->instance->exec($sql);
            return ["success" => true, "data" => $data];
        } catch (PDOException $e) {

            throw new Exception("Fail when try insert register: {$e->getMessage()}");
        }
    }

    function select($fields = null, $conditions = null)
    {

        try {

            $fieldsFormated = "";
            $conditionsFormated = "";

            if (!empty($fields)) {

                foreach ($fields as $index => $field) {

                    $fieldsFormated .= "$field, ";
                }

                $fieldsFormated = substr($fieldsFormated, 0, -2);

            } else {

                $fieldsFormated = "*";
            }

            if (!empty($conditions)) {

                $conditionsFormated = "WHERE ";
                foreach ($conditions as $field => $condition) {

                    $conditionsFormated .= "$field = '$condition' AND ";
                }

                $conditionsFormated = substr($conditionsFormated, 0, -4);
            }

            $sql = "SELECT $fieldsFormated from {$this->table->TABLE_NAME} $conditionsFormated";
            $result = $this->instance->query($sql);

            return ["success" => true, "data" => $result->fetchAll()];
        } catch (PDOException $e) {

            throw new Exception("Fail when try select register: {$e->getMessage()}");
        }
    }

    function update($values, $conditions)
    {

        try {

            $fieldsFormated = "";
            $conditionsFormated = "";


            foreach ($values as $index => $field) {

                $fieldsFormated .= "$index = '$field', ";
            }

            $fieldsFormated = substr($fieldsFormated, 0, -2);

            if (!empty($conditions)) {

                $conditionsFormated = "WHERE ";
                foreach ($conditions as $field => $condition) {

                    $conditionsFormated .= "$field = '$condition' AND ";
                }

                $conditionsFormated = substr($conditionsFormated, 0, -4);
            }


            $sql = "UPDATE {$this->table->TABLE_NAME} SET $fieldsFormated $conditionsFormated";

            $this->instance->query($sql);

            return ["success" => true];
        } catch (PDOException $e) {


            throw new Exception("Fail when try update register: {$e->getMessage()}");
        }
    }

    function delete($conditions)
    {

        try {

            $conditionsFormated = "";

            if (!empty($conditions)) {

                $conditionsFormated = "WHERE ";
                foreach ($conditions as $index => $field) {

                    $conditionsFormated .= "$index = $field AND ";
                }

                $conditionsFormated = substr($conditionsFormated, 0, -4);
            }

            $sql = "DELETE FROM {$this->table->TABLE_NAME} $conditionsFormated";

            $this->instance->query($sql);

            return ["success" => true];
        } catch (PDOException $e) {

            throw new Exception("Fail when try delete register: {$e->getMessage()}");
        }
    }
}