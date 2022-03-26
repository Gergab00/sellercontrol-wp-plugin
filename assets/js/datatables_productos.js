(function($){
        let asin;
        $('#data_productos').DataTable( {
            data: dataSet,
            columns: [
                { title: "ASIN", data: "id",
                    render: function(data) {
                        asin = data.link;
                        let ret = '<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#' + data.ASIN + '" aria-controls="offcanvasExample"> <i class="fas fa-search"></i> </button> '+ data.ASIN;
                        ret += '<div class="offcanvas offcanvas-start" tabindex="-1" id="' + data.ASIN + '" aria-labelledby="' + data.ASIN + '">';
                        ret += '<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>';
                        ret += '<div class="offcanvas-body">';
                        ret +='<div class="card" style="width: 18rem;">';
                        ret +='<img src="'+ data.img +'" class="card-img-top">';
                        ret +='<div class="card-body">';
                        ret +='<div class="col-auto"><label for="ean" class="form-label">EAN</label>';
                        ret +='<input type="text" class="form-control" name="ean_' + asin + '" value="' + data.ean + '">';
                        ret +='</div>';
                        ret +='<div class="col-auto"><label for="ean" class="form-label">Categoria Amazon</label>';
                        ret +='<input type="text" class="form-control" name="amz_cat_' + asin + '" value="' + data.amz_cat + '" readonly>';
                        ret +='</div>';
                        ret +='</div></div>';   
                        ret += '</div></div>';
                        return ret;
                    }
                },
                { title: "Nombre", data: "name" },
                { title: "Categoria ML", data: "ml_cat_name" },
                { title: "Código ML", data: "ml_cat_code" },
                { title: "Código Claro", data: "claro_cat" },
                { title: "¿En Almacén?", data: 'in_warehouse',
                    render: function(data) {
                        let check = '';
                        if(data == 'on'){
                            check = 'checked'
                        }
                        data = '<input id="asin_' + asin + '" name="asin_' + asin + '" type="hidden" value="' + asin + '">'
                        data += '<input id="' + asin + '" name="in_warehouse_' + asin + '" role="switch" class="form-check-input mt-0" type="checkbox" '+ check +'>';
                        return data;
                    }
                },
                { title: "¿En Mercadolibre?", data: 'in_mercadolibre',
                    render: function(data) {
                        let check = '';
                        if(data == 'on'){
                            check = 'checked'
                        }
                        data = '<input id="' + asin + '" name="in_mercadolibre_' + asin + '" role="switch" class="form-check-input mt-0" type="checkbox" '+ check +'>';
                        return data;
                    }
                },
                { title: "¿En Claroshop?", data: 'in_claroshop',
                render: function(data) {
                    let check = '';
                    if(data == 'on'){
                        check = 'checked'
                    }
                    data = '<input id="' + asin + '" name="in_claroshop_' + asin + '" role="switch" class="form-check-input mt-0" type="checkbox" '+ check +'>';
                    return data;
                }
            }
            ]
        } );
     })(jQuery);



     