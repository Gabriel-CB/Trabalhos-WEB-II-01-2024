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

                document.getElementById("add-cart").style.display = "inline";
            } else {

                document.getElementById("add-cart").style.display = "none";
            }
        })

        document.getElementById("add-cart").addEventListener('click', async () => {

            let products = [];

            let options = document.querySelectorAll('.option:checked')

            if (options.length > 0) {

                options.forEach((e) => {

                    products.push(e.id)
                })

                let user = await JSON.parse(localStorage.getItem('user'));

                if (user.id == null || user.id == undefined) {

                    logout()
                } else {


                    let response = await addToCart({products: products, user_id: user.id});

                    if (response['success'] == true) {

                        options.forEach((e) => {

                            e.checked = false
                        })
                        document.getElementById("add-cart").style.display = "none";
                    }
                }
            } else {

                document.getElementById("add-cart").style.display = "none";
            }
        })
    })
</script>
