<?php

class Users
{

    public $TABLE_NAME = "users";


    /**
     * Create Products Table
     *
     * @return void
     */
    public function createTable()
    {

        return "Create table if not exists users (
            id INT (8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR (50) NOT NULL,
            cellphone CHAR (20) NOT NULL,
            mail VARCHAR (100) NOT NULL,
            password  VARCHAR (255) NOT NULL
            );";
    }
}