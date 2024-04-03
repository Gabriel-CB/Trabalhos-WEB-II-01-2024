<?php

require("../Header/index.html");
require_once("../Components/headerIndex.html");
?>

<table class="table-model" id="supplier-table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Document</th>
        <th scope="col">E-mail</th>
        <th scope="col">age</th>
        <th scope="col" class="col-2">Actions</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<?php require("../Footer/index.html"); ?>

<script>

    document.addEventListener("DOMContentLoaded", function (event) {

        renderIndex("Suppliers", "supplier-table", ['id','name', 'document', 'mail', 'age'], );
    })
</script>
