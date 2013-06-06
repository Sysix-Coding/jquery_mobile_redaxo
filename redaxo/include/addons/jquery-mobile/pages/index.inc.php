<?php
// ANlegen einiger Variablen
$Basedir = dirname(__FILE__);
$page = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');
if($subpage == '') $subpage = 'content';
$func = rex_request('func', 'string');

// Seitenheader von REDAXO includen
include $REX['INCLUDE_PATH'].'/layout/top.php';

// Submenue erzeugen
$subpages = array(
	array('content',"Jquery-Mobile"),
	array('navigation', 'Navigation'),
	array('',''),
	array('list', 'Modul "Liste"'),
	array('header', 'Modul "Header"'),
	array('button', 'Modul "Button"'),
	array('galerie', 'Modul "Galerie"')
	#array('help',"Hilfe")
);

rex_title("Jquery-Mobile", $subpages);
// Laden der jeweiligen Menueseite
require $Basedir .'/'.$subpage.'.php';


// Seitenfooter von REDAXO includen
include $REX['INCLUDE_PATH'].'/layout/bottom.php';
?>