<?php

require("../Header/index.html");
require_once("../Components/headerAddOrEdit.html");
?>

<form style="margin: 20px 0; display: flex; flex-direction: column; gap:10px">
    <input type="hidden" required name="id" id="id" value="<?= $_GET['id'] ?? '' ?>">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" required class="form-control" name="name" id="name" placeholder="Name of the Product">
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" required step="0.01" class="form-control" name="price" id="price" placeholder="Price">
    </div>
    <div class="form-group">
        <label class="form-check-label" for="supplier-id">Supplier</label>
        <select class="form-select" required name="supplier_id" id="supplier-id" aria-label="Default select example">
            <option value="">Select an option</option>
        </select>
    </div>
    <button type="submit" style="margin-top: 10px" class="btn btn-success">Save</button>
</form>


<?php require("../Footer/index.html"); ?>

<script>

    document.addEventListener("DOMContentLoaded", async function (event) {

        const id = document.getElementById("id").value ?? "";
        document.getElementById("page-name").textContent = "Add Product"

        /** Sharing the Suppliers*/
        const suppliers = await renderEdit("Suppliers", ["id", "name", "document", "age", "mail"], null, true);

        if (suppliers != null && suppliers.length > 0) {

            suppliers.forEach((item) => {
                document.getElementById("supplier-id").insertAdjacentHTML('beforeend',
                    `<option value="${item.id}">` +
                    `  ${item.name} - ${item.id}` +
                    ` </option>`
                )
            })
        }

        if (id != "" && id != null) {

            renderEdit("Products", ["id", "name", "price", "supplier_id"], {"id": id});
        }

        document.querySelector("form").addEventListener("submit", (e) => {

            e.preventDefault();

            let data = {
                id: document.getElementById("id").value,
                name: document.getElementById("name").value,
                price: document.getElementById("price").value,
                supplier_id: document.getElementById("supplier-id").value
            }

            addOrEdit('Products', data, {id: id});
        })
    })
</script>
