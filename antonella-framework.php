<?php
namespace SELLERCONTROL;
/*
Plugin Name: sellercontrol
Plugin URI: https://github.com/Gergab00/sellercontrol
Description: Plugin de control de los seller control.
Version:2022.04.01
Author:Gerardo Gabriel González Velázquez
Author URI: https://github.com/Gergab00
License: GPLv2 https://es-mx.wordpress.org/about/license/
PHP Version: 7.0
Framework: Antonella Framework for WP
Framework URI: http://antonellaframework.com
 * @category Form
 * @package  sellercontrol
 * @author   Gerardo González
 * @license  GPLv2 http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     https://github.com/Gergab00
*/

defined( 'ABSPATH' ) or die( __('Lo siento por aqui no puedes pasar :)') );

/*
* Class Caller.
* cuando una clase es llamada hace un include
* al archivo con su mismo nombre
* se respeta mayusculas y minusculas
*
* @return null
*/
define('NELLA_URL',__FILE__);
$loader = require __DIR__ . '/vendor/autoload.php';
$antonella= new Start;


?>
