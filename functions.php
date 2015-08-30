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

define('theme_name', $themename);

/* [01] Base & Framwork Options
-------------------------------------------------------*/
require_once('inc/options-base.php' );
/* [02] Dashboard & Framework Options
-------------------------------------------------------*/
require_once('inc/options-dashboard.php' );
/* [03] Load JS
-------------------------------------------------------*/
require_once('inc/options-loader.php' );
/* [04] Plugins
-------------------------------------------------------*/
require_once('inc/options-plugins.php' );
/* [05] Custom Post Types
-------------------------------------------------------*/
require_once('inc/options-post-type.php' );

/* [06] Theme Options
------------------------------------------------------*/
require_once('inc/options-cp.php' );
?>