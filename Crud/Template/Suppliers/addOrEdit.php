<?php

require("../Header/index.html");
require_once("../Components/headerAddOrEdit.html");
?>

<form style="margin: 20px 0; display: flex; flex-direction: column; gap:10px">
    <input type="hidden" required id="id" value="<?= $_GET['id'] ?? '' ?>">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" required class="form-control" name="name" id="name" placeholder="Name of the Product">
    </div>
    <div class="form-group row">
        <div class="col" style="display: block; margin: 0">
            <label for="document">Document</label>
            <input type="text" max="15" required class="form-control" name="document" id="document"
                   placeholder="CPF or CNPJ">
        </div>
        <div class="col">
            <label for="document">Age</label>
            <input type="number" max="100" min="18" required class="form-control" name="age" id="age">
        </div>
    </div>
    <div class="form-group">
        <label class="form-check-label" for="mail">E-mail</label>
        <input class="form-control" type="mail" required name="mail" id="mail"/>
    </div>
    <button type="submit" style="margin-top: 10px" class="btn btn-success">Save</button>
</form>


<?php require("../Footer/index.html"); ?>

<script>
    document.addEventListener("DOMContentLoaded", async function (event) {

        const id = document.getElementById("id").value ?? "";
        document.getElementById("page-name").textContent = "Add Supplier"

        if (id != "" && id != null) {

            renderEdit("Suppliers", ["id", "name", "document", "age", "mail"], {"id": id});
        }

        document.querySelector("form").addEventListener("submit", (e) => {

            e.preventDefault();

            let data = {
                id: document.getElementById("id").value,
                name: document.getElementById("name").value,
                document: document.getElementById("document").value,
                age: document.getElementById("age").value,
                mail: document.getElementById("mail").value,
            }

            addOrEdit('Suppliers', data, {id: id});
        })

    })
</script>
