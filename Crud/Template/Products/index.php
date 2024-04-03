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

    document.addEventListener("DOMContentLoaded", async function (event) {

        await renderIndex("Products", "products-table", ["id", "name", "price", "supplier_id"]);

        document.querySelector('.option').addEventListener("change", async () => {

            let options = document.querySelectorAll('.option:checked')

            if (options.length > 0) {

                /** Sharing the carts*/
                const suppliers = await renderEdit("Suppliers", ["id", "name", "document", "age", "mail"], null, true);

                if (suppliers != null && suppliers['data'] != null && suppliers['data'].length > 0) {

                    suppliers['data'].forEach((item) => {
                        document.getElementById("supplier-id").insertAdjacentHTML('beforeend',
                            `<option value="${item.id}">` +
                            `  ${item.name} - ${item.id}` +
                            ` </option>`
                        )
                    })
                }

                document.getElementById("div-add-cart").style.display = "inline";
            } else {

                document.getElementById("div-add-cart").style.display = "none";
            }
        })

        document.getElementById("add-cart").addEventListener('click', () => {

            let products = [];
            let cart = document.getElementById('carts');

            if (cart.value == '' || cart.value == null ) {

                alert("First you need to select a Cart.")
                return;
            }

            let options = document.querySelectorAll('.option:checked')

            if (options.length > 0) {

                options.forEach((e) => {

                    products.push(e.id)
                })
            }

        })
    })
</script>
