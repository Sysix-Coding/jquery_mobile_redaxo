<?php 
$field_id = rex_request('id', 'int');
$mypage = 'jquery_mobile';
$rx_id = '888';
$mobile_table = $REX['TABLE_PREFIX'].$rx_id.'_'.$mypage.'_navi'; 

if ($func == 'status' && $field_id != '') {
	
	$sql = new rex_sql();
	$sql->setQuery('SELECT * FROM '.$mobile_table.' WHERE id='.$field_id);
	if($sql->getRows())	{
		
		$status = ($sql->getValue('status')) ? 0 : 1;
		
		$sql->setQuery("UPDATE ".$mobile_table." SET status = ".$status." WHERE id =".$field_id);
		echo $sql->getError();
		echo rex_info('Status erfolgreich geändert!');
	}
	
	$func = '';
	
	
}

if($func == 'delete') {
	
	$sql = new rex_sql();
	$sql->setQuery("DELETE FROM ".$mobile_table." WHERE id =".$field_id);
	echo rex_info('Navigationspunkt erfolgreich gelöscht!');
	$func = '';	
	
} 


if ($func == '') {
	
	$baseURL = 'index.php?page='.$mypage.'&amp;subpage=navigation&amp;func=';
	$imgHeader = '<a class="rex-i-element rex-i-metainfo-add" href="'.$baseURL.'add"><span class="rex-i-element-text">add</span></a>';
?>
<div class="rex-addon-output-v2">
	<form action="index.php?page=<?php echo $thispage; ?>&amp;subpage=<?php echo $thissubpage; ?>" method="post">
		<table class="rex-table" id="rex-articles">
		<colgroup>
			<col width="29" />
			<col width="*" />
			<col width="29" />
			<col width="70" />
			<col width="130" />
		</colgroup>
		<thead>
			<tr>
				<th class="rex-icon"><?php echo $imgHeader; ?></th>
				<th>Name</th>
				<th>Prio</th>
				<th>Status</th>
				<th>Aktion</th>
			</tr>
		</thead>
		<tbody>
	<?php
	
	$sql = new rex_sql();
	$sql->setQuery('SELECT * FROM '.$mobile_table.' ORDER BY prio');
	if ($sql->getRows() > 0) {
		
		
		for ($i = 1; $i <= $sql->getRows(); $i++) {
			$class =  ($sql->getValue('status')) ? 'online' : 'offline'; 
		?>
			<tr>
				<td class="icon-mobile"><span class="<?php echo $sql->getValue('icon'); ?>"><?php echo $sql->getValue('icon'); ?></span></td>
				<td><?php echo $sql->getValue('name'); ?></td>
				<td><?php echo $sql->getValue('prio'); ?></td>
				<td><?php echo '<a class="rex-'.$class.'" href="'.$baseURL.'status&amp;id='.$sql->getValue('id').'">'.$class.'</a>' ?></td>
				<td align="center">
					<a href="<?php echo $baseURL; ?>edit&amp;id=<?php echo $sql->getValue('id'); ?>">Editieren</a>  |
					<a href="<?php echo $baseURL; ?>delete&amp;id=<?php echo $sql->getValue('id'); ?>" onclick="return confirm('Sicher löschen?');">Löschen</a>
				</td>
			</tr>		
		<?php	
		$sql->next();
		}			
	} else {
	?>
		<tr>
			<td colspan="5" align="center">
				<p>Es sind noch keine Navigationspunkte vorhanden.</p>
			</td>
		</tr>
	<?php	
	}
	?>
		</tbody>
	</table>
</form>
</div>
<?php
	
} elseif ($func == 'edit' || $func == 'add') {
	
	$ICONS = array(
		'bars'=>'Bars',
		'edit'=>'Editieren',
		'arrow-l'=>'Pfeil Links',
		'arrow-r'=>'Pfeil Rechts',
		'arrow-u'=>'Pfeil Oben',
		'arrow-d'=>'Pfeil Unten',
		'delete'=>'Löschen',
		'plus'=>'Plus Zeichen',
		'minus'=>'Minus Zeichen',
		'check'=>'Check',
		'gear'=>'Getriebe',
		'refresh'=>'Refresh',
		'forward'=>'Vorwärts',
		'back'=>'Zurück',
		'grid'=>'Grid',
		'star'=>'Stern',
		'alert'=>'Warnung',
		'info'=>'Info',
		'home'=>'Haus',
		'search'=>'Suchlupe',
		'false'=>'--KEIN ICON'
	);
	

	$form = new rex_form($mobile_table,"Jquery-Mobile Navigation","id=".$field_id,"post", false);
	$field = &$form->addTextField('name');
    $field->setLabel("Name");
	
	$field = &$form->addSelectField('icon', $form->getParam('icon'));
    $field->setLabel("Icon");
	$select = $field->getSelect();
	foreach($ICONS as $key=>$val) {
		$select->addOption($val, $key);
	}
	$select->setSize(1);
	

	
	$field = &$form->addLinkmapField('link', $form->getParam('link'));
    $field->setLabel("Link zu");
	
	$field =& $form->addPrioField('prio', $form->getParam('prio'));
	$field->setLabel('Sortieren nach');
	$field->setLabelField('name');
	
	if($func == 'edit') {
		$form->addParam('id', $field_id);
	}
	echo '<div class="rex-addon-output-v2">';
	$form->show();
	echo '</div>';
	
}

?>
