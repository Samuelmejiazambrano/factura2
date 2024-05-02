function cargarDatosTabla(url) {
    let table = $("#table_id").DataTable({
        processing: false,
        serverSide: true,
        searching: false,
        ajax: {
            url: url,
            type: "GET",
            data: function (d) {
               d.search =  $('#nombreId').val().trim(),
               d.search2 =  $('#ciudadId').val().trim(),   
                console.log("Nombre:", $('#nombreId').val().trim());
            },
        },
        columns: [
            { data: "id" },
            { data: "fkCliente" },
            { data: "cliente.nombre" },
            { data: "cliente.ciudad" },
            {
                data: "total",
                render: function (data, type, row) {
                    return parseFloat(data).toLocaleString("es-ES", {
                        minimumFractionDigits: 2,
                    });
                },
            },
            { data: "created_at" },
         {
    data: null,
    render: function (data, type, row) {
        return (
            '<a class="nav-link" href="/mostrarDetalle'+row.id +'"><button type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></a>'
        );
    },
},
        ],
        pageLength: 5,
        destroy: true,
    });

    $('#nombreId, #ciudadId').on("keyup", function () {
        table.ajax.reload();
    });
}
