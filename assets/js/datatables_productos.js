(function($){
        let asin;
        $('#data_productos').DataTable( {
            data: dataSet,
            columns: [
                { title: "ASIN", data: "id",
                    render: function(data) {
                        asin = data.link;
                        data = '<button type="button" class="btn btn-primary view-post" data-id="' + data.link + ' data-bs-toggle="modal" data-bs-target="#postModal">' + data.ASIN + '</button>';
                        return data;
                    }
                },
                { title: "Nombre", data: "name" },
                { title: "Categoria Amazon", data: "amz_cat" },
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
                }
            ]
        } );
     })(jQuery);
     