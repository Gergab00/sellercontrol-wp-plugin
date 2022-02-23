<?php

namespace SELLERCONTROL;

class Config
{

    /*
    * Data base options db_options
    * create the database values value
    * Array ('table'=>'default table name', 'query'=>'string of query create id ex: INT(10) NOT NULL AUTO_INCREMENT,....)
    * @example [["table"=>"sellercontrol", "query" =>"id INT(10) NOT NULL AUTO_INCREMENT]]
    * @return void
    */
    public $db_options = [
        [
            "table" => "sc_facturas_compras",
            "query" => "id INT(10) NOT NULL AUTO_INCREMENT, factura VARCHAR(100) NOT NULL, fecha DATE NOT NULL, proveedor VARCHAR(100) NOT NULL, forma_pago VARCHAR(100) NOT NULL, iva DOUBLE(10,2) NOT NULL, monto DOUBLE(10,2) NOT NULL , created_at datetime NOT NULL, PRIMARY KEY (id)",
        ],
        [
            "table" => "sc_productos_compras",
            "query" => "id INT(10) NOT NULL AUTO_INCREMENT, factura VARCHAR(100) NOT NULL, fecha DATE NOT NULL, descripcion VARCHAR(100) NOT NULL, ASIN VARCHAR(100) NOT NULL, precio_unitario DOUBLE(10,2) NOT NULL, cantidad INT(10) NOT NULL, total DOUBLE(10,2) NOT NULL, created_at datetime NOT NULL, PRIMARY KEY (id)",
        ],
    ];
    /*
    * Plugins option
    * storage in database the option value
    * Array ('option_name'=>'default value')
    * @example ["example_data" => 'foo',]
    * @return void
    */
    public $plugin_options = [];
    /**
     * Language Option
     * define a unique word for translate call
     */
    public $language_name = 'antonella';
    /**
     * Plugin text prefix
     * define a unique word for this plugin
     */
    public $plugin_prefix = 'ch_nella';
    /**
     * POST data process
     * get the post data and execute the function
     * @example ['post_data'=>'SELLERCONTROL::function']
     */
    public $post = [
        'factura_nonce' => __NAMESPACE__ . '\Controller::guardarFacturaCompra',
        'warehouse_nonce' => __NAMESPACE__.'\Productos::guardarCambiosProductos',
    ];
    /**
     * GET data process
     * get the get data and execute the function
     * @example ['get_data'=>'SELLERCONTROL::function']
     */
    public $get = [];
    /**
     * add_filter data functions
     * @input array
     * @example ['body_class','SELLERCONTROL::function',10,2]
     * @example ['body_class',['SELLERCONTROL','function'],10,2]
     */
    public $add_filter = [
        ['script_loader_tag', 'SELLERCONTROL\add_async_defer_attributes::add_async_defer_attributes', 10, 2],
    ];
    /**
     * add_action data functions
     * @input array
     * @example ['body_class','SELLERCONTROL::function',10,2]
     * @example ['body_class',['SELLERCONTROL','function'],10,2]
     */
    public $add_action = [
        ['wp_enqueue_scripts', __NAMESPACE__.'\Enqueue::insertarJS', 10, 3],
        ['wp_enqueue_scripts', __NAMESPACE__.'\Enqueue::insertarCSS', 10, 3],
        ['wp_enqueue_scripts', __NAMESPACE__.'\Enqueue::obenerDatosTabla', 11, 4],
        ['wp_enqueue_scripts', __NAMESPACE__.'\Productos::obtenerDatosProductos', 12, 5],
        ['add_meta_boxes', 'SELLERCONTROL\WooMeta::createBoxOtherData',10,5],
        ['add_meta_boxes', __NAMESPACE__.'\WooMeta::createBoxAmazonData',10,5],
        ['add_meta_boxes', __NAMESPACE__.'\WooMeta::createBoxMercadoLibreData',10,5],
        ['admin_enqueue_scripts', __NAMESPACE__.'\Enqueue::insertarJSAdmin', 10, 6],
        ['admin_enqueue_scripts', __NAMESPACE__.'\Enqueue::insertarCSSAdmin', 10, 7],
        ['save_post',__NAMESPACE__.'\WooMeta::saveInfo',10,5],
        ['wp_ajax_load_post_by_ajax', __NAMESPACE__.'\Productos::load_post_by_ajax_callback', 11,1],
        ['wp_ajax_nopriv_load_post_by_ajax', __NAMESPACE__.'\Productos::load_post_by_ajax_callback', 11,1]
        //['wp_roles_init', 'SELLERCONTROL\Usuarios::crearUsuario', 10,3],

    ];
    /**
     * add custom shortcodes
     * @input array
     * @example [['example','SELLERCONTROL\ExampleController::example_shortcode']]
     */
    public $shortcodes = [
        ['sellercontrol_factura_form', __NAMESPACE__.'\ViewsShortcodes::renderFacturaForm'],
        ['sellercontrol_factura_table', __NAMESPACE__.'\ViewsShortcodes::renderFacturaTable'],
        ['dcms_form_login', __NAMESPACE__.'\ViewsShortcodes::dcms_form_login_config'],
        ['sellercontrol_scanner', __NAMESPACE__.'\ViewsShortcodes::iniciarScanner'],
        ['sellercontrol_productos', __NAMESPACE__.'\Productos::ViewTablaProductos']
    ];
    /**
     * add Gutenberg's blocks
     */
    public $gutenberg_blocks = [];
    /**
     * Dashboard

     * @reference: https://codex.wordpress.org/Function_Reference/wp_add_dashboard_widget
     */
    public $dashboard = [
        [
            'slug'      => '',
            'name'      => '',
            'function'  => '', // example: __NAMESPACE__.'\Admin\PageAdmin::DashboardExample',
            'callback'  => '',
            'args'      => '',
        ]

    ];
    /**
     * Files for use in Dashboard
     */
    public $files_dashboard = [];

    /*
    * Plugin menu
    * set your menu option here
    */
    public $plugin_menu = [
        /*
        [
            "path"      => ["page"],
            "name"      => "My Custom Page",
            "function"  => __NAMESPACE__."\Admin\PageAdmin::index",
            "icon"      => "antonella-icon.png",
            "slug"      => "my-custom-page",
        ]
        
            [
                "path"      => ["page"],
                "name"      => "My Custom Page",
                "function"  => __NAMESPACE__."\Admin::option_page",
               // "icon"      => "antonella-icon.png",
                "slug"      => "my-custom-page",
                "subpages"  =>
                [
                    [
                        "name"      => "My Custom sub Page",
                        "slug"      => "my-top-sub-level-slug",
                        "function"  => __NAMESPACE__."\Admin::option_page",
                    ],
                    [
                        "name"      => "My  Sencond Custom sub Page",
                        "slug"      => "my-second-sub-level-slug",
                        "function"  => __NAMESPACE__."\Admin::option_page",
                    ],
                ]
            ],
            [
                "path"      => ["page"],
                "name"      => "My SECOND Custom Page",
                "function"  => __NAMESPACE__."\Admin::option_page",
                "icon"      => "antonella-icon.png",
                "slug"      => "my-SECOND-custom-page",
                "subpages"  =>
                [
                    [
                        "name"      => "My Custom sub Page",
                        "slug"      => "my-top-sub-level-slug-2",
                        "function"  => __NAMESPACE__."\Admin::option_page",
                    ],
                    [
                        "name"      => "My  Sencond Custom sub Page",
                        "slug"      => "my-second-sub-level-slug-2",
                        "function"  => __NAMESPACE__."\Admin::option_page",
                    ],
                ]
            ],
            [
                "path"      => ["subpage","tools.php"],
                "name"      => "sub page in tools",
                "slug"      => "sub-tools",
                "function"  => __NAMESPACE__."\Admin::option_page",
            ],
            [
                "path"      => ["option"],
                "name"      => "sub page in option",
                "slug"      => "sub-option",
                "function"  => __NAMESPACE__."\Admin::option_page",
            ]
        */];

    /**
     * Custom Post Type
     * for make simple Custom PostType
     * for simple add fill the 7 frist elements
     * for avanced fill
     * https://codex.wordpress.org/Function_Reference/register_post_type
     */

    public $post_types = [
        [
            "singular"      => "",
            "plural"        => "",
            "slug"          => "",
            "position"      => 12,
            "taxonomy"      => [], //['category','category2','category3'],
            "image"         => "antonella-icon.png",
            "gutemberg"     => true,
            //advanced
            /*
            'labels'        => [],
            'args'          => [],
            'rewrite'       => []
            */
        ],
    ];

    /**
     * Taxonomies
     * for make taxonomies
     * for easy add only fill the 5 first elements
     * for avanced methods
     * https://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    public $taxonomies = [
        [
            "post_type"     => "",
            "singular"      => "",
            "plural"        => "",
            "slug"          => "",
            "gutemberg"     => true,
            //advanced
            /*
            "labels"        =>[],
            "args"          =>[],
            "rewrite"       =>[],
            "capabilities"  =>[]
            */
        ]
    ];

    /**
     * Widget
     * For register a Widget please:
     * Console: php antonella Widget "NAME_OF_WIDGET"
     * @input array
     * @example public $widget = [__NAMESPACE__.'\YouClassWidget']  //only the class
     */
    public $widgets = [];

}
