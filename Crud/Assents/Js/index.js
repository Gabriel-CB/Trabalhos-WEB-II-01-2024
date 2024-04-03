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
                    if (pageName == "Products") {

                        tableFiels += `<th scope="row"><input style="margin-right: 5px" type="checkbox" id="${item.id}" class="option">${item.id}</th>`;
                    } else {
                        tableFiels += `<th scope="row">${item.id}</th>`;
                    }
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

    if (readOly == false) {

        document.getElementById("page-name").textContent = `Edit ${pageName}`;
        document.getElementById("cancel-btn").onclick = () => {
            location.href = "./index.php"
        }
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

    return response ?? [];
}

async function addOrEdit(tableName, values, conditions = null, url = "./index.php") {

    const data = {
        "model": tableName,
        "event": values.id == "" || values.id == undefined ? "insert" : "update",
        "values": values,
        "conditions": conditions
    }

    let response = await request(data);

    if (response['success'] == true && url != null) {

        window.location.href = url;
    } else {

        return response;
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

async function login(mail, password) {

    let response = await renderEdit('Users', ['id', 'mail', 'password'], {mail: mail, password: password}, true);

    if (response['success'] == true) {

        if (response['data'][0] == null || response['data'][0] == undefined) {

            alert("E-mail or password incorrect !!")
        } else {
            await localStorage.setItem('user', JSON.stringify({
                id: response['data'][0].id,
                mail: response['data'][0].mail,
                password: response['data'][0].password,
            }));

            window.location.href = "../../Template/Home/Index.php";
        }
    }
}

async function checkSesion() {

    let user = JSON.parse(localStorage.getItem('user'));

    if (user != null && user != undefined && user.password != null && user.password != undefined) {

        return;
    }

    logout();
}

async function logout() {

    localStorage.removeItem('user');

    /** Verifica se o usuário já está na tela de login */
    let url = window.location.pathname.split('/');
    if (url[url.length - 2] != 'Login') {

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

checkSesion();
