<?php


class Products
{

    public $TABLENAME = "produtos";


    /**
     * Create Products Table
     *
     * @return void
     */
    public function createTable()
    {

        return "Create table if not exists pessoa (
            id INT (8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR (50) NOT NULL,
            sexo CHAR (1) NOT NULL,
            celular CHAR (10) NOT NULL,
            logradouro VARCHAR (50) NOT NULL,
            number CHAR (5) NOT NULL,
            e_mail VARCHAR (50) NOT NULL,
            password  VARCHAR (255) NOT NULL
            )";
    }

    /**
     * @param Array $values values of register
     * @return void
     */
    public function insert($values)
    {

        $fields = "";
        $values = "";
        $sql = "INSERT INTO pessoas (";

        foreach ($values as $field => $value) {

            $fields += $field;
            $values += $values;
        }

        $sql += "$fields) VALUES($values);";

        return $sql;

    }

    /**
     * @param $conditions
     * @param
     * @return void
     */
    public function select($conditions, $fields = null)
    {
        $fieldsFormated = "*";
        $conditionsFormated = "";

        if (!empty($fields)) {

            foreach ($fields as $index => $field) {

                $fieldsFormated += "$field";

                if (count($fields) < $index) {

                    $fieldsFormated += "$field, ";
                }
            }
        }

        foreach ($conditions as $condition) {

            $conditionsFormated += "$condition";
        }

        $sql = "SELECT $fields from pessoas WHERE $conditionsFormated";

        return $sql;
    }

    /**
     * Update an register
     *
     * @param Array $values values to update
     * @param Array $conditions condition to update
     * @return void
     */
    public function update($values, $conditions)
    {

    }

    /**
     * Delete an register
     *
     * @param Integer $id product id
     * @return void
     */
    public function delete($id)
    {

    }
}