<?php
require_once("../Model/Suppliers.php");

class Products
{

    public $TABLE_NAME = "products";


    /**
     * Create Products Table
     *
     * @return void
     */
    public function createTable()
    {

        $suppliers = new Suppliers();
        return "{$suppliers->createTable()}" .
            "   
                CREATE TABLE if not exists products (
                id INT (8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR (50) NOT NULL,
                price DECIMAL (10) NOT NULL,
                supplier_id INT (8) NOT NULL,
                FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
                );";
    }
}