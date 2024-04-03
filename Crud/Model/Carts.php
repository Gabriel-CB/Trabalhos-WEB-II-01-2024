<?php
require_once("../Model/Users.php");
require_once("../Model/Products.php");

class Carts
{

    public $TABLE_NAME = "carts";

    /**
     * Create Products Table
     *
     * @return void
     */
    public function createTable()
    {

        $users = new Users();
        $products = new Products();

        return "{$users->createTable()}" .
            "{$products->createTable()}" .
            "   
               CREATE TABLE IF NOT EXISTS carts (
                id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                product_id INT(8) UNSIGNED NOT NULL,
                user_id INT(8) UNSIGNED NOT NULL,
                FOREIGN KEY (product_id) REFERENCES products(id),
                FOREIGN KEY (user_id) REFERENCES users(id)
                );";
    }
}