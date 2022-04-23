(function ($) {
    let asin;
    $('#data_productos').DataTable({
        ordering: false,
        data: dataSet,
        columns: [{
                title: "ASIN",
                data: "id",
                render: function (data) {
                    asin = data.link;
                    let ret = '<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#' + data.ASIN + '" aria-controls="offcanvasExample"> <i class="fas fa-search"></i> </button> ';
                    ret += '<a href="' + data.editar + '" class="link-dark" target="_blank">' + data.ASIN + '</a>'
                    ret += '<div class="offcanvas offcanvas-start" tabindex="-1" id="' + data.ASIN + '" aria-labelledby="' + data.ASIN + '">';
                    ret += '<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>';
                    ret += '<div class="offcanvas-body">';
                    ret += '<div class="card" style="width: 18rem;">';
                    ret += '<img src="' + data.img + '" class="card-img-top">';
                    ret += '<div class="card-body">';
                    ret += '<div class="col-auto"><label for="personaje" class="form-label">Personaje</label>';
                    ret += '<input type="text" class="form-control" id="personaje" name="personaje_' + asin + '" value="' + data.personaje + '">';
                    ret += '</div>';
                    ret += '<div class="col-auto"><label for="escala" class="form-label">Escala</label>';
                    ret += '<input type="text" class="form-control" id="escala" name="escala_' + asin + '" value="' + data.escala + '">';
                    ret += '</div>';
                    ret += '<div class="col-auto"><label for="tipo" class="form-label">Tipo</label>';
                    ret += '<input type="text" class="form-control" id="tipo" name="tipo_' + asin + '" value="' + data.tipo + '">';
                    ret += '</div>';
                    ret += '<div class="col-auto"><label for="ean" class="form-label">EAN</label>';
                    ret += '<input type="text" class="form-control" id="ean" name="ean_' + asin + '" value="' + data.ean + '">';
                    ret += '<div class="invisible">' + data.ean + '</div>'
                    ret += '</div>';
                    ret += '<div class="col-auto"><label for="amz_cat" class="form-label">Categoria Amazon</label>';
                    ret += '<input type="text" class="form-control" id="amz_cat" name="amz_cat_' + asin + '" value="' + data.amz_cat + '" readonly>';
                    ret += '</div>';
                    ret += '</div></div>';
                    ret += '</div></div>';
                    return ret;
                }
            },
            {
                title: "Nombre",
                data: "name"
            },
            {
                title: "Categoria ML",
                data: "ml_cat_name",
                render: function (data) {
                    data = '<input type="text" class="form-control" name="ml_cat_name_' + asin + '" value="' + data + '">';
                    return data;
                }
            },
            {
                title: "Código ML",
                data: "ml_cat_code",
                render: function (data) {
                    ml_cod = data;
                    data = '<input type="text" class="form-control" name="ml_cat_code_' + asin + '" value="' + data + '">';
                    data += '<div class="invisible">' + ml_cod + '</div>'
                    return data;
                }
            },
            {
                title: "Código Claro",
                data: "claro_cat",
                render: function (data) {
                    cl_cod = data;
                    data = '<input type="text" class="form-control" name="claro_cat_' + asin + '" value="' + data + '">';
                    data += '<div class="invisible">' + cl_cod + '</div>'
                    return data;
                }
            },
            {
                title: "¿En Almacén?",
                data: 'in_warehouse',
                render: function (data) {
                    let check = '';
                    if (data == 'on') {
                        check = 'checked'
                    }
                    data = '<input id="asin_' + asin + '" name="asin_' + asin + '" type="hidden" value="' + asin + '">'
                    data += '<input id="' + asin + '" name="in_warehouse_' + asin + '" role="switch" class="form-check-input mt-0" type="checkbox" ' + check + '>';
                    return data;
                }
            },
            {
                title: "¿En Mercadolibre?",
                data: 'in_mercadolibre',
                render: function (data) {
                    let check = '';
                    if (data == 'on') {
                        check = 'checked'
                    }
                    data = '<input id="' + asin + '" name="in_mercadolibre_' + asin + '" role="switch" class="form-check-input mt-0" type="checkbox" ' + check + '>';
                    return data;
                }
            },
            {
                title: "¿En Claroshop?",
                data: 'in_claroshop',
                render: function (data) {
                    let check = '';
                    if (data == 'on') {
                        check = 'checked'
                    }
                    data = '<input id="' + asin + '" name="in_claroshop_' + asin + '" role="switch" class="form-check-input mt-0" type="checkbox" ' + check + '>';
                    return data;
                }
            }
        ]
    });
})(jQuery);