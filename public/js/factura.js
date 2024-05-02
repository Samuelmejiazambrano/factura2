var filaCount = 0;

function calcularSubtotal(numero) {
    let valor = $("#valor" + numero).val();
    let cantidad = $("#cantidad" + numero).val();

    if (valor !== "" && cantidad !== "") {
        let subtotal = valor * cantidad;

        console.log("hola" + subtotal);
        $("#subtotal" + numero).val(subtotal);
        console.log("total");
        actualizarTotal();
        
    }
}

function agregarFila(url) {
    filaCount++;

    var newRow = `
    <tr>
    <td><input type="number" class="form-control" id="id${filaCount}"name="fkproducto[]" readonly></td>

     
        <td style="width: 10%"> 
            <input id="nombre${filaCount}" name="nombre[]" type="text" class="nombre" 
                   oninput="buscarProductos(this.value, '${url}')"
                   placeholder="Nombre del producto">
                   <div class="productos-buttons-container">
                   <div id="productos-buttons" style="display: flex "></div>
                  </div>  
        </td>
        <td style="width: 10%"><input type="number" class="form-control"id="valor${filaCount}" name="valor[]" readonly></td>
        <td style="width: 10%"><input type="number" class="form-control" id="cantidad${filaCount}" name="cantidad[]" oninput="calcularSubtotal(${filaCount})"></td>
        <td><input type="number" class="subtotal" id="subtotal${filaCount}" aria-label="Sub total" readonly></td>
        <td style="width: 10%"><button class="btn btn-danger" onclick="eliminarFila(this)"><i class="fa-solid fa-circle-minus"></i></button></td>
    </tr>
  `;
    document
        .getElementById("productos-table")
        .getElementsByTagName("tbody")[0]
        .insertAdjacentHTML("beforeend", newRow);
}

function eliminarFila(button) {
    var row = button.closest("tr");
    row.remove();
}

function buscar(input) {
    let idInput = input.id;
    let numero = idInput.match(/\d+/)[0];
    console.log("Número del campo de entrada: " + numero);

    let id = $("#iditem" + numero).val();
    console.log(id);
    ajax_search(id, numero);

    calcularSubtotal(numero);
}



let buscandoCliente = false;

function ajax_searchCliente(valor, urlCliente) {
    if (valor.trim() === "") {
        $("#cliente-buttons").empty();
        return;
    }

    let searchText = valor.trim();

    $.ajax({
        url: urlCliente,
        method: "GET",
        data: { texto: searchText },
        success: function (response) {
            console.log(response);
            if (
                response &&
                response.clientes.data &&
                Array.isArray(response.clientes.data)
            ) {
                let clientes = response.clientes;
                $("#cliente-buttons").empty();

                clientes.data.forEach(function (cliente) {
                    let button = $(
                        '<button type="button" class="btn btn-outline-primary cliente-button"></button>'
                    )
                        .text(cliente.nombre)
                        .data("cliente", cliente)
                        .appendTo("#cliente-buttons");

                    button.on("click", function () {
                        let clienteData = $(this).data("cliente");

                        $("#idCliente").val(clienteData.id);
                        $("#nombreCliente").val(clienteData.nombre);
                        $("#apellido").val(clienteData.apellido);
                        $("#correo").val(clienteData.correo);
                        $("#direccion").val(clienteData.direccion);
                        $("#telefono").val(clienteData.telefono);
                        $("#ciudad").val(clienteData.ciudad);

                        $("#cliente-buttons").empty();
                    });
                });
            } else {
                console.log(
                    "La respuesta no contiene un array de clientes o es inválida."
                );
            }
        },
        error: function (error) {
            console.log(error);
        },
        complete: function () {
            buscandoCliente = false;
        },
    });
}

function ajax_search(id, numero, url) {
    $.ajax({
        url: url,
        method: "GET",
        data: { texto2: id },
        success: function (response) {
            console.log(response.productos.data.length);
          
            console.log(response);
            console.log("item " + response.productos.data[0].nombre);
            // console.log(response);
            $("#id" + numero).val(response.productos.data[0].id);
            $("#nombre" + numero).val(response.productos.data[0].nombre);
            $("#valor" + numero).val(response.productos.data[0].valorUnico);
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function mostrarId(input) {}

// function actualizarTotal() {
//     totalSubtotal = 0;
//     $(".subtotal").each(function () {
//         totalSubtotal += parseFloat($(this).val());
//     });
//     let totalFormateado = totalSubtotal.toLocaleString();
//     $("#total").text("Total: " + totalFormateado);
//     console.log("hola subtotal" + totalSubtotal);
// }
function actualizarTotal() {
    totalSubtotal = 0;
    $(".subtotal").each(function () {
        totalSubtotal += parseFloat($(this).val());
    });
    let totalFormateado = totalSubtotal.toLocaleString();
    $("#total").text("Total: " + totalFormateado);
    console.log("hola subtotal" + totalSubtotal);

    // Actualizar el valor del campo oculto
    $("#totalInput").val(totalSubtotal);
}

document.addEventListener("DOMContentLoaded", function () {
    var alert = document.getElementById("alert");

    if (alert) {
        setTimeout(function () {
            alert.style.display = "none";
        }, 3000);
    }
});

let buscandoProductos = false;

function buscarProductos(valor, url) {
    console.log(url);
    if (valor.trim() === "") {
        $("#productos-buttons").empty();
        return;
    }

    if (buscandoProductos) {
        return;
    }

    buscandoProductos = true;
    let searchText = valor.trim();

    $.ajax({
        url: url,
        method: "GET",
        data: { texto2: searchText },
        success: function (response) {
            console.log(response);
            if (
                response &&
                response.productos.data &&
                Array.isArray(response.productos.data)
            ) {
                let productos = response.productos;
                $("#clientes-results").empty();

                productos.data.forEach(function (producto) {
                    let button = $(
                        '<button type="button" class="btn btn-outline-primary producto-button"></button>'
                    )
                        .text(producto.nombre)
                        .data("id", producto.id)
                        .appendTo("#productos-buttons");

                    button.on("click", function () {
                        let selectedOption = $(this).text();
                        let selectedId = $(this).data("id");
                        let numero = filaCount;

                      
                        $("#nombre" + numero).val(selectedOption);
                        $("#id" + numero).val(selectedId);
                        $("#valor" + numero).val(producto.valorUnico);

                        ajax_search(selectedId, numero, url);
                        $("#productos-buttons").empty();
                    });
                });
            } else {
                console.log(
                    "La respuesta no contiene un array de productos o es inválida."
                );
            }
        },
        error: function (error) {
            console.log(error);
        },
        complete: function () {
            buscandoProductos = false;
        },
    });
}
