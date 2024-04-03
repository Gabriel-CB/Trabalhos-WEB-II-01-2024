<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../../Assents/Js/index.js" defer type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../Assents/Css/index.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body style="display: flex">

<div id="container-login">
    <form id="login">
        <h4>Login</h4>
        <div class="row">
            <div class="mb-3">
                <label for="mail" class="form-label">E-mail</label>
                <input type="email" class="form-control" required id="mail" placeholder="Enter your mail">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" required id="password" placeholder="Enter your password">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Login</button>
        <button type="button" onclick="changeElement('register')" class="btn btn-primary">Register</button>
    </form>
    <form id="register">
        <h4>Register</h4>
        <div class="row">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" name="name" class="form-control" required id="name">
            </div>
            <div class="mb-3">
                <label for="cellphone" class="form-label">Cellphone</label>
                <input type="text" name="cellphone" class="form-control" required id="cellphone">
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="mail-register" class="form-label">E-mail</label>
                <input type="email" name="mail-register" class="form-control" required id="mail-register"
                       placeholder="Enter your mail">
            </div>
            <div class="mb-3">
                <label for="password-register" class="form-label">Password</label>
                <input type="password" name="password-register" class="form-control" required id="password-register"
                       placeholder="Enter your password">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Register</button>
        <button type="button" onclick="changeElement('login')" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>
<script>

    document.addEventListener("DOMContentLoaded", async function (event) {

        changeElement();
        document.getElementById("login").addEventListener("submit", async (event) => {

            event.preventDefault();
            const mail = document.getElementById("mail").value;
            const password = document.getElementById("password").value;

            await login(mail, password);
        })

        document.getElementById("register").addEventListener("submit", async (event) => {

            event.preventDefault();

            let data = {
                name: document.getElementById("name").value,
                cellphone: document.getElementById("cellphone").value,
                mail: document.getElementById("mail-register").value,
                password: document.getElementById("password-register").value,
            }

            let response = await addOrEdit('Users', data, null, null);

            if (response['success'] == true) {

                login(data.mail, data.password);
            }
        })
    })

    function changeElement(current = null) {

        if (current == "login") {

            document.getElementById("login").style.display = "block"
            document.getElementById("register").style.display = "none"
        } else if (current == "register") {

            document.getElementById("login").style.display = "none"
            document.getElementById("register").style.display = "block"
        } else {

            document.getElementById("login").style.display = "block"
            document.getElementById("register").style.display = "none"
        }
    }

</script>