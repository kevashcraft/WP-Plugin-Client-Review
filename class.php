<?php
class clientreview {
	public static function activate() {

		// Create Tables
		global $wpdb;
		$table = $wpdb->prefix . 'cr_reviews';
		$stmt = "CREATE TABLE $table(
			id INT UNSIGNED AUTO_INCREMENT,
			business_name VARCHAR(256),
			website VARCHAR(128),
			responsive_design CHAR(4),
			responsive_design_n VARCHAR(256),
			custom_favicon CHAR(4),
			custom_favicon_n VARCHAR(256),
			clean_logo CHAR(4),
			clean_logo_n VARCHAR(256),
			apparant_direction CHAR(4),
			apparant_direction_n VARCHAR(256),
			easy_to_use CHAR(4),
			easy_to_use_n VARCHAR(256),
			stylish CHAR(4),
			stylish_n VARCHAR(256),
			page_speed CHAR(4),
			page_speed_n VARCHAR(256),
			offers_ssl CHAR(4),
			offers_ssl_n VARCHAR(256),
			sql_injection CHAR(4),
			sql_injection_n VARCHAR(256),
			bruteforce_attack CHAR(4),
			bruteforce_attack_n VARCHAR(256),
			dos_attack CHAR(4),
			dos_attack_n VARCHAR(256),
			secure_admin_page CHAR(4),
			secure_admin_page_n VARCHAR(256),
			targeted_keywords_n VARCHAR(256),
			targeted_keywords CHAR(4),
			optimized_titles_n VARCHAR(256),
			optimized_titles CHAR(4),
			optimized_content_n VARCHAR(256),
			optimized_content CHAR(4),
			optimized_descriptions_n VARCHAR(256),
			optimized_descriptions CHAR(4),
			optimized_images_n VARCHAR(256),
			optimized_images CHAR(4),
			gp_exists_n VARCHAR(256),
			gp_exists CHAR(4),
			gp_moderated_n VARCHAR(256),
			gp_moderated CHAR(4),
			gp_logo_n VARCHAR(256),
			gp_logo CHAR(4),
			gp_stylish_n VARCHAR(256),
			gp_stylish CHAR(4),
			gp_active_n VARCHAR(256),
			gp_active CHAR(4),
			tw_exists_n VARCHAR(256),
			tw_exists CHAR(4),
			tw_moderated_n VARCHAR(256),
			tw_moderated CHAR(4),
			tw_logo_n VARCHAR(256),
			tw_logo CHAR(4),
			tw_stylish_n VARCHAR(256),
			tw_stylish CHAR(4),
			tw_active_n VARCHAR(256),
			tw_active CHAR(4),
			fb_active_n VARCHAR(256),
			fb_active CHAR(4),
			fb_exists_n VARCHAR(256),
			fb_exists CHAR(4),
			fb_moderated_n VARCHAR(256),
			fb_moderated CHAR(4),
			fb_logo_n VARCHAR(256),
			fb_logo CHAR(4),
			fb_stylish_n VARCHAR(256),
			fb_stylish CHAR(4),
			fs_exists CHAR(4),
			fs_exists_n VARCHAR(256),
			fs_logo_n VARCHAR(256),
			fs_logo CHAR(4),
			fs_active_n VARCHAR(256),
			fs_active CHAR(4),
			fs_moderated_n VARCHAR(256),
			fs_moderated CHAR(4),
			access_code CHAR(7),
			PRIMARY KEY  (id)
		);";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($stmt);
	}
	public static function deactivate() {
		global $wpdb;
		$stmt = "DROP TABLE IF EXISTS reviews";
		$wpdb->query($stmt);
	}
	public static function adminmenu() {
		add_menu_page( 'Client Review', 'Client Reviews', 'edit_plugins', 'client-reviews', array('clientreview', 'editreviews'),"",26);
		add_submenu_page('client-reviews', 'Add a New Client Review', 'Add New', 'edit_plugins', 'client-reviews-add-new', array('clientreview', 'addareview'));
	}		
	public static function editreviews() {
		global $wpdb;
		if(!empty($_GET['cr_id'])) { 
				$id = (int)$_GET['cr_id'];
				$table = $wpdb->prefix . 'cr_reviews';
				$stmt = "SELECT * FROM $table WHERE id=$id";
				$result = $wpdb->get_row($stmt, OBJECT);
				?>
		<h1>Online Presence Evaluation</h1>
		<h2><? echo $result->business_name ?></h2>		
		<h3><? echo $result->website ?></h3>		
		<form id="cr_edit_form">
		Business Name <input type="text" name="business_name" value="<? echo $result->business_name ?>"><br>
		Website <input type="text" name="website" value="<? echo $result->website ?>"><br>
		<h3>Search Engine Optimization (SEO)</h3>				
					<ul>				
		<li><span>Does your content contain optimized keywords?</span>
					<input type='radio' name='targeted_keywords' <? if($result->targeted_keywords == 'PASS') echo 'checked=\'checked\''; ?> id='P_targeted_keywords' value='PASS'><label for='P_targeted_keywords'>Pass</label> / 
					<input type='radio' name='targeted_keywords' <? if($result->targeted_keywords == 'FAIL') echo 'checked=\'checked\''; ?> id='F_targeted_keywords' value='FAIL'><label for='F_targeted_keywords'>Fail</label> / 
					<input type='radio' name='targeted_keywords' <? if($result->targeted_keywords == 'UNKN') echo 'checked=\'checked\''; ?> id='U_targeted_keywords' value='UNKN'><label for='U_targeted_keywords'>Unknown</label>
					<span><input type='text' name='targeted_keywords_n' value="<? echo $result->targeted_keywords_n ?>"></span></li><li><span>Does your content contain optimized titles?</span>
					<input type='radio' name='optimized_titles' <? if($result->optimized_titles == 'PASS') echo 'checked=\'checked\''; ?> id='P_optimized_titles' value='PASS'><label for='P_optimized_titles'>Pass</label> / 
					<input type='radio' name='optimized_titles' <? if($result->optimized_titles == 'FAIL') echo 'checked=\'checked\''; ?> id='F_optimized_titles' value='FAIL'><label for='F_optimized_titles'>Fail</label> / 
					<input type='radio' name='optimized_titles' <? if($result->optimized_titles == 'UNKN') echo 'checked=\'checked\''; ?> id='U_optimized_titles' value='UNKN'><label for='U_optimized_titles'>Unknown</label>
					<span><input type='text' name='optimized_titles_n' value="<? echo $result->optimized_titles_n ?>"></span></li><li><span>Is your website content optimized?</span>
					<input type='radio' name='optimized_content' <? if($result->optimized_content == 'PASS') echo 'checked=\'checked\''; ?> id='P_optimized_content' value='PASS'><label for='P_optimized_content'>Pass</label> / 
					<input type='radio' name='optimized_content' <? if($result->optimized_content == 'FAIL') echo 'checked=\'checked\''; ?> id='F_optimized_content' value='FAIL'><label for='F_optimized_content'>Fail</label> / 
					<input type='radio' name='optimized_content' <? if($result->optimized_content == 'UNKN') echo 'checked=\'checked\''; ?> id='U_optimized_content' value='UNKN'><label for='U_optimized_content'>Unknown</label>
					<span><input type='text' name='optimized_content_n' value="<? echo $result->optimized_content_n ?>"></span></li><li><span>Does your website contain optimized descriptions?</span>
					<input type='radio' name='optimized_descriptions' <? if($result->optimized_descriptions == 'PASS') echo 'checked=\'checked\''; ?> id='P_optimized_descriptions' value='PASS'><label for='P_optimized_descriptions'>Pass</label> / 
					<input type='radio' name='optimized_descriptions' <? if($result->optimized_descriptions == 'FAIL') echo 'checked=\'checked\''; ?> id='F_optimized_descriptions' value='FAIL'><label for='F_optimized_descriptions'>Fail</label> / 
					<input type='radio' name='optimized_descriptions' <? if($result->optimized_descriptions == 'UNKN') echo 'checked=\'checked\''; ?> id='U_optimized_descriptions' value='UNKN'><label for='U_optimized_descriptions'>Unknown</label>
					<span><input type='text' name='optimized_descriptions_n' value="<? echo $result->optimized_descriptions_n ?>"></span></li><li><span>Do you images have optimized titles and alts?</span>
					<input type='radio' name='optimized_images' <? if($result->optimized_images == 'PASS') echo 'checked=\'checked\''; ?> id='P_optimized_images' value='PASS'><label for='P_optimized_images'>Pass</label> / 
					<input type='radio' name='optimized_images' <? if($result->optimized_images == 'FAIL') echo 'checked=\'checked\''; ?> id='F_optimized_images' value='FAIL'><label for='F_optimized_images'>Fail</label> / 
					<input type='radio' name='optimized_images' <? if($result->optimized_images == 'UNKN') echo 'checked=\'checked\''; ?> id='U_optimized_images' value='UNKN'><label for='U_optimized_images'>Unknown</label>
					<span><input type='text' name='optimized_images_n' value="<? echo $result->optimized_images_n ?>"></span></li>			</ul>			
				<h3>User Experience (UX)</h3>
					<ul>				
		<li><span>Is your design responsive?</span>
					<input type='radio' name='responsive_design' <? if($result->responsive_design == 'PASS') echo 'checked=\'checked\''; ?> id='P_responsive_design' value='PASS'><label for='P_responsive_design'>Pass</label> / 
					<input type='radio' name='responsive_design' <? if($result->responsive_design == 'FAIL') echo 'checked=\'checked\''; ?> id='F_responsive_design' value='FAIL'><label for='F_responsive_design'>Fail</label> / 
					<input type='radio' name='responsive_design' <? if($result->responsive_design == 'UNKN') echo 'checked=\'checked\''; ?> id='U_responsive_design' value='UNKN'><label for='U_responsive_design'>Unknown</label>
					<span><input type='text' name='responsive_design_n' value="<? echo $result->responsive_design_n ?>"></span></li><li><span>Do you have a customized Favicon?</span>
					<input type='radio' name='custom_favicon' <? if($result->custom_favicon == 'PASS') echo 'checked=\'checked\''; ?> id='P_custom_favicon' value='PASS'><label for='P_custom_favicon'>Pass</label> / 
					<input type='radio' name='custom_favicon' <? if($result->custom_favicon == 'FAIL') echo 'checked=\'checked\''; ?> id='F_custom_favicon' value='FAIL'><label for='F_custom_favicon'>Fail</label> / 
					<input type='radio' name='custom_favicon' <? if($result->custom_favicon == 'UNKN') echo 'checked=\'checked\''; ?> id='U_custom_favicon' value='UNKN'><label for='U_custom_favicon'>Unknown</label>
					<span><input type='text' name='custom_favicon_n' value="<? echo $result->custom_favicon_n ?>"></span></li><li><span>Do you have a clean, customized logo?</span>
					<input type='radio' name='clean_logo' <? if($result->clean_logo == 'PASS') echo 'checked=\'checked\''; ?> id='P_clean_logo' value='PASS'><label for='P_clean_logo'>Pass</label> / 
					<input type='radio' name='clean_logo' <? if($result->clean_logo == 'FAIL') echo 'checked=\'checked\''; ?> id='F_clean_logo' value='FAIL'><label for='F_clean_logo'>Fail</label> / 
					<input type='radio' name='clean_logo' <? if($result->clean_logo == 'UNKN') echo 'checked=\'checked\''; ?> id='U_clean_logo' value='UNKN'><label for='U_clean_logo'>Unknown</label>
					<span><input type='text' name='clean_logo_n' value="<? echo $result->clean_logo_n ?>"></span></li><li><span>Does your website apparently direct users?</span>
					<input type='radio' name='apparant_direction' <? if($result->apparant_direction == 'PASS') echo 'checked=\'checked\''; ?> id='P_apparant_direction' value='PASS'><label for='P_apparant_direction'>Pass</label> / 
					<input type='radio' name='apparant_direction' <? if($result->apparant_direction == 'FAIL') echo 'checked=\'checked\''; ?> id='F_apparant_direction' value='FAIL'><label for='F_apparant_direction'>Fail</label> / 
					<input type='radio' name='apparant_direction' <? if($result->apparant_direction == 'UNKN') echo 'checked=\'checked\''; ?> id='U_apparant_direction' value='UNKN'><label for='U_apparant_direction'>Unknown</label>
					<span><input type='text' name='apparant_direction_n' value="<? echo $result->apparant_direction_n ?>"></span></li><li><span>Is your website easy to use?</span>
					<input type='radio' name='easy_to_use' <? if($result->easy_to_use == 'PASS') echo 'checked=\'checked\''; ?> id='P_easy_to_use' value='PASS'><label for='P_easy_to_use'>Pass</label> / 
					<input type='radio' name='easy_to_use' <? if($result->easy_to_use == 'FAIL') echo 'checked=\'checked\''; ?> id='F_easy_to_use' value='FAIL'><label for='F_easy_to_use'>Fail</label> / 
					<input type='radio' name='easy_to_use' <? if($result->easy_to_use == 'UNKN') echo 'checked=\'checked\''; ?> id='U_easy_to_use' value='UNKN'><label for='U_easy_to_use'>Unknown</label>
					<span><input type='text' name='easy_to_use_n' value="<? echo $result->easy_to_use_n ?>"></span></li><li><span>Is your website stylish and modern?</span>
					<input type='radio' name='stylish' <? if($result->stylish == 'PASS') echo 'checked=\'checked\''; ?> id='P_stylish' value='PASS'><label for='P_stylish'>Pass</label> / 
					<input type='radio' name='stylish' <? if($result->stylish == 'FAIL') echo 'checked=\'checked\''; ?> id='F_stylish' value='FAIL'><label for='F_stylish'>Fail</label> / 
					<input type='radio' name='stylish' <? if($result->stylish == 'UNKN') echo 'checked=\'checked\''; ?> id='U_stylish' value='UNKN'><label for='U_stylish'>Unknown</label>
					<span><input type='text' name='stylish_n' value="<? echo $result->stylish_n ?>"></span></li><li><span>Is your past speed fast enough?</span>
					<input type='radio' name='page_speed' <? if($result->page_speed == 'PASS') echo 'checked=\'checked\''; ?> id='P_page_speed' value='PASS'><label for='P_page_speed'>Pass</label> / 
					<input type='radio' name='page_speed' <? if($result->page_speed == 'FAIL') echo 'checked=\'checked\''; ?> id='F_page_speed' value='FAIL'><label for='F_page_speed'>Fail</label> / 
					<input type='radio' name='page_speed' <? if($result->page_speed == 'UNKN') echo 'checked=\'checked\''; ?> id='U_page_speed' value='UNKN'><label for='U_page_speed'>Unknown</label>
					<span><input type='text' name='page_speed_n' value="<? echo $result->page_speed_n ?>"></span></li>	</ul>	
				<h3>Security</h3>				
					<ul>				
		<li><span>Does your website offer SSL Connections?</span>
					<input type='radio' name='offers_ssl' <? if($result->offers_ssl == 'PASS') echo 'checked=\'checked\''; ?> id='P_offers_ssl' value='PASS'><label for='P_offers_ssl'>Pass</label> / 
					<input type='radio' name='offers_ssl' <? if($result->offers_ssl == 'FAIL') echo 'checked=\'checked\''; ?> id='F_offers_ssl' value='FAIL'><label for='F_offers_ssl'>Fail</label> / 
					<input type='radio' name='offers_ssl' <? if($result->offers_ssl == 'UNKN') echo 'checked=\'checked\''; ?> id='U_offers_ssl' value='UNKN'><label for='U_offers_ssl'>Unknown</label>
					<span><input type='text' name='offers_ssl_n' value="<? echo $result->offers_ssl_n ?>"></span></li><li><span>Is your website safe from SQL Injection?</span>
					<input type='radio' name='sql_injection' <? if($result->sql_injection == 'PASS') echo 'checked=\'checked\''; ?> id='P_sql_injection' value='PASS'><label for='P_sql_injection'>Pass</label> / 
					<input type='radio' name='sql_injection' <? if($result->sql_injection == 'FAIL') echo 'checked=\'checked\''; ?> id='F_sql_injection' value='FAIL'><label for='F_sql_injection'>Fail</label> / 
					<input type='radio' name='sql_injection' <? if($result->sql_injection == 'UNKN') echo 'checked=\'checked\''; ?> id='U_sql_injection' value='UNKN'><label for='U_sql_injection'>Unknown</label>
					<span><input type='text' name='sql_injection_n' value="<? echo $result->sql_injection_n ?>"></span></li><li><span>Is your website safe from BruteForce Attacks?</span>
					<input type='radio' name='bruteforce_attack' <? if($result->bruteforce_attack == 'PASS') echo 'checked=\'checked\''; ?> id='P_bruteforce_attack' value='PASS'><label for='P_bruteforce_attack'>Pass</label> / 
					<input type='radio' name='bruteforce_attack' <? if($result->bruteforce_attack == 'FAIL') echo 'checked=\'checked\''; ?> id='F_bruteforce_attack' value='FAIL'><label for='F_bruteforce_attack'>Fail</label> / 
					<input type='radio' name='bruteforce_attack' <? if($result->bruteforce_attack == 'UNKN') echo 'checked=\'checked\''; ?> id='U_bruteforce_attack' value='UNKN'><label for='U_bruteforce_attack'>Unknown</label>
					<span><input type='text' name='bruteforce_attack_n' value="<? echo $result->bruteforce_attack_n ?>"></span></li><li><span>Is your website safe from DOS Attacks?</span>
					<input type='radio' name='dos_attack' <? if($result->dos_attack == 'PASS') echo 'checked=\'checked\''; ?> id='P_dos_attack' value='PASS'><label for='P_dos_attack'>Pass</label> / 
					<input type='radio' name='dos_attack' <? if($result->dos_attack == 'FAIL') echo 'checked=\'checked\''; ?> id='F_dos_attack' value='FAIL'><label for='F_dos_attack'>Fail</label> / 
					<input type='radio' name='dos_attack' <? if($result->dos_attack == 'UNKN') echo 'checked=\'checked\''; ?> id='U_dos_attack' value='UNKN'><label for='U_dos_attack'>Unknown</label>
					<span><input type='text' name='dos_attack_n' value="<? echo $result->dos_attack_n ?>"></span></li><li><span>Do you have a secure admin page?</span>
					<input type='radio' name='secure_admin_page' <? if($result->secure_admin_page == 'PASS') echo 'checked=\'checked\''; ?> id='P_secure_admin_page' value='PASS'><label for='P_secure_admin_page'>Pass</label> / 
					<input type='radio' name='secure_admin_page' <? if($result->secure_admin_page == 'FAIL') echo 'checked=\'checked\''; ?> id='F_secure_admin_page' value='FAIL'><label for='F_secure_admin_page'>Fail</label> / 
					<input type='radio' name='secure_admin_page' <? if($result->secure_admin_page == 'UNKN') echo 'checked=\'checked\''; ?> id='U_secure_admin_page' value='UNKN'><label for='U_secure_admin_page'>Unknown</label>
					<span><input type='text' name='secure_admin_page_n' value="<? echo $result->secure_admin_page_n ?>"></span></li>			</ul>				
				<h3>Social Media Connections</h3>				
					<h5>Google Plus</h5>	
							<ul>
		<li><span>Does your business have a Google Plus page?</span>
					<input type='radio' name='gp_exists' <? if($result->gp_exists == 'PASS') echo 'checked=\'checked\''; ?> id='P_gp_exists' value='PASS'><label for='P_gp_exists'>Pass</label> / 
					<input type='radio' name='gp_exists' <? if($result->gp_exists == 'FAIL') echo 'checked=\'checked\''; ?> id='F_gp_exists' value='FAIL'><label for='F_gp_exists'>Fail</label> / 
					<input type='radio' name='gp_exists' <? if($result->gp_exists == 'UNKN') echo 'checked=\'checked\''; ?> id='U_gp_exists' value='UNKN'><label for='U_gp_exists'>Unknown</label>
					<span><input type='text' name='gp_exists_n' value="<? echo $result->gp_exists_n ?>"></span></li><li><span>Is your Google Plus page moderated?</span>
					<input type='radio' name='gp_moderated' <? if($result->gp_moderated == 'PASS') echo 'checked=\'checked\''; ?> id='P_gp_moderated' value='PASS'><label for='P_gp_moderated'>Pass</label> / 
					<input type='radio' name='gp_moderated' <? if($result->gp_moderated == 'FAIL') echo 'checked=\'checked\''; ?> id='F_gp_moderated' value='FAIL'><label for='F_gp_moderated'>Fail</label> / 
					<input type='radio' name='gp_moderated' <? if($result->gp_moderated == 'UNKN') echo 'checked=\'checked\''; ?> id='U_gp_moderated' value='UNKN'><label for='U_gp_moderated'>Unknown</label>
					<span><input type='text' name='gp_moderated_n' value="<? echo $result->gp_moderated_n ?>"></span></li><li><span>Does your Google Plus page contain your unique logo?</span>
					<input type='radio' name='gp_logo' <? if($result->gp_logo == 'PASS') echo 'checked=\'checked\''; ?> id='P_gp_logo' value='PASS'><label for='P_gp_logo'>Pass</label> / 
					<input type='radio' name='gp_logo' <? if($result->gp_logo == 'FAIL') echo 'checked=\'checked\''; ?> id='F_gp_logo' value='FAIL'><label for='F_gp_logo'>Fail</label> / 
					<input type='radio' name='gp_logo' <? if($result->gp_logo == 'UNKN') echo 'checked=\'checked\''; ?> id='U_gp_logo' value='UNKN'><label for='U_gp_logo'>Unknown</label>
					<span><input type='text' name='gp_logo_n' value="<? echo $result->gp_logo_n ?>"></span></li><li><span>Is your Google Plus page stylish and modern?</span>
					<input type='radio' name='gp_stylish' <? if($result->gp_stylish == 'PASS') echo 'checked=\'checked\''; ?> id='P_gp_stylish' value='PASS'><label for='P_gp_stylish'>Pass</label> / 
					<input type='radio' name='gp_stylish' <? if($result->gp_stylish == 'FAIL') echo 'checked=\'checked\''; ?> id='F_gp_stylish' value='FAIL'><label for='F_gp_stylish'>Fail</label> / 
					<input type='radio' name='gp_stylish' <? if($result->gp_stylish == 'UNKN') echo 'checked=\'checked\''; ?> id='U_gp_stylish' value='UNKN'><label for='U_gp_stylish'>Unknown</label>
					<span><input type='text' name='gp_stylish_n' value="<? echo $result->gp_stylish_n ?>"></span></li><li><span>Is your Google Plus page active?</span>
					<input type='radio' name='gp_active' <? if($result->gp_active == 'PASS') echo 'checked=\'checked\''; ?> id='P_gp_active' value='PASS'><label for='P_gp_active'>Pass</label> / 
					<input type='radio' name='gp_active' <? if($result->gp_active == 'FAIL') echo 'checked=\'checked\''; ?> id='F_gp_active' value='FAIL'><label for='F_gp_active'>Fail</label> / 
					<input type='radio' name='gp_active' <? if($result->gp_active == 'UNKN') echo 'checked=\'checked\''; ?> id='U_gp_active' value='UNKN'><label for='U_gp_active'>Unknown</label>
					<span><input type='text' name='gp_active_n' value="<? echo $result->gp_active_n ?>"></span></li>	</ul>		
					<h5>Twitter</h5>	
							<ul>
		<li><span>Does your business have a Twitter account?</span>
					<input type='radio' name='tw_exists' <? if($result->tw_exists == 'PASS') echo 'checked=\'checked\''; ?> id='P_tw_exists' value='PASS'><label for='P_tw_exists'>Pass</label> / 
					<input type='radio' name='tw_exists' <? if($result->tw_exists == 'FAIL') echo 'checked=\'checked\''; ?> id='F_tw_exists' value='FAIL'><label for='F_tw_exists'>Fail</label> / 
					<input type='radio' name='tw_exists' <? if($result->tw_exists == 'UNKN') echo 'checked=\'checked\''; ?> id='U_tw_exists' value='UNKN'><label for='U_tw_exists'>Unknown</label>
					<span><input type='text' name='tw_exists_n' value="<? echo $result->tw_exists_n ?>"></span></li><li><span>Is your Twitter page moderated?</span>
					<input type='radio' name='tw_moderated' <? if($result->tw_moderated == 'PASS') echo 'checked=\'checked\''; ?> id='P_tw_moderated' value='PASS'><label for='P_tw_moderated'>Pass</label> / 
					<input type='radio' name='tw_moderated' <? if($result->tw_moderated == 'FAIL') echo 'checked=\'checked\''; ?> id='F_tw_moderated' value='FAIL'><label for='F_tw_moderated'>Fail</label> / 
					<input type='radio' name='tw_moderated' <? if($result->tw_moderated == 'UNKN') echo 'checked=\'checked\''; ?> id='U_tw_moderated' value='UNKN'><label for='U_tw_moderated'>Unknown</label>
					<span><input type='text' name='tw_moderated_n' value="<? echo $result->tw_moderated_n ?>"></span></li><li><span>Does your Twitter page contain your unique logo?</span>
					<input type='radio' name='tw_logo' <? if($result->tw_logo == 'PASS') echo 'checked=\'checked\''; ?> id='P_tw_logo' value='PASS'><label for='P_tw_logo'>Pass</label> / 
					<input type='radio' name='tw_logo' <? if($result->tw_logo == 'FAIL') echo 'checked=\'checked\''; ?> id='F_tw_logo' value='FAIL'><label for='F_tw_logo'>Fail</label> / 
					<input type='radio' name='tw_logo' <? if($result->tw_logo == 'UNKN') echo 'checked=\'checked\''; ?> id='U_tw_logo' value='UNKN'><label for='U_tw_logo'>Unknown</label>
					<span><input type='text' name='tw_logo_n' value="<? echo $result->tw_logo_n ?>"></span></li><li><span>Is your Twitter page stylish and modern?</span>
					<input type='radio' name='tw_stylish' <? if($result->tw_stylish == 'PASS') echo 'checked=\'checked\''; ?> id='P_tw_stylish' value='PASS'><label for='P_tw_stylish'>Pass</label> / 
					<input type='radio' name='tw_stylish' <? if($result->tw_stylish == 'FAIL') echo 'checked=\'checked\''; ?> id='F_tw_stylish' value='FAIL'><label for='F_tw_stylish'>Fail</label> / 
					<input type='radio' name='tw_stylish' <? if($result->tw_stylish == 'UNKN') echo 'checked=\'checked\''; ?> id='U_tw_stylish' value='UNKN'><label for='U_tw_stylish'>Unknown</label>
					<span><input type='text' name='tw_stylish_n' value="<? echo $result->tw_stylish_n ?>"></span></li><li><span>Is your Twitter page active?</span>
					<input type='radio' name='tw_active' <? if($result->tw_active == 'PASS') echo 'checked=\'checked\''; ?> id='P_tw_active' value='PASS'><label for='P_tw_active'>Pass</label> / 
					<input type='radio' name='tw_active' <? if($result->tw_active == 'FAIL') echo 'checked=\'checked\''; ?> id='F_tw_active' value='FAIL'><label for='F_tw_active'>Fail</label> / 
					<input type='radio' name='tw_active' <? if($result->tw_active == 'UNKN') echo 'checked=\'checked\''; ?> id='U_tw_active' value='UNKN'><label for='U_tw_active'>Unknown</label>
					<span><input type='text' name='tw_active_n' value="<? echo $result->tw_active_n ?>"></span></li>	</ul>		
					<h5>Facebook</h5>	
							<ul>
		<li><span>Does your business have a Facebook page?</span>
					<input type='radio' name='fb_exists' <? if($result->fb_exists == 'PASS') echo 'checked=\'checked\''; ?> id='P_fb_exists' value='PASS'><label for='P_fb_exists'>Pass</label> / 
					<input type='radio' name='fb_exists' <? if($result->fb_exists == 'FAIL') echo 'checked=\'checked\''; ?> id='F_fb_exists' value='FAIL'><label for='F_fb_exists'>Fail</label> / 
					<input type='radio' name='fb_exists' <? if($result->fb_exists == 'UNKN') echo 'checked=\'checked\''; ?> id='U_fb_exists' value='UNKN'><label for='U_fb_exists'>Unknown</label>
					<span><input type='text' name='fb_exists_n' value="<? echo $result->fb_exists_n ?>"></span></li><li><span>Is your Facebook page moderated?</span>
					<input type='radio' name='fb_moderated' <? if($result->fb_moderated == 'PASS') echo 'checked=\'checked\''; ?> id='P_fb_moderated' value='PASS'><label for='P_fb_moderated'>Pass</label> / 
					<input type='radio' name='fb_moderated' <? if($result->fb_moderated == 'FAIL') echo 'checked=\'checked\''; ?> id='F_fb_moderated' value='FAIL'><label for='F_fb_moderated'>Fail</label> / 
					<input type='radio' name='fb_moderated' <? if($result->fb_moderated == 'UNKN') echo 'checked=\'checked\''; ?> id='U_fb_moderated' value='UNKN'><label for='U_fb_moderated'>Unknown</label>
					<span><input type='text' name='fb_moderated_n' value="<? echo $result->fb_moderated_n ?>"></span></li><li><span>Does your Facebook page contain your unique logo?</span>
					<input type='radio' name='fb_logo' <? if($result->fb_logo == 'PASS') echo 'checked=\'checked\''; ?> id='P_fb_logo' value='PASS'><label for='P_fb_logo'>Pass</label> / 
					<input type='radio' name='fb_logo' <? if($result->fb_logo == 'FAIL') echo 'checked=\'checked\''; ?> id='F_fb_logo' value='FAIL'><label for='F_fb_logo'>Fail</label> / 
					<input type='radio' name='fb_logo' <? if($result->fb_logo == 'UNKN') echo 'checked=\'checked\''; ?> id='U_fb_logo' value='UNKN'><label for='U_fb_logo'>Unknown</label>
					<span><input type='text' name='fb_logo_n' value="<? echo $result->fb_logo_n ?>"></span></li><li><span>Is your Facebook page stylish and modern?</span>
					<input type='radio' name='fb_stylish' <? if($result->fb_stylish == 'PASS') echo 'checked=\'checked\''; ?> id='P_fb_stylish' value='PASS'><label for='P_fb_stylish'>Pass</label> / 
					<input type='radio' name='fb_stylish' <? if($result->fb_stylish == 'FAIL') echo 'checked=\'checked\''; ?> id='F_fb_stylish' value='FAIL'><label for='F_fb_stylish'>Fail</label> / 
					<input type='radio' name='fb_stylish' <? if($result->fb_stylish == 'UNKN') echo 'checked=\'checked\''; ?> id='U_fb_stylish' value='UNKN'><label for='U_fb_stylish'>Unknown</label>
					<span><input type='text' name='fb_stylish_n' value="<? echo $result->fb_stylish_n ?>"></span></li><li><span>Is your Facebook page active?</span>
					<input type='radio' name='fb_active' <? if($result->fb_active == 'PASS') echo 'checked=\'checked\''; ?> id='P_fb_active' value='PASS'><label for='P_fb_active'>Pass</label> / 
					<input type='radio' name='fb_active' <? if($result->fb_active == 'FAIL') echo 'checked=\'checked\''; ?> id='F_fb_active' value='FAIL'><label for='F_fb_active'>Fail</label> / 
					<input type='radio' name='fb_active' <? if($result->fb_active == 'UNKN') echo 'checked=\'checked\''; ?> id='U_fb_active' value='UNKN'><label for='U_fb_active'>Unknown</label>
					<span><input type='text' name='fb_active_n' value="<? echo $result->fb_active_n ?>"></span></li>	</ul>		
					<h5>Foursquare</h5>	
							<ul>
		<li><span>Is your business a Foursquare location?</span>
					<input type='radio' name='fs_exists' <? if($result->fs_exists == 'PASS') echo 'checked=\'checked\''; ?> id='P_fs_exists' value='PASS'><label for='P_fs_exists'>Pass</label> / 
					<input type='radio' name='fs_exists' <? if($result->fs_exists == 'FAIL') echo 'checked=\'checked\''; ?> id='F_fs_exists' value='FAIL'><label for='F_fs_exists'>Fail</label> / 
					<input type='radio' name='fs_exists' <? if($result->fs_exists == 'UNKN') echo 'checked=\'checked\''; ?> id='U_fs_exists' value='UNKN'><label for='U_fs_exists'>Unknown</label>
					<span><input type='text' name='fs_exists_n' value="<? echo $result->fs_exists_n ?>"></span></li><li><span>Does your Foursquare page contain your unique logo?</span>
					<input type='radio' name='fs_logo' <? if($result->fs_logo == 'PASS') echo 'checked=\'checked\''; ?> id='P_fs_logo' value='PASS'><label for='P_fs_logo'>Pass</label> / 
					<input type='radio' name='fs_logo' <? if($result->fs_logo == 'FAIL') echo 'checked=\'checked\''; ?> id='F_fs_logo' value='FAIL'><label for='F_fs_logo'>Fail</label> / 
					<input type='radio' name='fs_logo' <? if($result->fs_logo == 'UNKN') echo 'checked=\'checked\''; ?> id='U_fs_logo' value='UNKN'><label for='U_fs_logo'>Unknown</label>
					<span><input type='text' name='fs_logo_n' value="<? echo $result->fs_logo_n ?>"></span></li><li><span>Is your Foursquare account moderated?</span>
					<input type='radio' name='fs_moderated' <? if($result->fs_moderated == 'PASS') echo 'checked=\'checked\''; ?> id='P_fs_moderated' value='PASS'><label for='P_fs_moderated'>Pass</label> / 
					<input type='radio' name='fs_moderated' <? if($result->fs_moderated == 'FAIL') echo 'checked=\'checked\''; ?> id='F_fs_moderated' value='FAIL'><label for='F_fs_moderated'>Fail</label> / 
					<input type='radio' name='fs_moderated' <? if($result->fs_moderated == 'UNKN') echo 'checked=\'checked\''; ?> id='U_fs_moderated' value='UNKN'><label for='U_fs_moderated'>Unknown</label>
					<span><input type='text' name='fs_moderated_n' value="<? echo $result->fs_moderated_n ?>"></span></li><li><span>Is your Foursquare account active?</span>
					<input type='radio' name='fs_active' <? if($result->fs_active == 'PASS') echo 'checked=\'checked\''; ?> id='P_fs_active' value='PASS'><label for='P_fs_active'>Pass</label> / 
					<input type='radio' name='fs_active' <? if($result->fs_active == 'FAIL') echo 'checked=\'checked\''; ?> id='F_fs_active' value='FAIL'><label for='F_fs_active'>Fail</label> / 
					<input type='radio' name='fs_active' <? if($result->fs_active == 'UNKN') echo 'checked=\'checked\''; ?> id='U_fs_active' value='UNKN'><label for='U_fs_active'>Unknown</label>
					<span><input type='text' name='fs_active_n' value="<? echo $result->fs_active_n ?>"></span></li>	</ul>	
		</form>
					<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('#cr_edit_form input').attr('onfocus','input_start = this.value; console.log(input_start)');
						$('#cr_edit_form input').attr('onblur','cr_ajaxson(this); console.log(this.value)');		
					})
					
					function cr_ajaxson(that) {
						if (that.value != input_start || that.getAttribute('type') == 'radio') {
							cr_editrow = that.getAttribute('name');
							cr_editval = that.value;
							jQuery.post(ajaxurl,{ action: 'cr_editreview', cr_id: <? echo $_GET['cr_id'] ?>, cr_editrow: cr_editrow, cr_editval : cr_editval});
						}	
					}	
					</script>
			
		
		<?
		} else {
			global $wpdb;
			$table = $wpdb->prefix . 'cr_reviews';
			$stmt = "SELECT *
				FROM $table
				ORDER BY id ASC";
			$results = $wpdb->get_results($stmt);
			foreach($results as $result) {
				echo "<div class='clientreview_div_list'><a href=\"admin.php?page=client-reviews&cr_id=$result->id\">$result->access_code - $result->business_name - $result->website</a></div>";
			} 
		}
	}		
	public static function editreviews_receiver(){
		global $wpdb;
		$table = $wpdb->prefix . 'cr_reviews';
		$update = $wpdb->update(
			$table,
			array(
				$_POST['cr_editrow'] => stripslashes($_POST['cr_editval'])
			),
			array(
				'id' => $_POST['cr_id']
			),
				'%s',
				'%d'
		);
		if($update) {
			echo "Updated!";
		} else {
			echo "there was an error..";
		}
		die(); // Required
	}
	public static function addareview() { ?>
		<h1>Online Presence Evaluation</h1>
		<form id="clientreview_form">
			Business Name: <input type="text" name="business_name"><br />
			Website: <input type="text" name="website"><br />
			<h3>Search Engine Optimization (SEO)</h3>				
			<ul>				
				<li>
					<span>Does your content contain optimized keywords?</span><input type='radio' name='targeted_keywords' id='P_targeted_keywords' value='PASS'><label for='P_targeted_keywords'>Pass</label> / <input type='radio' name='targeted_keywords' id='F_targeted_keywords' value='FAIL'><label for='F_targeted_keywords'>Fail</label> / <input type='radio' name='targeted_keywords' id='U_targeted_keywords' value='UNKN'><label for='U_targeted_keywords'>Unknown</label><span><input type='text' name='targeted_keywords_n'></span></li><li><span>Does your content contain optimized titles?</span><input type='radio' name='optimized_titles' id='P_optimized_titles' value='PASS'><label for='P_optimized_titles'>Pass</label> / <input type='radio' name='optimized_titles' id='F_optimized_titles' value='FAIL'><label for='F_optimized_titles'>Fail</label> / <input type='radio' name='optimized_titles' id='U_optimized_titles' value='UNKN'><label for='U_optimized_titles'>Unknown</label><span><input type='text' name='optimized_titles_n'></span></li><li><span>Is your website content optimized?</span><input type='radio' name='optimized_content' id='P_optimized_content' value='PASS'><label for='P_optimized_content'>Pass</label> / <input type='radio' name='optimized_content' id='F_optimized_content' value='FAIL'><label for='F_optimized_content'>Fail</label> / <input type='radio' name='optimized_content' id='U_optimized_content' value='UNKN'><label for='U_optimized_content'>Unknown</label><span><input type='text' name='optimized_content_n'></span></li><li><span>Does your website contain optimized descriptions?</span><input type='radio' name='optimized_descriptions' id='P_optimized_descriptions' value='PASS'><label for='P_optimized_descriptions'>Pass</label> / <input type='radio' name='optimized_descriptions' id='F_optimized_descriptions' value='FAIL'><label for='F_optimized_descriptions'>Fail</label> / <input type='radio' name='optimized_descriptions' id='U_optimized_descriptions' value='UNKN'><label for='U_optimized_descriptions'>Unknown</label><span><input type='text' name='optimized_descriptions_n'></span></li><li><span>Do you images have optimized titles and alts?</span><input type='radio' name='optimized_images' id='P_optimized_images' value='PASS'><label for='P_optimized_images'>Pass</label> / <input type='radio' name='optimized_images' id='F_optimized_images' value='FAIL'><label for='F_optimized_images'>Fail</label> / <input type='radio' name='optimized_images' id='U_optimized_images' value='UNKN'><label for='U_optimized_images'>Unknown</label><span><input type='text' name='optimized_images_n'></span></li>			</ul>
				<h3>User Experience (UX)</h3>
					<ul>				
		<li><span>Is your design responsive?</span><input type='radio' name='responsive_design' id='P_responsive_design' value='PASS'><label for='P_responsive_design'>Pass</label> / <input type='radio' name='responsive_design' id='F_responsive_design' value='FAIL'><label for='F_responsive_design'>Fail</label> / <input type='radio' name='responsive_design' id='U_responsive_design' value='UNKN'><label for='U_responsive_design'>Unknown</label><span><input type='text' name='responsive_design_n'></span></li><li><span>Do you have a customized Favicon?</span><input type='radio' name='custom_favicon' id='P_custom_favicon' value='PASS'><label for='P_custom_favicon'>Pass</label> / <input type='radio' name='custom_favicon' id='F_custom_favicon' value='FAIL'><label for='F_custom_favicon'>Fail</label> / <input type='radio' name='custom_favicon' id='U_custom_favicon' value='UNKN'><label for='U_custom_favicon'>Unknown</label><span><input type='text' name='custom_favicon_n'></span></li><li><span>Do you have a clean, customized logo?</span><input type='radio' name='clean_logo' id='P_clean_logo' value='PASS'><label for='P_clean_logo'>Pass</label> / <input type='radio' name='clean_logo' id='F_clean_logo' value='FAIL'><label for='F_clean_logo'>Fail</label> / <input type='radio' name='clean_logo' id='U_clean_logo' value='UNKN'><label for='U_clean_logo'>Unknown</label><span><input type='text' name='clean_logo_n'></span></li><li><span>Does your website apparently direct users?</span><input type='radio' name='apparant_direction' id='P_apparant_direction' value='PASS'><label for='P_apparant_direction'>Pass</label> / <input type='radio' name='apparant_direction' id='F_apparant_direction' value='FAIL'><label for='F_apparant_direction'>Fail</label> / <input type='radio' name='apparant_direction' id='U_apparant_direction' value='UNKN'><label for='U_apparant_direction'>Unknown</label><span><input type='text' name='apparant_direction_n'></span></li><li><span>Is your website easy to use?</span><input type='radio' name='easy_to_use' id='P_easy_to_use' value='PASS'><label for='P_easy_to_use'>Pass</label> / <input type='radio' name='easy_to_use' id='F_easy_to_use' value='FAIL'><label for='F_easy_to_use'>Fail</label> / <input type='radio' name='easy_to_use' id='U_easy_to_use' value='UNKN'><label for='U_easy_to_use'>Unknown</label><span><input type='text' name='easy_to_use_n'></span></li><li><span>Is your website stylish and modern?</span><input type='radio' name='stylish' id='P_stylish' value='PASS'><label for='P_stylish'>Pass</label> / <input type='radio' name='stylish' id='F_stylish' value='FAIL'><label for='F_stylish'>Fail</label> / <input type='radio' name='stylish' id='U_stylish' value='UNKN'><label for='U_stylish'>Unknown</label><span><input type='text' name='stylish_n'></span></li><li><span>Is your past speed fast enough?</span><input type='radio' name='page_speed' id='P_page_speed' value='PASS'><label for='P_page_speed'>Pass</label> / <input type='radio' name='page_speed' id='F_page_speed' value='FAIL'><label for='F_page_speed'>Fail</label> / <input type='radio' name='page_speed' id='U_page_speed' value='UNKN'><label for='U_page_speed'>Unknown</label><span><input type='text' name='page_speed_n'></span></li>			</ul>	
				<h3>Security</h3>				
					<ul>				
		<li><span>Does your website offer SSL Connections?</span><input type='radio' name='offers_ssl' id='P_offers_ssl' value='PASS'><label for='P_offers_ssl'>Pass</label> / <input type='radio' name='offers_ssl' id='F_offers_ssl' value='FAIL'><label for='F_offers_ssl'>Fail</label> / <input type='radio' name='offers_ssl' id='U_offers_ssl' value='UNKN'><label for='U_offers_ssl'>Unknown</label><span><input type='text' name='offers_ssl_n'></span></li><li><span>Is your website safe from SQL Injection?</span><input type='radio' name='sql_injection' id='P_sql_injection' value='PASS'><label for='P_sql_injection'>Pass</label> / <input type='radio' name='sql_injection' id='F_sql_injection' value='FAIL'><label for='F_sql_injection'>Fail</label> / <input type='radio' name='sql_injection' id='U_sql_injection' value='UNKN'><label for='U_sql_injection'>Unknown</label><span><input type='text' name='sql_injection_n'></span></li><li><span>Is your website safe from BruteForce Attacks?</span><input type='radio' name='bruteforce_attack' id='P_bruteforce_attack' value='PASS'><label for='P_bruteforce_attack'>Pass</label> / <input type='radio' name='bruteforce_attack' id='F_bruteforce_attack' value='FAIL'><label for='F_bruteforce_attack'>Fail</label> / <input type='radio' name='bruteforce_attack' id='U_bruteforce_attack' value='UNKN'><label for='U_bruteforce_attack'>Unknown</label><span><input type='text' name='bruteforce_attack_n'></span></li><li><span>Is your website safe from DOS Attacks?</span><input type='radio' name='dos_attack' id='P_dos_attack' value='PASS'><label for='P_dos_attack'>Pass</label> / <input type='radio' name='dos_attack' id='F_dos_attack' value='FAIL'><label for='F_dos_attack'>Fail</label> / <input type='radio' name='dos_attack' id='U_dos_attack' value='UNKN'><label for='U_dos_attack'>Unknown</label><span><input type='text' name='dos_attack_n'></span></li><li><span>Do you have a secure admin page?</span><input type='radio' name='secure_admin_page' id='P_secure_admin_page' value='PASS'><label for='P_secure_admin_page'>Pass</label> / <input type='radio' name='secure_admin_page' id='F_secure_admin_page' value='FAIL'><label for='F_secure_admin_page'>Fail</label> / <input type='radio' name='secure_admin_page' id='U_secure_admin_page' value='UNKN'><label for='U_secure_admin_page'>Unknown</label><span><input type='text' name='secure_admin_page_n'></span></li>		</ul>				
				<h3>Social Media Connections</h3>				
					<h5>Google Plus</h5>	
							<ul>
		<li><span>Does your business have a Google Plus page?</span><input type='radio' name='gp_exists' id='P_gp_exists' value='PASS'><label for='P_gp_exists'>Pass</label> / <input type='radio' name='gp_exists' id='F_gp_exists' value='FAIL'><label for='F_gp_exists'>Fail</label> / <input type='radio' name='gp_exists' id='U_gp_exists' value='UNKN'><label for='U_gp_exists'>Unknown</label><span><input type='text' name='gp_exists_n'></span></li><li><span>Is your Google Plus page moderated?</span><input type='radio' name='gp_moderated' id='P_gp_moderated' value='PASS'><label for='P_gp_moderated'>Pass</label> / <input type='radio' name='gp_moderated' id='F_gp_moderated' value='FAIL'><label for='F_gp_moderated'>Fail</label> / <input type='radio' name='gp_moderated' id='U_gp_moderated' value='UNKN'><label for='U_gp_moderated'>Unknown</label><span><input type='text' name='gp_moderated_n'></span></li><li><span>Does your Google Plus page contain your unique logo?</span><input type='radio' name='gp_logo' id='P_gp_logo' value='PASS'><label for='P_gp_logo'>Pass</label> / <input type='radio' name='gp_logo' id='F_gp_logo' value='FAIL'><label for='F_gp_logo'>Fail</label> / <input type='radio' name='gp_logo' id='U_gp_logo' value='UNKN'><label for='U_gp_logo'>Unknown</label><span><input type='text' name='gp_logo_n'></span></li><li><span>Is your Google Plus page stylish and modern?</span><input type='radio' name='gp_stylish' id='P_gp_stylish' value='PASS'><label for='P_gp_stylish'>Pass</label> / <input type='radio' name='gp_stylish' id='F_gp_stylish' value='FAIL'><label for='F_gp_stylish'>Fail</label> / <input type='radio' name='gp_stylish' id='U_gp_stylish' value='UNKN'><label for='U_gp_stylish'>Unknown</label><span><input type='text' name='gp_stylish_n'></span></li><li><span>Is your Google Plus page active?</span><input type='radio' name='gp_active' id='P_gp_active' value='PASS'><label for='P_gp_active'>Pass</label> / <input type='radio' name='gp_active' id='F_gp_active' value='FAIL'><label for='F_gp_active'>Fail</label> / <input type='radio' name='gp_active' id='U_gp_active' value='UNKN'><label for='U_gp_active'>Unknown</label><span><input type='text' name='gp_active_n'></span></li>					</ul>		
					<h5>Twitter</h5>	
							<ul>
		<li><span>Does your business have a Twitter account?</span><input type='radio' name='tw_exists' id='P_tw_exists' value='PASS'><label for='P_tw_exists'>Pass</label> / <input type='radio' name='tw_exists' id='F_tw_exists' value='FAIL'><label for='F_tw_exists'>Fail</label> / <input type='radio' name='tw_exists' id='U_tw_exists' value='UNKN'><label for='U_tw_exists'>Unknown</label><span><input type='text' name='tw_exists_n'></span></li><li><span>Is your Twitter page moderated?</span><input type='radio' name='tw_moderated' id='P_tw_moderated' value='PASS'><label for='P_tw_moderated'>Pass</label> / <input type='radio' name='tw_moderated' id='F_tw_moderated' value='FAIL'><label for='F_tw_moderated'>Fail</label> / <input type='radio' name='tw_moderated' id='U_tw_moderated' value='UNKN'><label for='U_tw_moderated'>Unknown</label><span><input type='text' name='tw_moderated_n'></span></li><li><span>Does your Twitter page contain your unique logo?</span><input type='radio' name='tw_logo' id='P_tw_logo' value='PASS'><label for='P_tw_logo'>Pass</label> / <input type='radio' name='tw_logo' id='F_tw_logo' value='FAIL'><label for='F_tw_logo'>Fail</label> / <input type='radio' name='tw_logo' id='U_tw_logo' value='UNKN'><label for='U_tw_logo'>Unknown</label><span><input type='text' name='tw_logo_n'></span></li><li><span>Is your Twitter page stylish and modern?</span><input type='radio' name='tw_stylish' id='P_tw_stylish' value='PASS'><label for='P_tw_stylish'>Pass</label> / <input type='radio' name='tw_stylish' id='F_tw_stylish' value='FAIL'><label for='F_tw_stylish'>Fail</label> / <input type='radio' name='tw_stylish' id='U_tw_stylish' value='UNKN'><label for='U_tw_stylish'>Unknown</label><span><input type='text' name='tw_stylish_n'></span></li><li><span>Is your Twitter page active?</span><input type='radio' name='tw_active' id='P_tw_active' value='PASS'><label for='P_tw_active'>Pass</label> / <input type='radio' name='tw_active' id='F_tw_active' value='FAIL'><label for='F_tw_active'>Fail</label> / <input type='radio' name='tw_active' id='U_tw_active' value='UNKN'><label for='U_tw_active'>Unknown</label><span><input type='text' name='tw_active_n'></span></li>					</ul>		
					<h5>Facebook</h5>	
							<ul>
		<li><span>Does your business have a Facebook page?</span><input type='radio' name='fb_exists' id='P_fb_exists' value='PASS'><label for='P_fb_exists'>Pass</label> / <input type='radio' name='fb_exists' id='F_fb_exists' value='FAIL'><label for='F_fb_exists'>Fail</label> / <input type='radio' name='fb_exists' id='U_fb_exists' value='UNKN'><label for='U_fb_exists'>Unknown</label><span><input type='text' name='fb_exists_n'></span></li><li><span>Is your Facebook page moderated?</span><input type='radio' name='fb_moderated' id='P_fb_moderated' value='PASS'><label for='P_fb_moderated'>Pass</label> / <input type='radio' name='fb_moderated' id='F_fb_moderated' value='FAIL'><label for='F_fb_moderated'>Fail</label> / <input type='radio' name='fb_moderated' id='U_fb_moderated' value='UNKN'><label for='U_fb_moderated'>Unknown</label><span><input type='text' name='fb_moderated_n'></span></li><li><span>Does your Facebook page contain your unique logo?</span><input type='radio' name='fb_logo' id='P_fb_logo' value='PASS'><label for='P_fb_logo'>Pass</label> / <input type='radio' name='fb_logo' id='F_fb_logo' value='FAIL'><label for='F_fb_logo'>Fail</label> / <input type='radio' name='fb_logo' id='U_fb_logo' value='UNKN'><label for='U_fb_logo'>Unknown</label><span><input type='text' name='fb_logo_n'></span></li><li><span>Is your Facebook page stylish and modern?</span><input type='radio' name='fb_stylish' id='P_fb_stylish' value='PASS'><label for='P_fb_stylish'>Pass</label> / <input type='radio' name='fb_stylish' id='F_fb_stylish' value='FAIL'><label for='F_fb_stylish'>Fail</label> / <input type='radio' name='fb_stylish' id='U_fb_stylish' value='UNKN'><label for='U_fb_stylish'>Unknown</label><span><input type='text' name='fb_stylish_n'></span></li><li><span>Is your Facebook page active?</span><input type='radio' name='fb_active' id='P_fb_active' value='PASS'><label for='P_fb_active'>Pass</label> / <input type='radio' name='fb_active' id='F_fb_active' value='FAIL'><label for='F_fb_active'>Fail</label> / <input type='radio' name='fb_active' id='U_fb_active' value='UNKN'><label for='U_fb_active'>Unknown</label><span><input type='text' name='fb_active_n'></span></li>					</ul>		
					<h5>Foursquare</h5>	
							<ul>
		<li><span>Is your business a Foursquare location?</span><input type='radio' name='fs_exists' id='P_fs_exists' value='PASS'><label for='P_fs_exists'>Pass</label> / <input type='radio' name='fs_exists' id='F_fs_exists' value='FAIL'><label for='F_fs_exists'>Fail</label> / <input type='radio' name='fs_exists' id='U_fs_exists' value='UNKN'><label for='U_fs_exists'>Unknown</label><span><input type='text' name='fs_exists_n'></span></li><li><span>Does your Foursquare page contain your unique logo?</span><input type='radio' name='fs_logo' id='P_fs_logo' value='PASS'><label for='P_fs_logo'>Pass</label> / <input type='radio' name='fs_logo' id='F_fs_logo' value='FAIL'><label for='F_fs_logo'>Fail</label> / <input type='radio' name='fs_logo' id='U_fs_logo' value='UNKN'><label for='U_fs_logo'>Unknown</label><span><input type='text' name='fs_logo_n'></span></li><li><span>Is your Foursquare account moderated?</span><input type='radio' name='fs_moderated' id='P_fs_moderated' value='PASS'><label for='P_fs_moderated'>Pass</label> / <input type='radio' name='fs_moderated' id='F_fs_moderated' value='FAIL'><label for='F_fs_moderated'>Fail</label> / <input type='radio' name='fs_moderated' id='U_fs_moderated' value='UNKN'><label for='U_fs_moderated'>Unknown</label><span><input type='text' name='fs_moderated_n'></span></li><li><span>Is your Foursquare account active?</span><input type='radio' name='fs_active' id='P_fs_active' value='PASS'><label for='P_fs_active'>Pass</label> / <input type='radio' name='fs_active' id='F_fs_active' value='FAIL'><label for='F_fs_active'>Fail</label> / <input type='radio' name='fs_active' id='U_fs_active' value='UNKN'><label for='U_fs_active'>Unknown</label><span><input type='text' name='fs_active_n'></span></li>			</ul>		
		<input name="action" type="hidden" value="cr_addareview">
				<button>Add Review</button>
			</form>
		<script type="text/javascript">
		
		jQuery(document).ready(function($){
			$('#clientreview_form button').click(function(){
			console.log('alive');
				var crdata = $('#clientreview_form').serialize();
				console.log(crdata);
				$.post(ajaxurl, crdata, function(response){
					document.location = "admin.php?page=client-reviews-add-new";
				});
				return false;
			});
		});
		</script>
	<?
	}		
	public static function addareview_receiver() {
		global $wpdb;
		$table = $wpdb->prefix . 'cr_reviews';
		do {
			$cr_ac = rand(1000000, 9999999);
		} while($wpdb->get_row('SELECT * FROM $table WHERE access_code=$cr_ac') != NULL);
		$data = array(
			'business_name' => $_POST['business_name'],
			'website' => $_POST['website'],
			'responsive_design' => $_POST['responsive_design'],
			'responsive_design_n' => $_POST['responsive_design_n'],
			'custom_favicon' => $_POST['custom_favicon'],
			'custom_favicon_n' => $_POST['custom_favicon_n'],
			'clean_logo' => $_POST['clean_logo'],
			'clean_logo_n' => $_POST['clean_logo_n'],
			'apparant_direction' => $_POST['apparant_direction'],
			'apparant_direction_n' => $_POST['apparant_direction_n'],
			'easy_to_use' => $_POST['easy_to_use'],
			'easy_to_use_n' => $_POST['easy_to_use_n'],
			'stylish' => $_POST['stylish'],
			'stylish_n' => $_POST['stylish_n'],
			'page_speed' => $_POST['page_speed'],
			'page_speed_n' => $_POST['page_speed_n'],
			'offers_ssl' => $_POST['offers_ssl'],
			'offers_ssl_n' => $_POST['offers_ssl_n'],
			'sql_injection' => $_POST['sql_injection'],
			'sql_injection_n' => $_POST['sql_injection_n'],
			'bruteforce_attack' => $_POST['bruteforce_attack'],
			'bruteforce_attack_n' => $_POST['bruteforce_attack_n'],
			'dos_attack' => $_POST['dos_attack'],
			'dos_attack_n' => $_POST['dos_attack_n'],
			'secure_admin_page' => $_POST['secure_admin_page'],
			'secure_admin_page_n' => $_POST['secure_admin_page_n'],
			'targeted_keywords_n' => $_POST['targeted_keywords_n'],
			'targeted_keywords' => $_POST['targeted_keywords'],
			'optimized_titles_n' => $_POST['optimized_titles_n'],
			'optimized_titles' => $_POST['optimized_titles'],
			'optimized_content_n' => $_POST['optimized_content_n'],
			'optimized_content' => $_POST['optimized_content'],
			'optimized_descriptions_n' => $_POST['optimized_descriptions_n'],
			'optimized_descriptions' => $_POST['optimized_descriptions'],
			'optimized_images_n' => $_POST['optimized_images_n'],
			'optimized_images' => $_POST['optimized_images'],
			'gp_exists_n' => $_POST['gp_exists_n'],
			'gp_exists' => $_POST['gp_exists'],
			'gp_moderated_n' => $_POST['gp_moderated_n'],
			'gp_moderated' => $_POST['gp_moderated'],
			'gp_logo_n' => $_POST['gp_logo_n'],
			'gp_logo' => $_POST['gp_logo'],
			'gp_stylish_n' => $_POST['gp_stylish_n'],
			'gp_stylish' => $_POST['gp_stylish'],
			'gp_active_n' => $_POST['gp_active_n'],
			'gp_active' => $_POST['gp_active'],
			'tw_exists_n' => $_POST['tw_exists_n'],
			'tw_exists' => $_POST['tw_exists'],
			'tw_moderated_n' => $_POST['tw_moderated_n'],
			'tw_moderated' => $_POST['tw_moderated'],
			'tw_logo_n' => $_POST['tw_logo_n'],
			'tw_logo' => $_POST['tw_logo'],
			'tw_stylish_n' => $_POST['tw_stylish_n'],
			'tw_stylish' => $_POST['tw_stylish'],
			'tw_active_n' => $_POST['tw_active_n'],
			'tw_active' => $_POST['tw_active'],
			'fb_exists_n' => $_POST['fb_exists_n'],
			'fb_exists' => $_POST['fb_exists'],
			'fb_moderated_n' => $_POST['fb_moderated_n'],
			'fb_moderated' => $_POST['fb_moderated'],
			'fb_logo_n' => $_POST['fb_logo_n'],
			'fb_logo' => $_POST['fb_logo'],
			'fb_stylish_n' => $_POST['fb_stylish_n'],
			'fb_stylish' => $_POST['fb_stylish'],
			'fb_active' => $_POST['fb_active'],
			'fb_active_n' => $_POST['fb_active_n'],
			'fs_exists_n' => $_POST['fs_exists_n'],
			'fs_exists' => $_POST['fs_exists'],
			'fs_logo_n' => $_POST['fs_logo_n'],
			'fs_logo' => $_POST['fs_logo'],
			'fs_active' => $_POST['fs_active'],
			'fs_active_n' => $_POST['fs_active_n'],
			'fs_moderated_n' => $_POST['fs_moderated_n'],
			'fs_moderated' => $_POST['fs_moderated'],
			'access_code' => $cr_ac
		);
		$wpdb->insert($table, $data);
		die(); //Required
	}

	public static function showreview() {
		wp_enqueue_script('clientreview');
		?>
			<div id="cr_review">
				Access code: <input type="number" maxlength="7" onkeyup="cr_getter(this)" id="cr_ac">
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					document.getElementById('cr_ac').focus();
				});
			</script>
		<?
	 }

	public static function showreview_receiver() {
		global $wpdb;
		$cr_acid = (int)$_POST['cr_ac'];
		$table = $wpdb->prefix . 'cr_reviews';
		$stmt = "SELECT * FROM $table WHERE access_code=$cr_acid";
		$result = $wpdb->get_row($stmt, OBJECT);
		if(!$result) { ?>
				Try Again<br>
				Access code: <input type="number" maxlength="7" onkeyup="cr_getter(this)" id="cr_ac">
		<? } else { ?>
		<style type="text/css">
			#cr_review {
				font-family: 'Ubuntu Condensed';
				display: block;
			}
			#cr_review h1 {
				font-family: 'Ubuntu Condensed';
			}
			#cr_review h2 {
				font-family: 'Ubuntu Condensed';
			}
			#cr_review h3 {
				font-family: 'Ubuntu Condensed';
				padding: 35px 0 15px 0;
			}
			#cr_review li {
				font-family: 'Ubuntu';
				font-size: 16px;
				display: block;
				margin-left: 45px;
				position: relative;
				clear: both;
				min-height: 75px;
			}
			#cr_review li:before{
				position: absolute;
				top: -10px;
				left: -50px;
			}
			#cr_review li.PASS:before {
			    content: url('<? echo plugin_dir_url(__FILE__) ?>img/green-check.png');
			}
			#cr_review li.FAIL:before {
			    content: url('<? echo plugin_dir_url(__FILE__) ?>img/red-x.png');
			}
			#cr_review li.UNKN:before {
			    content: url('<? echo plugin_dir_url(__FILE__) ?>img/black-question.png');
			}
			#cr_review span {
			}
			#cr_review span:first-of-type {
				float: left;
				font-weight: bold;
			}
			#cr_review .cr_commit {
				border: 1px dashed black;
				float: right;
				clear: both;
				margin: 5px 25px 35px 0;
			}
			
		
		
		</style>

		<h1>Online Presence Evaluation</h1>
		<h2><? echo $result->business_name . " - " . $result->website ?></h2>		
		<? if($result->targeted_keywords != NULL){?> <h3>Search Engine Optimization (SEO)</h3>		 <? }	?>	
				<? if($result->targeted_keywords != NULL){?> <li class="<? echo $result->targeted_keywords ?>"><span>Does your content contain optimized keywords?</span><? if($result->targeted_keywords_n != NULL){?><span class='cr_commit'><? echo $result->targeted_keywords_n ?></span><?}?></li><?}?>			
				<? if($result->optimized_titles != NULL){?> <li class="<? echo $result->optimized_titles ?>"><span>Does your content contain optimized titles?</span><? if($result->optimized_titles_n != NULL){?><span class='cr_commit'><? echo $result->optimized_titles_n ?></span><?}?></li><?}?>			
				<? if($result->optimized_content != NULL){?> <li class="<? echo $result->optimized_content ?>"><span>Is your website content optimized?</span><? if($result->optimized_content_n != NULL){?><span class='cr_commit'><? echo $result->optimized_content_n ?></span><?}?></li><?}?>			
				<? if($result->optimized_descriptions != NULL){?> <li class="<? echo $result->optimized_descriptions ?>"><span>Does your website contain optimized descriptions?</span><? if($result->optimized_descriptions_n != NULL){?><span class='cr_commit'><? echo $result->optimized_descriptions_n ?></span><?}?></li><?}?>			
				<? if($result->optimized_images != NULL){?> <li class="<? echo $result->optimized_images ?>"><span>Do you images have optimized titles and alts?</span><? if($result->optimized_images_n != NULL){?><span class='cr_commit'><? echo $result->optimized_images_n ?></span><?}?></li><?}?>	
		<? if($result->responsive_design != NULL){?> <h3>User Experience (UX)</h3> <? }	?>
				<? if($result->responsive_design != NULL){?> <li class="<? echo $result->responsive_design ?>"><span>Is your design responsive?</span><? if($result->responsive_design_n != NULL){?><span class='cr_commit'><? echo $result->responsive_design_n ?></span><?}?></li><?}?>			
				<? if($result->custom_favicon != NULL){?> <li class="<? echo $result->custom_favicon ?>"><span>Do you have a customized Favicon?</span><? if($result->custom_favicon_n != NULL){?><span class='cr_commit'><? echo $result->custom_favicon_n ?></span><?}?></li><?}?>			
				<? if($result->clean_logo != NULL){?> <li class="<? echo $result->clean_logo ?>"><span>Do you have a clean, customized logo?</span><? if($result->clean_logo_n != NULL){?><span class='cr_commit'><? echo $result->clean_logo_n ?></span><?}?></li><?}?>			
				<? if($result->apparant_direction != NULL){?> <li class="<? echo $result->apparant_direction ?>"><span>Does your website apparently direct users?</span><? if($result->apparant_direction_n != NULL){?><span class='cr_commit'><? echo $result->apparant_direction_n ?></span><?}?></li><?}?>			
				<? if($result->easy_to_use != NULL){?> <li class="<? echo $result->easy_to_use ?>"><span>Is your website easy to use?</span><? if($result->easy_to_use_n != NULL){?><span class='cr_commit'><? echo $result->easy_to_use_n ?></span><?}?></li><?}?>			
				<? if($result->stylish != NULL){?> <li class="<? echo $result->stylish ?>"><span>Is your website stylish and modern?</span><? if($result->stylish_n != NULL){?><span class='cr_commit'><? echo $result->stylish_n ?></span><?}?></li><?}?>			
				<? if($result->page_speed != NULL){?> <li class="<? echo $result->page_speed ?>"><span>Is your past speed fast enough?</span><? if($result->page_speed_n != NULL){?><span class='cr_commit'><? echo $result->page_speed_n ?></span><?}?></li><?}?>			
		<? if($result->offers_ssl != NULL){?> <h3>Security</h3>	 <? }				?>
				<? if($result->offers_ssl != NULL){?> <li class="<? echo $result->offers_ssl ?>"><span>Does your website offer SSL Connections?</span><? if($result->offers_ssl_n != NULL){?><span class='cr_commit'><? echo $result->offers_ssl_n ?></span><?}?></li><?}?>			
				<? if($result->sql_injection != NULL){?> <li class="<? echo $result->sql_injection ?>"><span>Is your website safe from SQL Injection?</span><? if($result->sql_injection_n != NULL){?><span class='cr_commit'><? echo $result->sql_injection_n ?></span><?}?></li><?}?>			
				<? if($result->bruteforce_attack != NULL){?> <li class="<? echo $result->bruteforce_attack ?>"><span>Is your website safe from BruteForce Attacks?</span><? if($result->bruteforce_attack_n != NULL){?><span class='cr_commit'><? echo $result->bruteforce_attack_n ?></span><?}?></li><?}?>			
				<? if($result->dos_attack != NULL){?> <li class="<? echo $result->dos_attack ?>"><span>Is your website safe from DOS Attacks?</span><? if($result->dos_attack_n != NULL){?><span class='cr_commit'><? echo $result->dos_attack_n ?></span><?}?></li><?}?>			
				<? if($result->secure_admin_page != NULL){?> <li class="<? echo $result->secure_admin_page ?>"><span>Do you have a secure admin page?</span><? if($result->secure_admin_page_n != NULL){?><span class='cr_commit'><? echo $result->secure_admin_page_n ?></span><?}?></li><?}?>
		<? if($result->gp_exists != NULL || $result->tw_exists != NULL || $result->fb_exists != NULL || $result->fs_exists != NULL){?>  <h3>Social Media Connections</h3>	<? } ?>			
			<? if($result->gp_exists != NULL){?> <h5>Google Plus</h5> <? }		?>
						<? if($result->gp_exists != NULL){?> <li class="<? echo $result->gp_exists ?>"><span>Does your business have a Google Plus page?</span><? if($result->gp_exists_n != NULL){?><span class='cr_commit'><? echo $result->gp_exists_n ?></span><?}?></li><?}?>
						<? if($result->gp_moderated != NULL){?> <li class="<? echo $result->gp_moderated ?>"><span>Is your Google Plus page moderated?</span><? if($result->gp_moderated_n != NULL){?><span class='cr_commit'><? echo $result->gp_moderated_n ?></span><?}?></li><?}?>		
						<? if($result->gp_logo != NULL){?> <li class="<? echo $result->gp_logo ?>"><span>Does your Google Plus page contain your unique logo?</span><? if($result->gp_logo_n != NULL){?><span class='cr_commit'><? echo $result->gp_logo_n ?></span><?}?></li><?}?>		
						<? if($result->gp_stylish != NULL){?> <li class="<? echo $result->gp_stylish ?>"><span>Is your Google Plus page stylish and modern?</span><? if($result->gp_stylish_n != NULL){?><span class='cr_commit'><? echo $result->gp_stylish_n ?></span><?}?></li><?}?>
						<? if($result->gp_active != NULL){?> <li class="<? echo $result->gp_active ?>"><span>Is your Google Plus page active?</span><? if($result->gp_active_n != NULL){?><span class='cr_commit'><? echo $result->gp_active_n ?></span><?}?></li><?}?>
			<? if($result->tw_exists != NULL){?> <h5>Twitter</h5>	 <? }	?>
						<? if($result->tw_exists != NULL){?> <li class="<? echo $result->tw_exists ?>"><span>Does your business have a Twitter account?</span><? if($result->tw_exists_n != NULL){?><span class='cr_commit'><? echo $result->tw_exists_n ?></span><?}?></li><?}?>
						<? if($result->tw_moderated != NULL){?> <li class="<? echo $result->tw_moderated ?>"><span>Is your Twitter page moderated?</span><? if($result->tw_moderated_n != NULL){?><span class='cr_commit'><? echo $result->tw_moderated_n ?></span><?}?></li><?}?>		
						<? if($result->tw_logo != NULL){?> <li class="<? echo $result->tw_logo ?>"><span>Does your Twitter page contain your unique logo?</span><? if($result->tw_logo_n != NULL){?><span class='cr_commit'><? echo $result->tw_logo_n ?></span><?}?></li><?}?>		
						<? if($result->tw_stylish != NULL){?> <li class="<? echo $result->tw_stylish ?>"><span>Is your Twitter page stylish and modern?</span><? if($result->tw_stylish_n != NULL){?><span class='cr_commit'><? echo $result->tw_stylish_n ?></span><?}?></li><?}?>
						<? if($result->tw_active != NULL){?> <li class="<? echo $result->tw_active ?>"><span>Is your Twitter page active?</span><? if($result->tw_active_n != NULL){?><span class='cr_commit'><? echo $result->tw_active_n ?></span><?}?></li><?}?>
			<? if($result->fb_exists != NULL){?> <h5>Facebook</h5> <? }		?>
						<? if($result->fb_exists != NULL){?> <li class="<? echo $result->fb_exists ?>"><span>Does your business have a Facebook page?</span><? if($result->fb_exists_n != NULL){?><span class='cr_commit'><? echo $result->fb_exists_n ?></span><?}?></li><?}?>
						<? if($result->fb_moderated != NULL){?> <li class="<? echo $result->fb_moderated ?>"><span>Is your Facebook page moderated?</span><? if($result->fb_moderated_n != NULL){?><span class='cr_commit'><? echo $result->fb_moderated_n ?></span><?}?></li><?}?>		
						<? if($result->fb_logo != NULL){?> <li class="<? echo $result->fb_logo ?>"><span>Does your Facebook page contain your unique logo?</span><? if($result->fb_logo_n != NULL){?><span class='cr_commit'><? echo $result->fb_logo_n ?></span><?}?></li><?}?>		
						<? if($result->fb_stylish != NULL){?> <li class="<? echo $result->fb_stylish ?>"><span>Is your Facebook page stylish and modern?</span><? if($result->fb_stylish_n != NULL){?><span class='cr_commit'><? echo $result->fb_stylish_n ?></span><?}?></li><?}?>
						<? if($result->fb_active != NULL){?> <li class="<? echo $result->fb_active ?>"><span>Is your Facebook page active?</span><? if($result->fb_active_n != NULL){?><span class='cr_commit'><? echo $result->fb_active_n ?></span><?}?></li><?}?>
			<? if($result->fs_exists != NULL){?> <h5>Foursquare</h5> <? }		?>
						<? if($result->fs_exists != NULL){?> <li class="<? echo $result->fs_exists ?>"><span>Is your business a Foursquare location?</span><? if($result->fs_exists_n != NULL){?><span class='cr_commit'><? echo $result->fs_exists_n ?></span><?}?></li><?}?>
						<? if($result->fs_logo != NULL){?> <li class="<? echo $result->fs_logo ?>"><span>Does your Foursquare page contain your unique logo?</span><? if($result->fs_logo_n != NULL){?><span class='cr_commit'><? echo $result->fs_logo_n ?></span><?}?></li><?}?>		
						<? if($result->fs_moderated != NULL){?> <li class="<? echo $result->fs_moderated ?>"><span>Is your Foursquare account moderated?</span><? if($result->fs_moderated_n != NULL){?><span class='cr_commit'><? echo $result->fs_moderated_n ?></span><?}?></li><?}?>		
						<? if($result->fs_active != NULL){?> <li class="<? echo $result->fs_active ?>"><span>Is your Foursquare account active?</span><? if($result->fs_active_n != NULL){?><span class='cr_commit'><? echo $result->fs_active_n ?></span><?}?></li><?}?>
	<? }
		die(); // Required
	}

	public static function givehead() {
		?>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu+Condensed">
		<?
	}
}