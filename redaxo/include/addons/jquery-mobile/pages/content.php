<?php

$mypage = 'jquery-mobile';
$rx_id = '888';
$mobile_table = $REX['TABLE_PREFIX'].$rx_id.'_jquery_mobile';

$THEMA_STYLE = array(
	'a' => 'Thema A',
	'b' => 'Thema B',
	'c' => 'Thema C',
	'd' => 'Thema D',
	'e' => 'Thema E',
	'f' => 'Thema F'
);

$message = stripslashes(rex_request('_msg', 'string'));
$warning = stripslashes(rex_request('_warning', 'string'));

if($warning != '') {
	echo rex_warning($warning). "\n";
} elseif($message != ''){
	echo rex_info($message). "\n";
}

$form = rex_form::factory($mobile_table ,"Jquery-Mobile Standarteinstellungen",'id=1','post', false);

$field = $form->addRadioField('jquery-core', $form->getParam('jquery-core'));
$field->addOption('Ja', 1);
$field->addOption('Nein', 0);
$field->setLabel("JQuery-Core");
	
$field =  $form->addRadioField('jquery-mobile',  $form->getParam('jquery-core'));
$field->addOption('Ja', 1);
$field->addOption('Nein', 0);
$field->setLabel("JQuery-Mobile");

$field = $form->addSelectField('default-thema', $form->getParam('icon'));
$field->setLabel("Theme-Style Standard");
$select = $field->getSelect();
foreach($THEMA_STYLE as $key=>$val) {
	$select->addOption($val, $key);
}
$select->setSize(1);

$form->addParam('id', 1);
$form->setEditMode(true);
	
echo '<div class="rex-addon-output-v2 sy-form">';
$form->show();



$form = rex_form::factory($mobile_table ,"Jquery-Mobile Navigation",'id=1','post', false);

$field = $form->addSelectField('navi-thema', $form->getParam('navi-thema'));
$field->setLabel("Theme-Style");
$select = $field->getSelect();
foreach($THEMA_STYLE as $key=>$val) {
	$select->addOption($val, $key);
}
$select->setSize(1);

$field = $form->addRadioField('navi-scroll',  $form->getParam('navi-scroll'));
$field->addOption('Ja', 1);
$field->addOption('Nein', 0);
$field->setLabel("Mitscrollen?");

$form->addParam('id', 1);
$form->setEditMode(true);

$form->show();
echo '</div>';
	

?>