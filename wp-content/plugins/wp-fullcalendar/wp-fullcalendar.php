<?php
/*
Plugin Name: WP FullCalendar
Version: 0.8.4
Plugin URI: http://wordpress.org/extend/plugins/wp-fullcalendar/
Description: Uses the jQuery FullCalendar plugin to create a stunning calendar view of events, posts and eventually other CPTs. Integrates well with Events Manager
Author: Marcus Sykes
Author URI: http://msyk.es
*/

/*
Copyright (c) 2012, Marcus Sykes

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

define('WPFC_VERSION', '1.0.1');

class WP_FullCalendar{
	static $args = array();
	static $tip_styles = array('default','plain','light','dark','red','green','blue','youtube','jtools','cluetip','tipped','tipsy');
	static $tip_styles_css3 = array('shadow','rounded');
	static $tip_positions = array('top left', 'top right', 'top center', 'bottom left', 'bottom right', 'bottom center', 'right center', 'right top', 'right bottom', 'left center', 'left top', 'left bottom', 'center');

	function init() {
		//Scripts
		if( !is_admin() ){ //show only in public area
		    add_action('wp_enqueue_scripts',array('WP_FullCalendar','enqueue_scripts'));
			//shortcodes
			add_shortcode('fullcalendar', array('WP_FullCalendar','calendar'));
			add_shortcode('events_fullcalendar', array('WP_FullCalendar','calendar')); //depreciated, will be gone by 1.0
		}else{
			//admin actions
			include('wpfc-admin.php');
		}
		add_action('wp_ajax_WP_FullCalendar', array('WP_FullCalendar','ajax') );
		add_action('wp_ajax_nopriv_WP_FullCalendar', array('WP_FullCalendar','ajax') );
		add_action('wp_ajax_wpfc_qtip_content', array('WP_FullCalendar','qtip_content') );
		add_action('wp_ajax_nopriv_wpfc_qtip_content', array('WP_FullCalendar','qtip_content') );
		//base arguments
		self::$args['type'] = get_option('wpfc_default_type','event');
		//START Events Manager Integration - will soon be removed
		if( defined('EM_VERSION') && is_admin() ){
		    include('wpfc-events-manager.php');
		}
		//END Events Manager Integration
	}
	
	function enqueue_scripts(){
	    global $wp_query;
	    $obj_id = is_home() ? '-1':$wp_query->get_queried_object_id();
	    $wpfc_scripts_limit = get_option('wpfc_scripts_limit');
	    if( empty($wpfc_scripts_limit) || in_array($obj_id, explode(',',$wpfc_scripts_limit)) ){
		    //Scripts
		    wp_enqueue_script('wp-fullcalendar', plugins_url('includes/js/main.js',__FILE__), array('jquery', 'jquery-ui-core','jquery-ui-widget','jquery-ui-position')); //jQuery will load as dependency
			WP_FullCalendar::localize_script();
		    //Styles
		    wp_enqueue_style('wp-fullcalendar', plugins_url('includes/css/main.css',__FILE__));
	    }
	}

	function localize_script(){
		$js_vars = array();
		$js_vars['ajaxurl'] = admin_url('admin-ajax.php');
		$js_vars['firstDay'] =  get_option('start_of_week');
		$js_vars['wpfc_theme'] = get_option('wpfc_theme_css') ? true:false;
		$js_vars['wpfc_limit'] = get_option('wpfc_limit',3);
		$js_vars['wpfc_limit_txt'] = get_option('wpfc_limit_txt','more ...');
		$js_vars['wpfc_theme_css'] = get_option('wpfc_theme_css') ? get_option('wpfc_theme_css'):'';
		//qtip options
		$js_vars['wpfc_qtips'] = get_option('wpfc_qtips',true) == true;
		$js_vars['wpfc_qtips_classes'] = 'ui-tooltip-'. get_option('wpfc_qtips_style','light');
		$js_vars['wpfc_qtips_my'] = get_option('wpfc_qtips_my','top center');
		$js_vars['wpfc_qtips_at'] = get_option('wpfc_qtips_at','bottom center');
		if( get_option('wpfc_qtips_rounded', false) ){
			$js_vars['wpfc_qtips_classes'] .= " ui-tooltip-rounded";
		}
		if( get_option('wpfc_qtips_shadow', true) ){
			$js_vars['wpfc_qtips_classes'] .= " ui-tooltip-shadow";
		}
		//calendar translations
		//This is taken from the Events Manager 5.2+ plugin. Improvements made here will be reflected there and vice-versa
		$locale_code = get_locale();
		$locale_code_short = substr ( $locale_code, 0, 2 );
		$calendar_languages = array(
			'nl'=>array('closeText'=>'Sluiten','prevText'=>'←','nextText'=>'→','currentText'=>'Vandaag','monthNames'=>array('januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december'),'monthNamesShort'=>array('jan','feb','maa','apr','mei','jun','jul','aug','sep','okt','nov','dec'),'dayNames'=>array('zondag','maandag','dinsdag','woensdag','donderdag','vrijdag','zaterdag'),'dayNamesShort'=>array('zon','maa','din','woe','don','vri','zat'),'dayNamesMin'=>array('zo','ma','di','wo','do','vr','za'),'weekHeader'=>'Wk','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'af'=>array('closeText'=>'Selekteer','prevText'=>'Vorige','nextText'=>'Volgende','currentText'=>'Vandag','monthNames'=>array('Januarie','Februarie','Maart','April','Mei','Junie','Julie','Augustus','September','Oktober','November','Desember'),'monthNamesShort'=>array('Jan','Feb','Mrt','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Des'),'dayNames'=>array('Sondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrydag','Saterdag'),'dayNamesShort'=>array('Son','Maa','Din','Woe','Don','Vry','Sat'),'dayNamesMin'=>array('So','Ma','Di','Wo','Do','Vr','Sa'),'weekHeader'=>'Wk','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'ar'=>array('closeText'=>'إغلاق','prevText'=>'<السابق','nextText'=>'التالي>','currentText'=>'اليوم','monthNames'=>array('كانون الثاني','شباط','آذار','نيسان','آذار','حزيران','تموز','آب','أيلول','تشرين الأول','تشرين الثاني','كانون الأول'),'monthNamesShort'=>array('1','2','3','4','5','6','7','8','9','10','11','12'),'dayNames'=>array('السبت','الأحد','الاثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'),'dayNamesShort'=>array('سبت','أحد','اثنين','ثلاثاء','أربعاء','خميس','جمعة'),'dayNamesMin'=>array('سبت','أحد','اثنين','ثلاثاء','أربعاء','خميس','جمعة'),'weekHeader'=>'أسبوع','dateFormat'=>'dd/mm/yy','firstDay'=>0,'isRTL'=>true,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'az'=>array('closeText'=>'Bağla','prevText'=>'<Geri','nextText'=>'İrəli>','currentText'=>'Bugün','monthNames'=>array('Yanvar','Fevral','Mart','Aprel','May','İyun','İyul','Avqust','Sentyabr','Oktyabr','Noyabr','Dekabr'),'monthNamesShort'=>array('Yan','Fev','Mar','Apr','May','İyun','İyul','Avq','Sen','Okt','Noy','Dek'),'dayNames'=>array('Bazar','Bazar ertəsi','Çərşənbə axşamı','Çərşənbə','Cümə axşamı','Cümə','Şənbə'),'dayNamesShort'=>array('B','Be','Ça','Ç','Ca','C','Ş'),'dayNamesMin'=>array('B','B','Ç','С','Ç','C','Ş'),'weekHeader'=>'Hf','dateFormat'=>'dd.mm.yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'bg'=>array('closeText'=>'затвори','prevText'=>'<назад','nextText'=>'напред>','nextBigText'=>'>>','currentText'=>'днес','monthNames'=>array('Януари','Февруари','Март','Април','Май','Юни','Юли','Август','Септември','Октомври','Ноември','Декември'),'monthNamesShort'=>array('Яну','Фев','Мар','Апр','Май','Юни','Юли','Авг','Сеп','Окт','Нов','Дек'),'dayNames'=>array('Неделя','Понеделник','Вторник','Сряда','Четвъртък','Петък','Събота'),'dayNamesShort'=>array('Нед','Пон','Вто','Сря','Чет','Пет','Съб'),'dayNamesMin'=>array('Не','По','Вт','Ср','Че','Пе','Съ'),'weekHeader'=>'Wk','dateFormat'=>'dd.mm.yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'bs'=>array('closeText'=>'Zatvori','prevText'=>'<','nextText'=>'>','currentText'=>'Danas','monthNames'=>array('Januar','Februar','Mart','April','Maj','Juni','Juli','August','Septembar','Oktobar','Novembar','Decembar'),'monthNamesShort'=>array('Jan','Feb','Mar','Apr','Maj','Jun','Jul','Aug','Sep','Okt','Nov','Dec'),'dayNames'=>array('Nedelja','Ponedeljak','Utorak','Srijeda','Četvrtak','Petak','Subota'),'dayNamesShort'=>array('Ned','Pon','Uto','Sri','Čet','Pet','Sub'),'dayNamesMin'=>array('Ne','Po','Ut','Sr','Če','Pe','Su'),'weekHeader'=>'Wk','dateFormat'=>'dd.mm.yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'ca' => array('closeText'=> 'Tancar','prevText'=> '&#x3c;Ant','nextText'=> 'Seg&#x3e;','currentText'=> 'Avui','monthNames'=> array('Gener','Febrer','Mar&ccedil;','Abril','Maig','Juny','Juliol','Agost','Setembre','Octubre','Novembre','Desembre'),'monthNamesShort'=> array('Gen','Feb','Mar','Abr','Mai','Jun','Jul','Ago','Set','Oct','Nov','Des'),'dayNames'=> array('Diumenge','Dilluns','Dimarts','Dimecres','Dijous','Divendres','Dissabte'),'dayNamesShort'=> array('Dug','Dln','Dmt','Dmc','Djs','Dvn','Dsb'),'dayNamesMin'=> array('Dg','Dl','Dt','Dc','Dj','Dv','Ds'),'weekHeader'=> 'Sm','dateFormat'=> 'dd/mm/yy','firstDay'=> 1,'isRTL'=> false,'showMonthAfterYear'=> false,'yearSuffix'=> ''),
			'cs'=>array('closeText'=>'Zavřít','prevText'=>'<Dříve','nextText'=>'Později>','currentText'=>'Nyní','monthNames'=>array('leden','únor','březen','duben','květen','červen','červenec','srpen','září','říjen','listopad','prosinec'),'monthNamesShort'=>array('led','úno','bře','dub','kvě','čer','čvc','srp','zář','říj','lis','pro'),'dayNames'=>array('neděle','pondělí','úterý','středa','čtvrtek','pátek','sobota'),'dayNamesShort'=>array('ne','po','út','st','čt','pá','so'),'dayNamesMin'=>array('ne','po','út','st','čt','pá','so'),'weekHeader'=>'Týd','dateFormat'=>'dd.mm.yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'da'=>array('closeText'=>'Luk','prevText'=>'<Forrige','nextText'=>'Næste>','currentText'=>'Idag','monthNames'=>array('Januar','Februar','Marts','April','Maj','Juni','Juli','August','September','Oktober','November','December'),'monthNamesShort'=>array('Jan','Feb','Mar','Apr','Maj','Jun','Jul','Aug','Sep','Okt','Nov','Dec'),'dayNames'=>array('Søndag','Mandag','Tirsdag','Onsdag','Torsdag','Fredag','Lørdag'),'dayNamesShort'=>array('Søn','Man','Tir','Ons','Tor','Fre','Lør'),'dayNamesMin'=>array('Sø','Ma','Ti','On','To','Fr','Lø'),'weekHeader'=>'Uge','dateFormat'=>'dd-mm-yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'de'=>array('closeText'=>'schließen','prevText'=>'<zurück','nextText'=>'Vor>','currentText'=>'heute','monthNames'=>array('Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'),'monthNamesShort'=>array('Jan','Feb','Mär','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez'),'dayNames'=>array('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'),'dayNamesShort'=>array('So','Mo','Di','Mi','Do','Fr','Sa'),'dayNamesMin'=>array('So','Mo','Di','Mi','Do','Fr','Sa'),'weekHeader'=>'Wo','dateFormat'=>'dd.mm.yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'el'=>array('closeText'=>'Κλείσιμο','prevText'=>'Προηγούμενος','nextText'=>'Επόμενος','currentText'=>'Τρέχων Μήνας','monthNames'=>array('Ιανουάριος','Φεβρουάριος','Μάρτιος','Απρίλιος','Μάιος','Ιούνιος','Ιούλιος','Αύγουστος','Σεπτέμβριος','Οκτώβριος','Νοέμβριος','Δεκέμβριος'),'monthNamesShort'=>array('Ιαν','Φεβ','Μαρ','Απρ','Μαι','Ιουν','Ιουλ','Αυγ','Σεπ','Οκτ','Νοε','Δεκ'),'dayNames'=>array('Κυριακή','Δευτέρα','Τρίτη','Τετάρτη','Πέμπτη','Παρασκευή','Σάββατο'),'dayNamesShort'=>array('Κυρ','Δευ','Τρι','Τετ','Πεμ','Παρ','Σαβ'),'dayNamesMin'=>array('Κυ','Δε','Τρ','Τε','Πε','Πα','Σα'),'weekHeader'=>'Εβδ','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'en_GB'=>array('closeText'=>'Done','prevText'=>'Prev','nextText'=>'Next','currentText'=>'Today','monthNames'=>array('January','February','March','April','May','June','July','August','September','October','November','December'),'monthNamesShort'=>array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'),'dayNames'=>array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'),'dayNamesShort'=>array('Sun','Mon','Tue','Wed','Thu','Fri','Sat'),'dayNamesMin'=>array('Su','Mo','Tu','We','Th','Fr','Sa'),'weekHeader'=>'Wk','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'eo'=>array('closeText'=>'Fermi','prevText'=>'<Anta','nextText'=>'Sekv>','currentText'=>'Nuna','monthNames'=>array('Januaro','Februaro','Marto','Aprilo','Majo','Junio','Julio','Aŭgusto','Septembro','Oktobro','Novembro','Decembro'),'monthNamesShort'=>array('Jan','Feb','Mar','Apr','Maj','Jun','Jul','Aŭg','Sep','Okt','Nov','Dec'),'dayNames'=>array('Dimanĉo','Lundo','Mardo','Merkredo','Ĵaŭdo','Vendredo','Sabato'),'dayNamesShort'=>array('Dim','Lun','Mar','Mer','Ĵaŭ','Ven','Sab'),'dayNamesMin'=>array('Di','Lu','Ma','Me','Ĵa','Ve','Sa'),'weekHeader'=>'Sb','dateFormat'=>'dd/mm/yy','firstDay'=>0,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'et'=>array('closeText'=>'Sulge','prevText'=>'Eelnev','nextText'=>'Järgnev','currentText'=>'Täna','monthNames'=>array('Jaanuar','Veebruar','Märts','Aprill','Mai','Juuni','Juuli','August','September','Oktoober','November','Detsember'),'monthNamesShort'=>array('Jaan','Veebr','Märts','Apr','Mai','Juuni','Juuli','Aug','Sept','Okt','Nov','Dets'),'dayNames'=>array('Pühapäev','Esmaspäev','Teisipäev','Kolmapäev','Neljapäev','Reede','Laupäev'),'dayNamesShort'=>array('Pühap','Esmasp','Teisip','Kolmap','Neljap','Reede','Laup'),'dayNamesMin'=>array('P','E','T','K','N','R','L'),'weekHeader'=>'Sm','dateFormat'=>'dd.mm.yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'eu'=>array('closeText'=>'Egina','prevText'=>'<Aur','nextText'=>'Hur>','currentText'=>'Gaur','monthNames'=>array('Urtarrila','Otsaila','Martxoa','Apirila','Maiatza','Ekaina','Uztaila','Abuztua','Iraila','Urria','Azaroa','Abendua'),'monthNamesShort'=>array('Urt','Ots','Mar','Api','Mai','Eka','Uzt','Abu','Ira','Urr','Aza','Abe'),'dayNames'=>array('Igandea','Astelehena','Asteartea','Asteazkena','Osteguna','Ostirala','Larunbata'),'dayNamesShort'=>array('Iga','Ast','Ast','Ast','Ost','Ost','Lar'),'dayNamesMin'=>array('Ig','As','As','As','Os','Os','La'),'weekHeader'=>'Wk','dateFormat'=>'yy/mm/dd','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'fa'=>array('closeText'=>'بستن','prevText'=>'<قبلي','nextText'=>'بعدي>','currentText'=>'امروز','monthNames'=>array('فروردين','ارديبهشت','خرداد','تير','مرداد','شهريور','مهر','آبان','آذر','دي','بهمن','اسفند'),'monthNamesShort'=>array('1','2','3','4','5','6','7','8','9','10','11','12'),'dayNames'=>array('يکشنبه','دوشنبه','سه‌شنبه','چهارشنبه','پنجشنبه','جمعه','شنبه'),'dayNamesShort'=>array('ي','د','س','چ','پ','ج','ش'),'dayNamesMin'=>array('ي','د','س','چ','پ','ج','ش'),'weekHeader'=>'هف','dateFormat'=>'yy/mm/dd','firstDay'=>6,'isRTL'=>true,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'fi'=>array('closeText'=>'Sulje','prevText'=>'<Edel','nextText'=>'Seur>','currentText'=>'Tänään','monthNames'=>array('Tammikuu','Helmikuu','Maaliskuu','Huhtikuu','Toukokuu','Kesäkuu','Heinäkuu','Elokuu','Syyskuu','Lokakuu','Marraskuu','Joulukuu'),'monthNamesShort'=>array('Tammi','Helmi','Maalis','Huhti','Touko','Kesä','Heinä','Elo','Syys','Loka','Marras','Joulu'),'dayNames'=>array('Sunnuntai','Maanantai','Tiistai','Keskiviikko','Torstai','Perjantai','Lauantai'),'dayNamesShort'=>array('Su','Ma','Ti','Ke','To','Pe','La'),'dayNamesMin'=>array('Su','Ma','Ti','Ke','To','Pe','La'),'weekHeader'=>'Sm','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'fo'=>array('closeText'=>'Lat aftur','prevText'=>'<Fyrra','nextText'=>'Næsta>','currentText'=>'Í dag','monthNames'=>array('Januar','Februar','Mars','Apríl','Mei','Juni','Juli','August','September','Oktober','November','Desember'),'monthNamesShort'=>array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Des'),'dayNames'=>array('Sunnudagur','Mánadagur','Týsdagur','Mikudagur','Hósdagur','Fríggjadagur','Leyardagur'),'dayNamesShort'=>array('Sun','Mán','Týs','Mik','Hós','Frí','Ley'),'dayNamesMin'=>array('Su','Má','Tý','Mi','Hó','Fr','Le'),'weekHeader'=>'Vk','dateFormat'=>'dd-mm-yy','firstDay'=>0,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'fr_CH'=>array('closeText'=>'Fermer','prevText'=>'<Préc','nextText'=>'Suiv>','currentText'=>'Courant','monthNames'=>array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'),'monthNamesShort'=>array('Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'),'dayNames'=>array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'),'dayNamesShort'=>array('Dim','Lun','Mar','Mer','Jeu','Ven','Sam'),'dayNamesMin'=>array('Di','Lu','Ma','Me','Je','Ve','Sa'),'weekHeader'=>'Sm','dateFormat'=>'dd.mm.yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'fr'=>array('closeText'=>'Fermer','prevText'=>'<Préc','nextText'=>'Suiv>','currentText'=>'Courant','monthNames'=>array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'),'monthNamesShort'=>array('Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'),'dayNames'=>array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'),'dayNamesShort'=>array('Dim','Lun','Mar','Mer','Jeu','Ven','Sam'),'dayNamesMin'=>array('Di','Lu','Ma','Me','Je','Ve','Sa'),'weekHeader'=>'Sm','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'he'=>array('closeText'=>'סגור','prevText'=>'<הקודם','nextText'=>'הבא>','currentText'=>'היום','monthNames'=>array('ינואר','פברואר','מרץ','אפריל','מאי','יוני','יולי','אוגוסט','ספטמבר','אוקטובר','נובמבר','דצמבר'),'monthNamesShort'=>array('1','2','3','4','5','6','7','8','9','10','11','12'),'dayNames'=>array('ראשון','שני','שלישי','רביעי','חמישי','שישי','שבת'),'dayNamesShort'=>array('א\'','ב\'','ג\'','ד\'','ה\'','ו\'','שבת'),'dayNamesMin'=>array('א\'','ב\'','ג\'','ד\'','ה\'','ו\'','שבת'),'weekHeader'=>'Wk','dateFormat'=>'dd/mm/yy','firstDay'=>0,'isRTL'=>true,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'hu'=>array('closeText'=>'Kész','prevText'=>'Előző','nextText'=>'Következő','currentText'=>'Ma','monthNames'=>array('január','február','március','április','május','június','július','augusztus','szeptember','október','november','cecember'),'monthNamesShort'=>array('jan','febr','márc','ápr','máj','jún','júl','aug','szept','okt','nov','dec'),'dayNames'=>array('vasárnap','hétfő','kedd','szerda','csütörtök','péntek','szombat'),'dayNamesShort'=>array('va','hé','k','sze','csü','pé','szo'),'dayNamesMin'=>array('v','h','k','sze','cs','p','szo'),'weekHeader'=>'Wk','dateFormat'=>'yy.mm.dd.','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>true,'yearSuffix'=>''),
			'hr'=>array('closeText'=>'Zatvori','prevText'=>'<','nextText'=>'>','currentText'=>'Danas','monthNames'=>array('Siječanj','Veljača','Ožujak','Travanj','Svibanj','Lipanj','Srpanj','Kolovoz','Rujan','Listopad','Studeni','Prosinac'),'monthNamesShort'=>array('Sij','Velj','Ožu','Tra','Svi','Lip','Srp','Kol','Ruj','Lis','Stu','Pro'),'dayNames'=>array('Nedjelja','Ponedjeljak','Utorak','Srijeda','Četvrtak','Petak','Subota'),'dayNamesShort'=>array('Ned','Pon','Uto','Sri','Čet','Pet','Sub'),'dayNamesMin'=>array('Ne','Po','Ut','Sr','Če','Pe','Su'),'weekHeader'=>'Tje','dateFormat'=>'dd.mm.yy.','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'ja'=>array('closeText'=>'閉じる','prevText'=>'<前','nextText'=>'次>','currentText'=>'今日','monthNames'=>array('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'),'monthNamesShort'=>array('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'),'dayNames'=>array('日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'),'dayNamesShort'=>array('日','月','火','水','木','金','土'),'dayNamesMin'=>array('日','月','火','水','木','金','土'),'weekHeader'=>'週','dateFormat'=>'yy/mm/dd','firstDay'=>0,'isRTL'=>false,'showMonthAfterYear'=>true,'yearSuffix'=>'年'),
			'ro'=>array('closeText'=>'Închide','prevText'=>'« Luna precedentă','nextText'=>'Luna următoare »','currentText'=>'Azi','monthNames'=>array('Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'),'monthNamesShort'=>array('Ian','Feb','Mar','Apr','Mai','Iun','Iul','Aug','Sep','Oct','Nov','Dec'),'dayNames'=>array('Duminică','Luni','Marţi','Miercuri','Joi','Vineri','Sâmbătă'),'dayNamesShort'=>array('Dum','Lun','Mar','Mie','Joi','Vin','Sâm'),'dayNamesMin'=>array('Du','Lu','Ma','Mi','Jo','Vi','Sâ'),'weekHeader'=>'Săpt','dateFormat'=>'dd.mm.yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'sk'=>array('closeText'=> 'Zavrieť','prevText'=> '&#x3c;Predchádzajúci','nextText'=> 'Nasledujúci&#x3e;','currentText'=> 'Dnes','monthNames'=> array('Január','Február','Marec','Apríl','Máj','Jún','Júl','August','September','Október','November','December'),'monthNamesShort'=> array('Jan','Feb','Mar','Apr','Máj','Jún','Júl','Aug','Sep','Okt','Nov','Dec'),'dayNames'=> array('Nedel\'a','Pondelok','Utorok','Streda','Štvrtok','Piatok','Sobota'),'dayNamesShort'=> array('Ned','Pon','Uto','Str','Štv','Pia','Sob'),'dayNamesMin'=> array('Ne','Po','Ut','St','Št','Pia','So'),'weekHeader'=> 'Ty','dateFormat'=> 'dd.mm.yy','firstDay'=> 1,'isRTL'=> false,'showMonthAfterYear'=> false,'yearSuffix'=> ''),
			'sq'=>array('closeText'=>'mbylle','prevText'=>'<mbrapa','nextText'=>'Përpara>','currentText'=>'sot','monthNames'=>array('Janar','Shkurt','Mars','Prill','Maj','Qershor','Korrik','Gusht','Shtator','Tetor','Nëntor','Dhjetor'),'monthNamesShort'=>array('Jan','Shk','Mar','Pri','Maj','Qer','Kor','Gus','Sht','Tet','Nën','Dhj'),'dayNames'=>array('E Diel','E Hënë','E Martë','E Mërkurë','E Enjte','E Premte','E Shtune'),'dayNamesShort'=>array('Di','Hë','Ma','Më','En','Pr','Sh'),'dayNamesMin'=>array('Di','Hë','Ma','Më','En','Pr','Sh'),'weekHeader'=>'Ja','dateFormat'=>'dd.mm.yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'sr_SR'=>array('closeText'=>'Zatvori','prevText'=>'<','nextText'=>'>','currentText'=>'Danas','monthNames'=>array('Januar','Februar','Mart','April','Maj','Jun','Jul','Avgust','Septembar','Oktobar','Novembar','Decembar'),'monthNamesShort'=>array('Jan','Feb','Mar','Apr','Maj','Jun','Jul','Avg','Sep','Okt','Nov','Dec'),'dayNames'=>array('Nedelja','Ponedeljak','Utorak','Sreda','Četvrtak','Petak','Subota'),'dayNamesShort'=>array('Ned','Pon','Uto','Sre','Čet','Pet','Sub'),'dayNamesMin'=>array('Ne','Po','Ut','Sr','Če','Pe','Su'),'weekHeader'=>'Sed','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'sr'=>array('closeText'=>'Затвори','prevText'=>'<','nextText'=>'>','currentText'=>'Данас','monthNames'=>array('Јануар','Фебруар','Март','Април','Мај','Јун','Јул','Август','Септембар','Октобар','Новембар','Децембар'),'monthNamesShort'=>array('Јан','Феб','Мар','Апр','Мај','Јун','Јул','Авг','Сеп','Окт','Нов','Дец'),'dayNames'=>array('Недеља','Понедељак','Уторак','Среда','Четвртак','Петак','Субота'),'dayNamesShort'=>array('Нед','Пон','Уто','Сре','Чет','Пет','Суб'),'dayNamesMin'=>array('Не','По','Ут','Ср','Че','Пе','Су'),'weekHeader'=>'Сед','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'sv'=>array('closeText'=>'Stäng','prevText'=>'«Förra','nextText'=>'Nästa»','currentText'=>'Idag','monthNames'=>array('Januari','Februari','Mars','April','Maj','Juni','Juli','Augusti','September','Oktober','November','December'),'monthNamesShort'=>array('Jan','Feb','Mar','Apr','Maj','Jun','Jul','Aug','Sep','Okt','Nov','Dec'),'dayNamesShort'=>array('Sön','Mån','Tis','Ons','Tor','Fre','Lör'),'dayNames'=>array('Söndag','Måndag','Tisdag','Onsdag','Torsdag','Fredag','Lördag'),'dayNamesMin'=>array('Sö','Må','Ti','On','To','Fr','Lö'),'weekHeader'=>'Ve','dateFormat'=>'yy-mm-dd','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'ta'=>array('closeText'=>'மூடு','prevText'=>'முன்னையது','nextText'=>'அடுத்தது','currentText'=>'இன்று','monthNames'=>array('தை','மாசி','பங்குனி','சித்திரை','வைகாசி','ஆனி','ஆடி','ஆவணி','புரட்டாசி','ஐப்பசி','கார்த்திகை','மார்கழி'),'monthNamesShort'=>array('தை','மாசி','பங்','சித்','வைகா','ஆனி','ஆடி','ஆவ','புர','ஐப்','கார்','மார்'),'dayNames'=>array('ஞாயிற்றுக்கிழமை','திங்கட்கிழமை','செவ்வாய்க்கிழமை','புதன்கிழமை','வியாழக்கிழமை','வெள்ளிக்கிழமை','சனிக்கிழமை'),'dayNamesShort'=>array('ஞாயிறு','திங்கள்','செவ்வாய்','புதன்','வியாழன்','வெள்ளி','சனி'),'dayNamesMin'=>array('ஞா','தி','செ','பு','வி','வெ','ச'),'weekHeader'=>'Не','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'th'=>array('closeText'=>'ปิด','prevText'=>'« ย้อน','nextText'=>'ถัดไป »','currentText'=>'วันนี้','monthNames'=>array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'),'monthNamesShort'=>array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'),'dayNames'=>array('อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'),'dayNamesShort'=>array('อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'),'dayNamesMin'=>array('อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'),'weekHeader'=>'Wk','dateFormat'=>'dd/mm/yy','firstDay'=>0,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'vi'=>array('closeText'=>'Đóng','prevText'=>'<Trước','nextText'=>'Tiếp>','currentText'=>'Hôm nay','monthNames'=>array('Tháng Một','Tháng Hai','Tháng Ba','Tháng Tư','Tháng Năm','Tháng Sáu','Tháng Bảy','Tháng Tám','Tháng Chín','Tháng Mười','Tháng Mười Một','Tháng Mười Hai'),'monthNamesShort'=>array('Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'),'dayNames'=>array('Chủ Nhật','Thứ Hai','Thứ Ba','Thứ Tư','Thứ Năm','Thứ Sáu','Thứ Bảy'),'dayNamesShort'=>array('CN','T2','T3','T4','T5','T6','T7'),'dayNamesMin'=>array('CN','T2','T3','T4','T5','T6','T7'),'weekHeader'=>'Tu','dateFormat'=>'dd/mm/yy','firstDay'=>0,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'zh-TW'=>array('closeText'=>'關閉','prevText'=>'<上月','nextText'=>'下月>','currentText'=>'今天','monthNames'=>array('一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'),'monthNamesShort'=>array('一','二','三','四','五','六','七','八','九','十','十一','十二'),'dayNames'=>array('星期日','星期一','星期二','星期三','星期四','星期五','星期六'),'dayNamesShort'=>array('周日','周一','周二','周三','周四','周五','周六'),'dayNamesMin'=>array('日','一','二','三','四','五','六'),'weekHeader'=>'周','dateFormat'=>'yy/mm/dd','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>true,'yearSuffix'=>'年'),
			'es'=>array('closeText'=>'Cerrar','prevText'=>'<Ant','nextText'=>'Sig>','currentText'=>'Hoy','monthNames'=>array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'),'monthNamesShort'=>array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'),'dayNames'=>array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'),'dayNamesShort'=>array('Dom','Lun','Mar','Mié','Juv','Vie','Sáb'),'dayNamesMin'=>array('Do','Lu','Ma','Mi','Ju','Vi','Sá'),'weekHeader'=>'Sm','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'it'=>array('closeText'=>'Fatto','prevText'=>'Precedente','nextText'=>'Prossimo','currentText'=>'Oggi','monthNames'=>array('Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'),'monthNamesShort'=>array('Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic'),'dayNames'=>array('Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato'),'dayNamesShort'=>array('Dom','Lun','Mar','Mer','Gio','Ven','Sab'),'dayNamesMin'=>array('Do','Lu','Ma','Me','Gi','Ve','Sa'),'weekHeader'=>'Wk','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'ru'=>array('closeText'=>'Готово','prevText'=>'Пред.','nextText'=>'След.','currentText'=>'Сегодня','monthNames'=>array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'),'monthNamesShort'=>array('Янв','Фев','Март','Апр','Май','Июнь','Июль','Авг','Сен','Окт','Ноя','Дек'),'dayNames'=>array('Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'),'dayNamesShort'=>array('Вск','Пн','Вт','Ср','Чтв','Птн','Сбт'),'dayNamesMin'=>array('Вс','Пн','Вт','Ср','Чт','Пт','Сб'),'weekHeader'=>'нед','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>''),
			'pt'=>array('closeText'=>'Fechar','prevText'=>'Anterior','nextText'=>'Próximo','currentText'=>'Hoje','monthNames'=>array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'),'monthNamesShort'=>array('Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'),'dayNames'=>array('Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'),'dayNamesShort'=>array('Dom','Seg','Ter','Qua','Qui','Sex','Sáb'),'dayNamesMin'=>array('Do','Se','Te','Qu','Qu','Se','Sa'),'weekHeader'=>'Sem','dateFormat'=>'dd/mm/yy','firstDay'=>1,'isRTL'=>false,'showMonthAfterYear'=>false,'yearSuffix'=>'')
		);
		//extra WP FUllCalendar translations here please:
		$wp_fullcalendar_languages = array(
			'es' => array('buttonText' => array('today'=>'Hoy','month'=>'Mes','week'=>'Semana','day'=>'Dia')),
			'pt' => array('buttonText' => array('today'=>'Hoje','month'=>'Mes','week'=>'Semana','day'=>'Dia')),
			'fr' => array('buttonText' => array('today'=>'Aujourd\'hui','month'=>'Mois','week'=>'Semaine','day'=>'Jour', 'titleFormat'=> array('month'=>'MMMM yyyy','week'=>'\'Du\' d[ MMMM][ yyyy] \'au\' {d MMMM[ yyyy]}','day'=>'dddd d MMMM yyyy'), 'columnFormat'=> array('month'=>'ddd','week'=>'ddd d/M','day'=>'dddd d MMMM yyyy'))),
			'de' => array('buttonText' => array('today'=>'Heute','month'=>'Monat','week'=>'Woche','day'=>'Tag')),
			'it' => array('buttonText' => array('today'=>'Oggi','month'=>'Mese','week'=>'Settimana','day'=>'Giorno')),
			'ru' => array('buttonText' => array('today'=>'Сегодня','month'=>'Месяц','week'=>'Неделя','day'=>'День')),
			'fi' => array('buttonText' => array('today'=>'Tänään','month'=>'Kuukausi','week'=>'Viikko','day'=>'Päivä')),
			'pt' => array('buttonText' => array('today'=>'Hoje','month'=>'Mês','week'=>'Semana','day'=>'Dia')),
		);
		$calendar_languages = array_merge_recursive($calendar_languages, $wp_fullcalendar_languages);
		if( array_key_exists($locale_code, $calendar_languages) ){
		    $js_vars['wpfc_locale'] = $calendar_languages[$locale_code];
		}elseif( array_key_exists($locale_code_short, $calendar_languages) ){
			$js_vars['wpfc_locale'] = $calendar_languages[$locale_code_short];
		}
		$js_vars['wpfc_locale']['firstDay'] =  $js_vars['firstDay']; //override firstDay with wp settings
		apply_filters('wpfc_js_vars', $js_vars);
		wp_localize_script('wp-fullcalendar', 'WPFC', $js_vars);
	}

	/**
	 * Catches ajax requests by fullcalendar
	 */
	function ajax(){
	    global $post;
	    //sort out args
	    unset($_REQUEST['month']); //no need for these two
	    unset($_REQUEST['year']);
	    $args = array ('scope'=>array(date("Y-m-d", $_REQUEST['start']), date("Y-m-d", $_REQUEST['end'])), 'owner'=>false, 'status'=>1, 'order'=>'ASC', 'orderby'=>'post_date');
	    //get post type and taxonomies, determine if we're filtering by taxonomy
	    $post_type = !empty($_REQUEST['type']) ? $_REQUEST['type']:'post';
	    $args['post_type'] = $post_type;
	    if( $args['post_type'] == 'attachment' ) $args['post_status'] = 'inherit';
	    $args['tax_query'] = array();
	    foreach( get_object_taxonomies($post_type) as $taxonomy_name ){
	        if( !empty($_REQUEST[$taxonomy_name]) ){
		    	$args['tax_query'][] = array(
					'taxonomy' => $taxonomy_name,
					'field' => 'id',
					'terms' => $_REQUEST[$taxonomy_name]
				);
	        }
	    }
	    //initiate vars
	    $args = apply_filters('wpfc_fullcalendar_args', array_merge($_REQUEST, $args));
		$limit = get_option('wpfc_limit',3);
	    $items = array();
	    $item_dates_more = array();
	    $item_date_counts = array();
	    
	    //Create our own loop here and tamper with the where sql for date ranges, as per http://codex.wordpress.org/Class_Reference/WP_Query#Time_Parameters
	    function wpfc_temp_filter_where( $where = '' ) {
	    	$where .= " AND post_date >= '".date("Y-m-d", $_REQUEST['start'])."' AND post_date < '".date("Y-m-d", $_REQUEST['end'])."'";
	    	return $where;
	    }
	    add_filter( 'posts_where', 'wpfc_temp_filter_where' );
		$the_query = new WP_Query( $args );
	    remove_filter( 'posts_where', 'wpfc_temp_filter_where' );
	    //loop through each post and slot them into the array of posts to return to browser
	    while ( $the_query->have_posts() ) { $the_query->the_post();
	    	$color = "#a8d144";
	    	$post_date = substr($post->post_date, 0, 10);
	    	$post_timestamp = strtotime($post->post_date);
	    	if( empty($item_date_counts[$post_date]) || $item_date_counts[$post_date] < $limit ){
	    		$title = $post->post_title;
	    		$item = array ("title" => $title, "color" => $color, "start" => date('Y-m-d\TH:i:s', $post_timestamp), "end" => date('Y-m-d\TH:i:s', $post_timestamp), "url" => get_permalink($post->ID), 'post_id' => $post->ID );
	    		$items[] = apply_filters('wpfc_ajax_post', $item, $post);
	    		$item_date_counts[$post_date] = (!empty($item_date_counts[$post_date]) ) ? $item_date_counts[$post_date]+1:1;
	    	}elseif( empty($item_dates_more[$post_date]) ){
	    		$item_dates_more[$post_date] = 1;
	    		$day_ending = $post_date."T23:59:59";
	    		//TODO archives not necesarrily working
	    		$more_array = array ("title" => get_option('wpfc_limit_txt','more ...'), "color" => get_option('wpfc_limit_color','#fbbe30'), "start" => $day_ending, 'post_id' => 0, 'allDay' => true);
	    		global $wp_rewrite;
	    		$archive_url = get_post_type_archive_link($post_type);
	    		if( !empty($archive_url) || $post_type == 'post' ){ //posts do have archives
	    		    $archive_url = trailingslashit($archive_url);
		    		$archive_url .= $wp_rewrite->using_permalinks() ? date('Y/m/', $post_timestamp):'?m='.date('Ym', $post_timestamp);
		    		$more_array['url'] = $archive_url;
	    		}
	    		$items[] = apply_filters('wpfc_ajax_more', $more_array, $post_date);
	    	}
	    }
	    echo json_encode(apply_filters('wpfc_ajax', $items));
	    die(); //normally we'd wp_reset_postdata();
	}

	/**
	 * Called during AJAX request for qtip content for a calendar item 
	 */
	function qtip_content(){
	    $content = '';
		if( !empty($_REQUEST['post_id']) ){
	        $post = get_post($_REQUEST['post_id']);
	        $content = ( !empty($post) ) ? $post->post_content : '';
	        if( get_option('wpfc_qtips_image',1) ){
	            $post_image = get_the_post_thumbnail($post->ID, array(get_option('wpfc_qtip_image_w',75),get_option('wpfc_qtip_image_h',75)));
	            if( !empty($post_image) ){
	                $content = '<div style="float:left; margin:0px 5px 5px 0px;">'.$post_image.'</div>'.$content;
	            }
	        }
	    }
		echo apply_filters('wpfc_qtip_content', $content);
		die();
	}
	
	/**
	 * Returns the calendar HTML setup and primes the js to load at wp_footer
	 * @param array $args
	 * @return string
	 */
	function calendar( $args = array() ){
		if (is_array($args) ) self::$args = array_merge(self::$args, $args);
		self::$args['month'] = (!empty($args['month'])) ? $args['month']-1:date('m', current_time('timestamp'))-1;
		self::$args['year'] = (!empty($args['year'])) ? $args['year']:date('Y', current_time('timestamp'));
		self::$args = apply_filters('wpfc_fullcalendar_args', self::$args);
		add_action('wp_footer', array('WP_FullCalendar','footer_js'));
		ob_start();
		?>
		<div id="wpfc-calendar-wrapper"><form id="wpfc-calendar"></form><div class="wpfc-loading"></div></div>
		<div id="wpfc-calendar-search" style="display:none;">
			<?php
				$post_type = !empty(self::$args['type']) ? self::$args['type']:'post';
				//figure out what taxonomies to show
				$wpfc_post_taxonomies = get_option('wpfc_post_taxonomies');
				$search_taxonomies = !empty($wpfc_post_taxonomies[$post_type]) ? array_keys($wpfc_post_taxonomies[$post_type]):array();
				if( !empty($args['taxonomies']) ){
					//we accept taxonomies in arguments
					$search_taxonomies = explode(',',$args['taxonomies']);
					array_walk($search_taxonomies, 'trim');
					unset(self::$args['taxonomies']);
				}
				//go through each post type taxonomy and display if told to
				foreach( get_object_taxonomies($post_type) as $taxonomy_name ){
					$taxonomy = get_taxonomy($taxonomy_name);
					if( count(get_terms($taxonomy_name, array('hide_empty'=>1))) > 0 && in_array($taxonomy_name, $search_taxonomies) ){
						$default_value = !empty(self::$args[$taxonomy_name]) ? self::$args[$taxonomy_name]:0;
						$taxonomy_args = array( 'echo'=>true, 'hide_empty' => 1, 'name' => $taxonomy_name, 'hierarchical' => true, 'class' => 'wpfc-taxonomy', 'taxonomy' => $taxonomy_name, 'selected'=> $default_value, 'show_option_all' => $taxonomy->labels->all_items);
						wp_dropdown_categories( apply_filters('wpmfc_calendar_taxonomy_args', $taxonomy_args, $taxonomy ) );
					}
				}
				do_action('wpfc_calendar_search', self::$args);
			?>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 * Run at wp_footer if a calendar is output earlier on in the page.
	 * @uses self::$args - which was modified during self::calendar()
	 */
	function footer_js(){
		$r = array();
		?>
		<script type='text/javascript'>
			var wpfc_loaded = false;
			var wpfc_counts = {};
			var wpfc_data = { action : 'WP_FullCalendar'<?php
					//these arguments were assigned earlier on when displaying the calendar, and remain constant between ajax calls
					if(!empty(self::$args)){ echo ", "; }
					$strings = array(); 
					foreach( self::$args as $key => $arg ){
						$arg = is_numeric($arg) ? (int) $arg : "'$arg'"; 
						$strings[] = "'$key'" ." : ". $arg ; 
					}
					echo implode(", ", $strings);
			?> };
			jQuery(document).ready( function($){	
				var fullcalendar_args = {
					timeFormat: '<?php echo get_option('wpfc_timeFormat', 'h(:mm)t'); ?>',
					defaultView: '<?php echo get_option('wpfc_defaultView', 'month'); ?>',
					weekends: <?php echo get_option('wpfc_weekends',true) ? 'true':'false'; ?>,
					header: {
						left: 'prev,next today',
						center: 'title',
						right: '<?php echo implode(',', get_option('wpfc_available_views', array('month','basicWeek','basicDay'))); ?>'
					},
					month: <?php echo self::$args['month']; ?>,
					year: <?php echo self::$args['year']; ?>,
					theme: WPFC.wpfc_theme,
					firstDay: WPFC.firstDay,
					editable: false,
					eventSources: [{
							url : WPFC.ajaxurl,
							data : wpfc_data,
							ignoreTimezone: true,
							allDayDefault: false
					}],
				    eventRender: function(event, element) {
						if( event.post_id > 0 && WPFC.wpfc_qtips == 1 ){
							var event_data = { action : 'wpfc_qtip_content', post_id : event.post_id, event_id:event.event_id };
							element.qtip({
								content:{
									text : 'Loading...',
									ajax : {
										url : WPFC.ajaxurl,
										type : "POST",
										data : event_data
									}
								},
								position : {
									my: WPFC.wpfc_qtips_my,
									at: WPFC.wpfc_qtips_at
								},
								style : { classes:WPFC.wpfc_qtips_classes }
							});
						}
				    },
					loading: function(bool) {
						if (bool) {
							var position = $('#wpfc-calendar').position();
							$('.wpfc-loading').css('left',position.left).css('top',position.top).css('width',$('#calendar').width()).css('height',$('#calendar').height()).show();
						}else {
							wpfc_counts = {};
							$('.wpfc-loading').hide();
						}
					},
					viewDisplay: function(view) {
						if( !wpfc_loaded ){
							$('.fc-header tbody').append('<tr><td id="wpfc-filters"  colspan="3"></td></tr>');
							search_menu = $('#wpfc-calendar-search').show();
							$('#wpfc-filters').append(search_menu);
							//catchall selectmenu handle
							$('select.wpfc-taxonomy').selectmenu({
								format: function(text){
									//replace the color hexes with color boxes
									return text.replace(/#([a-zA-Z0-9]{3}[a-zA-Z0-9]{3}?) - /g, '<span class="wpfc-cat-icon" style="background-color:#$1"></span>');
								},
								open: function(){
									$('.ui-selectmenu-menu').css('z-index','1005');
								}
							}).change(function(event){
								wpfc_data[$(this).attr('name')] = $(this).find(':selected').val();
								$('#wpfc-calendar').fullCalendar('removeEventSource', WPFC.ajaxurl).fullCalendar('addEventSource', {url : WPFC.ajaxurl, allDayDefault:false, ignoreTimezone: true, data : wpfc_data});
							});
						}
						wpfc_loaded = true;
				    }
				};
				if( WPFC.wpfc_locale ){
					$.extend(fullcalendar_args, WPFC.wpfc_locale);
				}
				$(document).trigger('wpfc_fullcalendar_args', [fullcalendar_args]);
				$('#wpfc-calendar').fullCalendar(fullcalendar_args);
				if( WPFC.wpfc_theme_css != '' ){ // add themeroller
					$('script#jquery-ui-css').remove(); //remove old css if exists
					var script = document.createElement("link"); script.id = "jquery-ui-css"; script.rel = "stylesheet"; script.href = WPFC.wpfc_theme_css;
					document.body.appendChild(script);
				}
			});
			//selectmenu @ https://github.com/fnagel/jquery-ui
			(function(e){e.widget("ui.selectmenu",{options:{appendTo:"body",typeAhead:1e3,style:"dropdown",positionOptions:null,width:null,menuWidth:null,handleWidth:26,maxHeight:null,icons:null,format:null,escapeHtml:false,bgImage:function(){}},_create:function(){var t=this,n=this.options;var r=this.element.uniqueId().attr("id");this.ids=[r,r+"-button",r+"-menu"];this._safemouseup=true;this.isOpen=false;this.newelement=e("<a />",{"class":"ui-selectmenu ui-widget ui-state-default ui-corner-all",id:this.ids[1],role:"button",href:"#nogo",tabindex:this.element.attr("disabled")?1:0,"aria-haspopup":true,"aria-owns":this.ids[2]});this.newelementWrap=e("<span />").append(this.newelement).insertAfter(this.element);var i=this.element.attr("tabindex");if(i){this.newelement.attr("tabindex",i)}this.newelement.data("selectelement",this.element);this.selectmenuIcon=e('<span class="ui-selectmenu-icon ui-icon"></span>').prependTo(this.newelement);this.newelement.prepend('<span class="ui-selectmenu-status" />');this.element.bind({"click.selectmenu":function(e){t.newelement.focus();e.preventDefault()}});this.newelement.bind("mousedown.selectmenu",function(e){t._toggle(e,true);if(n.style=="popup"){t._safemouseup=false;setTimeout(function(){t._safemouseup=true},300)}e.preventDefault()}).bind("click.selectmenu",function(e){e.preventDefault()}).bind("keydown.selectmenu",function(n){var r=false;switch(n.keyCode){case e.ui.keyCode.ENTER:r=true;break;case e.ui.keyCode.SPACE:t._toggle(n);break;case e.ui.keyCode.UP:if(n.altKey){t.open(n)}else{t._moveSelection(-1)}break;case e.ui.keyCode.DOWN:if(n.altKey){t.open(n)}else{t._moveSelection(1)}break;case e.ui.keyCode.LEFT:t._moveSelection(-1);break;case e.ui.keyCode.RIGHT:t._moveSelection(1);break;case e.ui.keyCode.TAB:r=true;break;case e.ui.keyCode.PAGE_UP:case e.ui.keyCode.HOME:t.index(0);break;case e.ui.keyCode.PAGE_DOWN:case e.ui.keyCode.END:t.index(t._optionLis.length);break;default:r=true}return r}).bind("keypress.selectmenu",function(e){if(e.which>0){t._typeAhead(e.which,"mouseup")}return true}).bind("mouseover.selectmenu",function(){if(!n.disabled)e(this).addClass("ui-state-hover")}).bind("mouseout.selectmenu",function(){if(!n.disabled)e(this).removeClass("ui-state-hover")}).bind("focus.selectmenu",function(){if(!n.disabled)e(this).addClass("ui-state-focus")}).bind("blur.selectmenu",function(){if(!n.disabled)e(this).removeClass("ui-state-focus")});e(document).bind("mousedown.selectmenu-"+this.ids[0],function(n){if(t.isOpen&&!e(n.target).closest("#"+t.ids[1]).length){t.close(n)}});this.element.bind("click.selectmenu",function(){t._refreshValue()}).bind("focus.selectmenu",function(){if(t.newelement){t.newelement[0].focus()}});if(!n.width){n.width=this.element.outerWidth()}this.newelement.width(n.width);this.element.hide();this.list=e("<ul />",{"class":"ui-widget ui-widget-content","aria-hidden":true,role:"listbox","aria-labelledby":this.ids[1],id:this.ids[2]});this.listWrap=e("<div />",{"class":"ui-selectmenu-menu"}).append(this.list).appendTo(n.appendTo);this.list.bind("keydown.selectmenu",function(n){var r=false;switch(n.keyCode){case e.ui.keyCode.UP:if(n.altKey){t.close(n,true)}else{t._moveFocus(-1)}break;case e.ui.keyCode.DOWN:if(n.altKey){t.close(n,true)}else{t._moveFocus(1)}break;case e.ui.keyCode.LEFT:t._moveFocus(-1);break;case e.ui.keyCode.RIGHT:t._moveFocus(1);break;case e.ui.keyCode.HOME:t._moveFocus(":first");break;case e.ui.keyCode.PAGE_UP:t._scrollPage("up");break;case e.ui.keyCode.PAGE_DOWN:t._scrollPage("down");break;case e.ui.keyCode.END:t._moveFocus(":last");break;case e.ui.keyCode.ENTER:case e.ui.keyCode.SPACE:t.close(n,true);e(n.target).parents("li:eq(0)").trigger("mouseup");break;case e.ui.keyCode.TAB:r=true;t.close(n,true);e(n.target).parents("li:eq(0)").trigger("mouseup");break;case e.ui.keyCode.ESCAPE:t.close(n,true);break;default:r=true}return r}).bind("keypress.selectmenu",function(e){if(e.which>0){t._typeAhead(e.which,"focus")}return true}).bind("mousedown.selectmenu mouseup.selectmenu",function(){return false});e(window).bind("resize.selectmenu-"+this.ids[0],e.proxy(t.close,this))},_init:function(){var t=this,n=this.options;var r=[];this.element.find("option").each(function(){var i=e(this);r.push({value:i.attr("value"),text:t._formatText(i.text(),i),selected:i.attr("selected"),disabled:i.attr("disabled"),classes:i.attr("class"),typeahead:i.attr("typeahead"),parentOptGroup:i.parent("optgroup"),bgImage:n.bgImage.call(i)})});var i=t.options.style=="popup"?" ui-state-active":"";this.list.html("");if(r.length){for(var s=0;s<r.length;s++){var o={role:"presentation"};if(r[s].disabled){o["class"]="ui-state-disabled"}var u={html:r[s].text||" ",href:"#nogo",tabindex:-1,role:"option","aria-selected":false};if(r[s].disabled){u["aria-disabled"]=r[s].disabled}if(r[s].typeahead){u["typeahead"]=r[s].typeahead}var a=e("<a/>",u).bind("focus.selectmenu",function(){e(this).parent().mouseover()}).bind("blur.selectmenu",function(){e(this).parent().mouseout()});var f=e("<li/>",o).append(a).data("index",s).addClass(r[s].classes).data("optionClasses",r[s].classes||"").bind("mouseup.selectmenu",function(n){if(t._safemouseup&&!t._disabled(n.currentTarget)&&!t._disabled(e(n.currentTarget).parents("ul > li.ui-selectmenu-group "))){t.index(e(this).data("index"));t.select(n);t.close(n,true)}return false}).bind("click.selectmenu",function(){return false}).bind("mouseover.selectmenu",function(n){if(!e(this).hasClass("ui-state-disabled")&&!e(this).parent("ul").parent("li").hasClass("ui-state-disabled")){n.optionValue=t.element[0].options[e(this).data("index")].value;t._trigger("hover",n,t._uiHash());t._selectedOptionLi().addClass(i);t._focusedOptionLi().removeClass("ui-selectmenu-item-focus ui-state-hover");e(this).removeClass("ui-state-active").addClass("ui-selectmenu-item-focus ui-state-hover")}}).bind("mouseout.selectmenu",function(n){if(e(this).is(t._selectedOptionLi())){e(this).addClass(i)}n.optionValue=t.element[0].options[e(this).data("index")].value;t._trigger("blur",n,t._uiHash());e(this).removeClass("ui-selectmenu-item-focus ui-state-hover")});if(r[s].parentOptGroup.length){var l="ui-selectmenu-group-"+this.element.find("optgroup").index(r[s].parentOptGroup);if(this.list.find("li."+l).length){this.list.find("li."+l+":last ul").append(f)}else{e('<li role="presentation" class="ui-selectmenu-group '+l+(r[s].parentOptGroup.attr("disabled")?" "+'ui-state-disabled" aria-disabled="true"':'"')+'><span class="ui-selectmenu-group-label">'+r[s].parentOptGroup.attr("label")+"</span><ul></ul></li>").appendTo(this.list).find("ul").append(f)}}else{f.appendTo(this.list)}if(n.icons){for(var c in n.icons){if(f.is(n.icons[c].find)){f.data("optionClasses",r[s].classes+" ui-selectmenu-hasIcon").addClass("ui-selectmenu-hasIcon");var h=n.icons[c].icon||"";f.find("a:eq(0)").prepend('<span class="ui-selectmenu-item-icon ui-icon '+h+'"></span>');if(r[s].bgImage){f.find("span").css("background-image",r[s].bgImage)}}}}}}else{e(' <li role="presentation"><a href="#nogo" tabindex="-1" role="option"></a></li>').appendTo(this.list)}var p=n.style=="dropdown";this.newelement.toggleClass("ui-selectmenu-dropdown",p).toggleClass("ui-selectmenu-popup",!p);this.list.toggleClass("ui-selectmenu-menu-dropdown ui-corner-bottom",p).toggleClass("ui-selectmenu-menu-popup ui-corner-all",!p).find("li:first").toggleClass("ui-corner-top",!p).end().find("li:last").addClass("ui-corner-bottom");this.selectmenuIcon.toggleClass("ui-icon-triangle-1-s",p).toggleClass("ui-icon-triangle-2-n-s",!p);if(n.style=="dropdown"){this.list.width(n.menuWidth?n.menuWidth:n.width)}else{this.list.width(n.menuWidth?n.menuWidth:n.width-n.handleWidth)}this.list.css("height","auto");var d=this.listWrap.height();var v=e(window).height();var m=n.maxHeight?Math.min(n.maxHeight,v):v/3;if(d>m)this.list.height(m);this._optionLis=this.list.find("li:not(.ui-selectmenu-group)");if(this.element.attr("disabled")){this.disable()}else{this.enable()}this._refreshValue();this._selectedOptionLi().addClass("ui-selectmenu-item-focus");clearTimeout(this.refreshTimeout);this.refreshTimeout=window.setTimeout(function(){t._refreshPosition()},200)},destroy:function(){this.element.removeData(this.widgetName).removeClass("ui-selectmenu-disabled"+" "+"ui-state-disabled").removeAttr("aria-disabled").unbind(".selectmenu");e(window).unbind(".selectmenu-"+this.ids[0]);e(document).unbind(".selectmenu-"+this.ids[0]);this.newelementWrap.remove();this.listWrap.remove();this.element.unbind(".selectmenu").show();e.Widget.prototype.destroy.apply(this,arguments)},_typeAhead:function(e,t){var n=this,r=String.fromCharCode(e).toLowerCase(),i=null,s=null;if(n._typeAhead_timer){window.clearTimeout(n._typeAhead_timer);n._typeAhead_timer=undefined}n._typeAhead_chars=(n._typeAhead_chars===undefined?"":n._typeAhead_chars).concat(r);if(n._typeAhead_chars.length<2||n._typeAhead_chars.substr(-2,1)===r&&n._typeAhead_cycling){n._typeAhead_cycling=true;i=r}else{n._typeAhead_cycling=false;i=n._typeAhead_chars}var o=(t!=="focus"?this._selectedOptionLi().data("index"):this._focusedOptionLi().data("index"))||0;for(var u=0;u<this._optionLis.length;u++){var a=this._optionLis.eq(u).text().substr(0,i.length).toLowerCase();if(a===i){if(n._typeAhead_cycling){if(s===null)s=u;if(u>o){s=u;break}}else{s=u}}}if(s!==null){this._optionLis.eq(s).find("a").trigger(t)}n._typeAhead_timer=window.setTimeout(function(){n._typeAhead_timer=undefined;n._typeAhead_chars=undefined;n._typeAhead_cycling=undefined},n.options.typeAhead)},_uiHash:function(){var t=this.index();return{index:t,option:e("option",this.element).get(t),value:this.element[0].value}},open:function(e){if(this.newelement.attr("aria-disabled")!="true"){var t=this,n=this.options,r=this._selectedOptionLi(),i=r.find("a");t._closeOthers(e);t.newelement.addClass("ui-state-active");t.list.attr("aria-hidden",false);t.listWrap.addClass("ui-selectmenu-open");if(n.style=="dropdown"){t.newelement.removeClass("ui-corner-all").addClass("ui-corner-top")}else{this.list.css("left",-5e3).scrollTop(this.list.scrollTop()+r.position().top-this.list.outerHeight()/2+r.outerHeight()/2).css("left","auto")}t._refreshPosition();if(i.length){i[0].focus()}t.isOpen=true;t._trigger("open",e,t._uiHash())}},close:function(e,t){if(this.newelement.is(".ui-state-active")){this.newelement.removeClass("ui-state-active");this.listWrap.removeClass("ui-selectmenu-open");this.list.attr("aria-hidden",true);if(this.options.style=="dropdown"){this.newelement.removeClass("ui-corner-top").addClass("ui-corner-all")}if(t){this.newelement.focus()}this.isOpen=false;this._trigger("close",e,this._uiHash())}},change:function(e){this.element.trigger("change");this._trigger("change",e,this._uiHash())},select:function(e){if(this._disabled(e.currentTarget)){return false}this._trigger("select",e,this._uiHash())},widget:function(){return this.listWrap.add(this.newelementWrap)},_closeOthers:function(t){e(".ui-selectmenu.ui-state-active").not(this.newelement).each(function(){e(this).data("selectelement").selectmenu("close",t)});e(".ui-selectmenu.ui-state-hover").trigger("mouseout")},_toggle:function(e,t){if(this.isOpen){this.close(e,t)}else{this.open(e)}},_formatText:function(t,n){if(this.options.format){t=this.options.format(t,n)}else if(this.options.escapeHtml){t=e("<div />").text(t).html()}return t},_selectedIndex:function(){return this.element[0].selectedIndex},_selectedOptionLi:function(){return this._optionLis.eq(this._selectedIndex())},_focusedOptionLi:function(){return this.list.find(".ui-selectmenu-item-focus")},_moveSelection:function(e,t){if(!this.options.disabled){var n=parseInt(this._selectedOptionLi().data("index")||0,10);var r=n+e;if(r<0){r=0}if(r>this._optionLis.size()-1){r=this._optionLis.size()-1}if(r===t){return false}if(this._optionLis.eq(r).hasClass("ui-state-disabled")){e>0?++e:--e;this._moveSelection(e,r)}else{this._optionLis.eq(r).trigger("mouseover").trigger("mouseup")}}},_moveFocus:function(e,t){if(!isNaN(e)){var n=parseInt(this._focusedOptionLi().data("index")||0,10);var r=n+e}else{var r=parseInt(this._optionLis.filter(e).data("index"),10)}if(r<0){r=0}if(r>this._optionLis.size()-1){r=this._optionLis.size()-1}if(r===t){return false}var i="ui-selectmenu-item-"+Math.round(Math.random()*1e3);this._focusedOptionLi().find("a:eq(0)").attr("id","");if(this._optionLis.eq(r).hasClass("ui-state-disabled")){e>0?++e:--e;this._moveFocus(e,r)}else{this._optionLis.eq(r).find("a:eq(0)").attr("id",i).focus()}this.list.attr("aria-activedescendant",i)},_scrollPage:function(e){var t=Math.floor(this.list.outerHeight()/this._optionLis.first().outerHeight());t=e=="up"?-t:t;this._moveFocus(t)},_setOption:function(e,t){this.options[e]=t;if(e=="disabled"){if(t)this.close();this.element.add(this.newelement).add(this.list)[t?"addClass":"removeClass"]("ui-selectmenu-disabled "+"ui-state-disabled").attr("aria-disabled",t)}},disable:function(e,t){if(typeof e=="undefined"){this._setOption("disabled",true)}else{if(t=="optgroup"){this._toggleOptgroup(e,false)}else{this._toggleOption(e,false)}}},enable:function(e,t){if(typeof e=="undefined"){this._setOption("disabled",false)}else{if(t=="optgroup"){this._toggleOptgroup(e,true)}else{this._toggleOption(e,true)}}},_disabled:function(t){return e(t).hasClass("ui-state-disabled")},_toggleOption:function(e,t){var n=this._optionLis.eq(e);if(n){n.toggleClass("ui-state-disabled",t).find("a").attr("aria-disabled",!t);if(t){this.element.find("option").eq(e).attr("disabled","disabled")}else{this.element.find("option").eq(e).removeAttr("disabled")}}},_toggleOptgroup:function(e,t){var n=this.list.find("li.ui-selectmenu-group-"+e);if(n){n.toggleClass("ui-state-disabled",t).attr("aria-disabled",!t);if(t){this.element.find("optgroup").eq(e).attr("disabled","disabled")}else{this.element.find("optgroup").eq(e).removeAttr("disabled")}}},index:function(t){if(arguments.length){if(!this._disabled(e(this._optionLis[t]))&&t!=this._selectedIndex()){this.element[0].selectedIndex=t;this._refreshValue();this.change()}else{return false}}else{return this._selectedIndex()}},value:function(e){if(arguments.length&&e!=this.element[0].value){this.element[0].value=e;this._refreshValue();this.change()}else{return this.element[0].value}},_refreshValue:function(){var e=this.options.style=="popup"?" ui-state-active":"";var t="ui-selectmenu-item-"+Math.round(Math.random()*1e3);this.list.find(".ui-selectmenu-item-selected").removeClass("ui-selectmenu-item-selected"+e).find("a").attr("aria-selected","false").attr("id","");this._selectedOptionLi().addClass("ui-selectmenu-item-selected"+e).find("a").attr("aria-selected","true").attr("id",t);var n=this.newelement.data("optionClasses")?this.newelement.data("optionClasses"):"";var r=this._selectedOptionLi().data("optionClasses")?this._selectedOptionLi().data("optionClasses"):"";this.newelement.removeClass(n).data("optionClasses",r).addClass(r).find(".ui-selectmenu-status").html(this._selectedOptionLi().find("a:eq(0)").html());this.list.attr("aria-activedescendant",t)},_refreshPosition:function(){var t=this.options,n={of:this.newelement,my:"left top",at:"left bottom",collision:"flip"};if(t.style=="popup"){var r=this._selectedOptionLi();n.my="left top"+(this.list.offset().top-r.offset().top-(this.newelement.outerHeight()+r.outerHeight())/2);n.collision="fit"}this.listWrap.removeAttr("style").zIndex(this.element.zIndex()+2).position(e.extend(n,t.positionOptions))}})})(jQuery)
		</script>
		<?php
	}
}
add_action('plugins_loaded',array('WP_FullCalendar','init'), 100);

// action links
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'wpfc_settings_link', 10, 1);
function wpfc_settings_link($links) {
	$new_links = array(); //put settings first
	$new_links[] = '<a href="'.admin_url('options-general.php?page=wp-fullcalendar').'">'.__('Settings', 'wpfc').'</a>';
	return array_merge($new_links,$links);
}

//translations
load_plugin_textdomain('wpfc', false, dirname( plugin_basename( __FILE__ ) ).'/includes/langs');