<?php

require("../Header/index.html");
require_once("../Components/headerIndex.html");
?>

<table class="table-model" id="carts-table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Product</th>
        <th scope="col" class="col-2">Actions</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<?php require("../Footer/index.html"); ?>

<script>

    document.addEventListener("DOMContentLoaded", async function (event) {

        document.getElementById("add-btn").style.display = 'none';
        let user = await JSON.parse(localStorage.getItem('user'));

        if (user.id == null || user.id == undefined) {

            logout()
        } else {

            renderIndex("Carts", "carts-table", ["id", "product_id"], {user_id: user.id});
        }
    })
</script>
