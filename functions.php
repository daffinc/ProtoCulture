<?php
/*---[ Details ]---------------------------------------
Function 1.0
Author: Adrian Galvez G.
Contact: adrian@sektorrd.com
-------------------------------------------------------*/

/*-----------------------------------------------------
[01] Base & Framwork Options
[02] Load Javascript
[03] Plugins
[04] Custom Post Types and Taxonomies
[05] Meta Box Panel
-------------------------------------------------------*/

/* [00] Global Variables
-------------------------------------------------------*/
$themename = "template-blog";
$prefix = "den_";
$denCDN = "http://cdn.devstate.de";
$denSiteURL = "http://dreams.agency";

define('dreamstheme', $themename);

/* [01] Base & Framwork Options
-------------------------------------------------------*/
require get_template_directory() . '/inc/options-base.php';

/* [02] Widgets
-------------------------------------------------------*/
require get_template_directory() . '/inc/options-widgets.php';

/* [03] Dashboard & Framework Options
-------------------------------------------------------*/
require get_template_directory() . '/inc/options-dashboard.php';

/* [04] Load JS
-------------------------------------------------------*/
require get_template_directory() . '/inc/options-loader.php';

/* [05] Plugins
-------------------------------------------------------*/
require get_template_directory() . '/inc/options-plugins.php';

/* [06] Custom Post Types
-------------------------------------------------------*/
require get_template_directory() . '/inc/options-post-type.php';

/* [07] Theme Options
------------------------------------------------------*/
require get_template_directory() . '/inc/options-cp.php';

/* [08] Theme Options
------------------------------------------------------*/
require get_template_directory() . '/inc/options-meta-box.php';

?>