<?php 

$mypage = 'jquery-mobile'; 

$dateien = array('button-eingabe.txt', 'button-ausgabe.txt');
$contents = array();
foreach($dateien as $datei) {
	$filename = 'include/addons/'.$mypage.'/module/'.$datei;
	$handle = fopen ($filename, "r");
	$contents[] = utf8_encode(htmlspecialchars(fread($handle, filesize ($filename))));
	fclose ($handle);
}
?>
<div class="rex-addon-output">
	<h2 class="rex-hl2">Jquery-Mobile -  Modul "Button" - Eingabe</h2>
	<div class="rex-addon-content">
		<textarea readonly="readonly" cols="10" rows="10" style="width:99%;"><?php echo $contents[0] ;?></textarea>	
	</div>

</div>
<div class="rex-addon-output">
	<h2 class="rex-hl2">Jquery-Mobile -  Modul "BUtton" - Ausgabe</h2>	
	<div class="rex-addon-content">	
		<textarea readonly="readonly" cols="10" rows="10" style="width:99%;"><?php echo $contents[1] ;?></textarea>	
	</div>
</div>
