<?php

require("../Header/index.html");
require_once("../Components/headerIndex.html");
?>

<table class="table-model" id="products-table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Supplier</th>
        <th scope="col" class="col-2">Actions</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<?php require("../Footer/index.html"); ?>

<script>

    document.addEventListener("DOMContentLoaded", function (event) {

        renderIndex("Products", "products-table", ["id", "name", "price", "supplier_id"]);
    })
</script>
