
function renderIndex(pageName, tableName){

    document.getElementById("page-name").textContent = pageName;
    const table = document.getElementById(tableName);
    const body = document.querySelector(`#${tableName} tbody`);
    const itens = [];
    document.getElementById("add-btn").onclick = () => {
        location.href = "./addOrEdit.php"
    }

    if (itens != null && itens.length > 0) {

        body.forEach((item) => {

            body.append(
                `<tr>` +
                `      <th scope="row"></th>` +
                `      <td></td>` +
                `      <td></td>` +
                `      <td></td>` +
                `      <td>` +
                `          <button type="button" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>` +
                `          <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>` +
                `      </td>` +
                ` < /tr>`
            )
        })
    } else {

        const notFound = document.createElement("h4");
        notFound.className = "no-register";
        notFound.append("Nenhum Produto Encontrado!")
        table.parentElement.append(notFound);
    }
}


window.renderIndex = renderIndex;