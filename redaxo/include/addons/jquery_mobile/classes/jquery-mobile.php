<?php

class jquery_mobile {
	
		const rx_id = 888;
		const table = '_jquery_mobile';
		const table_navi = '_jquery_mobile_navi';
		const mypage = 'jquery-mobile';
		
		// Ausgabe vom Content
		// int $id = Kategorie ID
		// Falls leer (0), wird von der Hauptkategorie ausgelesen
		public static function Content($id = 0) {			
			
			global $REX;
			
			
			$de = rex_sql::factory();
			$de->setQuery('SELECT * FROM '.$REX['TABLE_PREFIX'].self::rx_id.self::table.' WHERE id=1');
			$default_style = $de->getValue('default-thema');

			$ch = rex_sql::factory();
			$ch->setQuery('SELECT id, name, clang FROM '.$REX['TABLE_PREFIX'].'article WHERE re_id='.$id);
			if ($ch->getRows() != 0) {
				
				for($i = 0; $i < $ch->getRows(); $i++) {
					echo '<div data-role="page" id="'.$ch->getValue('name').'"  data-theme="'.$default_style.'">
					';
					
					$b = new rex_article();
					$b->setArticleId($ch->getValue('id'));
					$b->setClang($ch->getValue('clang'));
					echo $b->getArticle();
				
					echo '</div>
					</div>
					';
					
					self::Content($ch->getValue('id'));
					$ch->next();
				
				}
			}
			
		}
		
		// Ausgabe der Navigation
		public static function getNavigation() {
			
			global $REX;
			
			$de = rex_sql::factory();
			$de->setQuery('SELECT * FROM '.$REX['TABLE_PREFIX'].self::rx_id.self::table.' WHERE id=1');
			$navi_style = $de->getValue('navi-thema');
			$navi_scroll = $de->getValue('navi-scroll');
		
			$return = '';
				
			$ch = rex_sql::factory();
			$ch->setQuery('SELECT * FROM '.$REX['TABLE_PREFIX'].self::rx_id.self::table_navi.' WHERE status = 1');
			if ($ch->getRows() != 0) {
				
				$fixed = ($navi_scroll) ? ' data-position-fixed="true' : '';
				
				$return .= '<div data-role="panel" id="navigation" data-display="push" '.$fixed.' class="ui-body-'.$navi_style.' navigation" data-theme="none">
					<ul data-role="listview" data-theme="'.$navi_style.'">';
				
				for($i = 0; $i < $ch->getRows(); $i++) {
					
					if(is_numeric($ch->getValue('link'))) {
						$return .= '<li data-icon="'.$ch->getValue('icon').'"><a href="#'.self::getNaviName($ch->getValue('link')).'">'.$ch->getValue('name').'</a></li>';
					}
					$ch->next();
				}
			
				$return .='</ul>
						</div>';	
			
			}
			
			return $return;
			
		}
		
		// Navigationsname herausfinden und als Linkname zurückgeben
		// Da Jquery-Mobile mit ID´s arbeitet und somit Zahlen nicht funktionieren
		// http://de.selfhtml.org/html/referenz/attribute.htm#id_idref_name
		// Statische weil --> http://www.peterkropff.de/site/php/statisches_besonderheiten.htm
		private static function getNaviName($id) {
			global $REX;
			$ar = rex_sql::factory();
			$ar->setQuery('SELECT name FROM '.$REX['TABLE_PREFIX'].'article WHERE id='.$id);
			return $ar->getValue('name');	
		}
		
		// Ausgabe der JS Datei
		// Nicht in Extensions-Point Head, da die JS Datei erst nach der name-Variable eingebunden werden muss
		public static function backendJS() {
			global $REX;
			
			echo '<script type="text/javascript" src="../'.$REX['MEDIA_ADDON_DIR'].'/'.self::mypage.'/js/jquery-mobile-backend.js"></script>';
		}
		
		public static function jqueryFrontend($core = true, $mobile = true) {
			global $REX;
			
			
			$return = PHP_EOL.'<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />'.PHP_EOL;			
			$return .= '<link rel="stylesheet" href="'.$REX['MEDIA_ADDON_DIR'].'/'.self::mypage.'/css/photoswipe.css" />'.PHP_EOL;			
			$return .= '<script type="text/javascript" src="'.$REX['MEDIA_ADDON_DIR'].'/'.self::mypage.'/js/klass.min.js"></script>'.PHP_EOL;
			
			$sql = rex_sql::factory();
			$sql->setQuery('SELECT * FROM '.$REX['TABLE_PREFIX'].self::rx_id.self::table.' WHERE id=1');
			
			if($sql->getValue('jquery-core') == 1 && $core == true) 
				$return .='<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>'.PHP_EOL;
			if($sql->getValue('jquery-mobile') == 1 && $mobile == true) 
				$return .='<script type="text/javascript" src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>'.PHP_EOL;

			$return .= '<script type="text/javascript" src="'.$REX['MEDIA_ADDON_DIR'].'/'.self::mypage.'/js/code.photoswipe.jquery-3.0.5.min.js"></script>'.PHP_EOL;
			
			return $return;
			
		}
	
}
?>