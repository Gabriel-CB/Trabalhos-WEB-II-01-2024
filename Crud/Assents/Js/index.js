async function renderIndex(pageName, tableName, fields) {
    document.getElementById("page-name").textContent = pageName;
    const table = document.getElementById(tableName);
    const tableBody = document.querySelector(`#${tableName} tbody`);

    document.getElementById("add-btn").onclick = () => {
        location.href = "./addOrEdit.php"
    }

    const data = {
        model: pageName,
        event: "select",
        values: fields
    }

    let response = await request(data);

    if (response['data'] != null && response['data'].length > 0) {

        response['data'].forEach((item) => {

            let tableFiels = '';
            fields.forEach((field) => {

                if (field == 'id') {

                    tableFiels += `<th scope="row">${item.id}</th>`;
                } else {

                    tableFiels += `<td>${item[field]}</td>`;
                }
            })

            tableBody.insertAdjacentHTML('beforeend',
                `<tr> ${tableFiels}` +
                `      <td>` +
                `          <button type="button" onclick=" window.location.href = './addOrEdit.php?id=${item.id}';" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>` +
                `          <button type="button" onclick="deleteItem('${pageName}', {id: ${item.id}})" class="btn btn-danger"><i class="fas fa-trash"></i></button>` +
                `      </td>` +
                ` </tr>`
            )
        })
    } else {

        const notFound = document.createElement("h4");
        notFound.className = "no-register";
        notFound.append(`No ${pageName} Founded!`)
        table.parentElement.append(notFound);
    }
}

async function renderEdit(pageName, fields, conditions = null, readOly = false) {

    document.getElementById("page-name").textContent = `Edit ${pageName}`;
    document.getElementById("cancel-btn").onclick = () => {
        location.href = "./index.php"
    }

    const data = {
        model: pageName,
        event: "select",
        values: fields,
        conditions: conditions
    }

    let response = await request(data);

    if (response["success"] == true) {
        if (response['data'] != null && response['data'].length > 0) {

            if (readOly == false) {
                fields.forEach((field) => {

                    document.querySelector(`[name=${field}]`).value = response['data'][0][field];
                })
            }
        } else if (readOly == false) {

            alert(`Não foram encontrados os dados desse ${pageName}, tente novamente. `)
        }
    }

    return response['data'] ?? [];
}

async function addOrEdit(tableName, values, conditions = null, url = "./index.php") {

    const data = {
        "model": tableName,
        "event": values.id == "" ? "insert" : "update",
        "values": values,
        "conditions": conditions
    }

    let response = await request(data);

    if (response['success'] == true) {

        window.location.href = url;
    }
}

async function deleteItem(tableName, conditions) {

    if (confirm("Do you really want delete this register ?")) {
        const data = {
            "model": tableName,
            "event": "delete",
            "conditions": conditions
        }

        const response = await request(data);

        if (response.success == true) {

            window.location.reload();
        }
    }
}

async function login() {

    if (confirm("Do you really exit ?")) {


        var person = {};//cria um objeto vazio


        localStorage.setItem('person', JSON.stringify(person));//Grava em Json
        formulario.reset();
        function ler(){
            var person = JSON.parse(localStorage.getItem('person'));
            document.getElementById("result").innerHTML = "Nome: " + person.nome +
                "<br>Idade: " + person.idade +
                "<br>Sexo: " + person.sexo +
                "<br>Estado Civil: " + person.est_civil;
        }

        if (response.success == true) {

            window.location.reload();
        }
    }
}

async function logout() {

    if (confirm("Do you really exit ?")) {


        window.location.href = "../Login/index.php";

    }
}

async function request(data) {

    let response;

    await fetch("../../Controllers/Controller.php", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            "Accept": 'application/json',
            'Content-Type': "application/json"
        }
    }).then(async (request) => {
        await request.json().then(parsedValue => {
            response = parsedValue;
        })

        if (response["success"] == false) {

            throw new Error(response['message']);
        }
    }).catch((error) => {

        alert(`${error.message} `)
    })

    return response;
}