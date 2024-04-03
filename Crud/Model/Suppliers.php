<?php

class Suppliers
{

    public $TABLE_NAME = "suppliers";

    /**
     * Create Suppliers Table
     *
     * @return void
     */
    public function createTable()
    {

        return "CREATE TABLE if not exists suppliers (
                    id INT (8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR (50) NOT NULL,
                    document VARCHAR (15) NOT NULL,
                    mail DECIMAL (10) NOT NULL,
                    age INT (3) NOT NULL
                    );";
    }
}