(function($){
        $('#example').DataTable( {
            data: dataSet,
            columns: [
                { title: "Factura" },
                { title: "Fecha" },
                { title: "Proveedor" },
                { title: "Forma de Pago" },
                { title: "IVA" },
                { title: "Total"}
            ]
        } );
     })(jQuery);