<?php
$mypage = 'jquery_mobile';

$REX['ADDON']['rxid'][$mypage] = '888';
$REX['ADDON']['page'][$mypage] = $mypage;    
$REX['ADDON']['name'][$mypage] = 'Jquery-Mobile';

$REX['ADDON']['version'][$mypage] = "0.1";
$REX['ADDON']['author'][$mypage] = "Sysix-Coding";
$REX['ADDON']['dbpref'][$mypage]= $REX['TABLE_PREFIX'].$REX['ADDON']['rxid'][$mypage].'_';


/*
Das Anlegen einer Sprachintanz ist nötig, wenn man das AddOn Backend mehrsprachig verwalten will.
Dieser Schlüssel muss natürlich eindeutig sein.
*/

#$I18N_adressen = new i18n($REX['LANG'], $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/lang/');

require $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/classes/jquery-mobile.php'; 

if ($REX['REDAXO']) {
	
	rex_register_extension('PAGE_HEADER', 'jquery_mobile_backend');
	
	function jquery_mobile_backend() {
		
		global $REX;
		$mypage = 'jquery-mobile';
		
		echo '<link rel="stylesheet" href="../'.$REX['MEDIA_ADDON_DIR'].'/'.$mypage.'/css/jquery-mobile-backend.css" media="screen, projection, print" />';
		
	}
	
} else {
		
	rex_register_extension('OUTPUT_FILTER', 'jquery_mobile_frontend');	
	
	function jquery_mobile_frontend($params) {
		
		$output = $params['subject'];
		$js_files = jquery_mobile::jqueryFrontend();
		
		return str_replace('</title>', '</title>'.$js_files, $output);
	}
}

?>