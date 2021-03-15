<?php

namespace SELLERCONTROL;
use SELLERCONTROL\Config;
use SELLERCONTROL\sellercontrol_init;
class Install
{
    /*
    * Construct
    * @return void
    */
    public function __construct()
    {

    }
    /*
    * initial function. you can call your functions here
    * @return void
    */
    public static function index()
    {
        $config = new Config;
        $install = new Install;
        $init = new sellercontrol_init;
        $install->plugin_options($config->plugin_options);
        //$install->table_create($init->options); db_options
        $install->table_create($config->db_options);
    }
    /*
    * Table Updates
    * @ver 1.0
    * se genera una nueva columna en las tablas de WP
    *
    * @return void
    */
    public function table_updates($tablename,$params)
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;
        $table = $wpdb->prefix.$tablename;
        foreach($params as $param)
        {
            $update=" ALTER TABLE `$table` ADD `{$param['name']}` {$param['attr']};";
            $wpdb->query($update);
        }
    }

    /*
    * Table Create
    * @ver 1.0
    * @return null
    */
    public function table_create($options)
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        foreach($options as $sql)
        {
             if($wpdb->get_var("SHOW TABLES LIKE '{$sql['table']}'") != $sql['table'])
             {
                $query="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}{$sql['table']} ( {$sql['query']} ){$charset_collate};";
                $wpdb->query($query);
             }
        }
    }

    /*
    * Plugin's Options on first install
    * @ver 1.0
    * @description: no modify
    * @return void
    */
    public function plugin_options($options)
    {
        foreach($options as $key => $option)
        {
            add_option($key,$option);
        }
    }
}
