<?php
//clientreview::addareview();

class clientreview {
	private static $tables = array();
	private static $questionnaire = array();

	public static function activate() {
		self::make_the_tables();
	}
	public static function deactivate() {
		global $wpdb;
		$table = $wpdb->prefix . 'cr_reviews';
		$stmt = "DROP TABLE IF EXISTS $table";
		$wpdb->query($stmt);
	}
	public static function adminmenu() {
		add_menu_page( 'Client Review', 'Client Reviews', 'edit_plugins', 'client-reviews', array('clientreview', 'editreviews'),"",26);
		add_submenu_page('client-reviews', 'Add a New Client Review', 'Add New', 'edit_plugins', 'client-reviews-add-new', array('clientreview', 'addareview'));
	}		


	private static function populate_tq() {
/*		if(isset(self::$questionnaire)) {
			unset(self::$questionnaire);
			self::$questionnaire = array();
		}
		if(isset(self::$tables)) {
			unset(self::$tables);
			self::$tables = array();
		}
*/		$file = dirname(__FILE__) . '/template.html';
		$fh = fopen($file,'r');
		$x = 0;
		while($line = fgets($fh)) {
			if(strpos($line, "<h3>") !== false) {
				$subject = trim(str_replace(array('<h3>','</h3>'),"",$line));
			} elseif(strpos($line, "<h4>") !== false) {
				$category = trim(str_replace(array('<h4>','</h4>'),"",$line));
				$y = 0;
			} elseif(strpos($line, "<ul>") !== false) {
				self::$tables[] = trim(str_replace('<ul>',"",$line));
			} elseif(strpos($line, "<li>") !== false) {
				self::$questionnaire[$subject][$category][$y][$x] = trim(str_replace(array('<li>','</li>'),"",$line));
				$x++;
				if($x >= 4) {
					$x=0;
					$y++;
				}		
			}
		}
		fclose($fh);
	}

	private static function make_the_tables() {
		self::populate_tq();
		global $wpdb;
		$wptable = $wpdb->prefix . 'cr_reviews';
		$stmt = "CREATE TABLE $wptable(
			id INT UNSIGNED AUTO_INCREMENT,
			business_name VARCHAR(128),
			website VARCHAR(128),
			";
		foreach(self::$tables as $table) {
			$stmt .= "$table TINYINT,
			$table" . "_n VARCHAR(512),
			"; 
		}
		$stmt .= "access_code CHAR(7),
			PRIMARY KEY  (id)
		);";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($stmt);
	}

	public static function editreviews() {
		global $wpdb;
		if(!empty($_GET['cr_id'])) { 
				self::populate_tq();
				$id = (int)$_GET['cr_id'];
				$table = $wpdb->prefix . 'cr_reviews';
				$stmt = "SELECT * FROM $table WHERE id=$id";
				$result = $wpdb->get_row($stmt, OBJECT);
				echo "<div id='clientreview_main_div'>";
				echo "<h1>Online Presence Evaluation</h1>";
				echo "<h2>$result->business_name - $result->website</h3>";		
				echo "<form>";
				echo "<input name='access_code' value='$result->access_code'>";
				echo "<input name='business_name' value='$result->business_name'>";
				echo "<input name='website' value='$result->website'>";
				$table = current(self::$tables);
				$tablen = $table . "_n";
				$cc = current(self::$questionnaire);
				while(!empty($cc)) {
					$subject = key(self::$questionnaire);
					echo "<h3>$subject</h3>";
					$cs = current(self::$questionnaire[$subject]);
					while(!empty($cs)) {
						$category = key(self::$questionnaire[$subject]);
						echo "<h4>$category</h4>";
						foreach(self::$questionnaire[$subject][$category] as $qsc) {
							if(isset($result->$table)) {
								$checked0 = "";
								$checked1 = "";
								$checked2 = "";
								$checked3 = "";
								$checked = "checked='checked'";
								switch($result->$table) {
									case 0:
										$checked0 = $checked;
										break;
									case 1:
										$checked1 = $checked;
										break;
									case 2:
										$checked2 = $checked;
										break;
									case 3:
										$checked3 = $checked;
										break;
								}
								echo "
<li>
	<span>".$qsc[$result->$table]."</span>
	<input type='radio' name='$table' id='B_$table' value='0' $checked0><label for='B_$table'>Blank</label>
	<input type='radio' name='$table' id='P_$table' value='1' $checked1><label for='P_$table'>Pass</label>
	<input type='radio' name='$table' id='F_$table' value='2' $checked2><label for='F_$table'>Fail</label>
	<input type='radio' name='$table' id='U_$table' value='3' $checked3><label for='U_$table'>Unknown</label>
	<span><input type='text' name='$tablen' value=\"" . $result->$tablen . "\"></span>
</li>
								";
							} else {
								break;
							}
							next(self::$tables);
							$table = current(self::$tables);
							$tablen = $table . "_n";
						}
						next(self::$questionnaire[$subject]);
						$cs = current(self::$questionnaire[$subject]);
					}
					next(self::$questionnaire);
					$cc = current(self::$questionnaire);
				}
				echo "</form>";
				echo "
<script type='text/javascript'>
	jQuery(document).ready(function($) {
		$('#clientreview_main_div input').attr('onfocus','input_start = this.value; console.log(input_start)');
		$('#clientreview_main_div input').attr('onblur','cr_ajaxson(this);console.log(this.value)');		
	});
	function cr_ajaxson(that) {
		if (that.value != input_start || that.getAttribute('type') == 'radio') {
			cr_editrow = that.getAttribute('name');
			cr_editval = that.value;
			jQuery.post(ajaxurl,{ action: 'cr_editreview', cr_id: ".$_GET['cr_id'].", cr_editrow: cr_editrow, cr_editval : cr_editval});
		}	
	}	
</script>
				";			
				echo "</div>";
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
	public static function addareview() {
		self::populate_tq();
//		print_r(self::$questionnaire);
		echo "<h1>Online Presence Evaluation</h1>";
		$table = current(self::$tables);
		$tablen = $table . "_n";
		$cc = current(self::$questionnaire);
		echo "<form id='clientreview_form'>";
		echo "Business Name: <input name='business_name' id='business_name'><br>";
		echo "Website: <input name='website'>";
		while(!empty($cc)) {
			$subject = key(self::$questionnaire);
			echo "<h3>$subject</h3>";
			$cs = current(self::$questionnaire[$subject]);
			while(!empty($cs)) {
				$category = key(self::$questionnaire[$subject]);
				echo "<h4>$category</h4>";
				foreach(self::$questionnaire[$subject][$category] as $qsc) {
					echo "
<li>
	<span>".$qsc[0]."</span>
	<input type='radio' name='$table' id='P_$table' value='1'><label for='P_$table'>Pass</label>
	<input type='radio' name='$table' id='F_$table' value='2'><label for='F_$table'>Fail</label>
	<input type='radio' name='$table' id='U_$table' value='3'><label for='U_$table'>Unknown</label>
	<span><input type='text' name='$tablen'></span>
</li>
					";
					next(self::$tables);
					$table = current(self::$tables);
					$tablen = $table . "_n";
				}
				next(self::$questionnaire[$subject]);
				$cs = current(self::$questionnaire[$subject]);
			};
			next(self::$questionnaire);
		$cc = current(self::$questionnaire);
		}
		echo "
	<input name='action' type='hidden' value='cr_addareview'>
	<button>Add Review</button>
</form>
<script type='text/javascript'>
	jQuery(document).ready(function($){
		document.getElementById('business_name').focus();
		$('#clientreview_form button').click(function(){

			console.log('alive');
			var crdata = $('#clientreview_form').serialize();
			console.log(crdata);
			$.post(ajaxurl, crdata, function(response){
				console.log(response);
				document.location = 'admin.php?page=client-reviews-add-new';
			});
			return false;
		});
	});
</script>
		";
	}		

	public static function addareview_receiver() {
		global $wpdb;
		$wptable = $wpdb->prefix . 'cr_reviews';
		do {
			$cr_ac = rand(1000000, 9999999);
		} while($wpdb->get_row("SELECT * FROM $wptable WHERE access_code=$cr_ac") != NULL);
		$data = array();
		self::populate_tq();
		$data['business_name'] = $_POST['business_name'];
		$data['website'] = $_POST['website'];
		foreach(self::$tables as $table) {
			$data[$table] = $_POST[$table];
			$tablen = $table . "_n";
			$data[$tablen] = $_POST[$tablen];
		}
		$data['access_code'] = $cr_ac;
		print_r($data);		
		$wpdb->insert($wptable, $data);
		die(); //Required
	}

	public static function showreview() {
		wp_enqueue_script('clientreview');
		?>
			<div id="crpi_review">
				<h2>Online Presence Reviews</h2>
				<p>Enter your 7-digit access code below to view your review</p>
				<br>
				<b>Access code:</b> <input type="number" maxlength="7" onkeyup="cr_getter(this)" id="crpi_ac">
				<br>
				<br>
				<h3>Don't have a code?</h3>
				<p><a href='https://logicdudes.com/wp-content/uploads/2014/05/number.png' class='prettyPhoto' data-jqt='mobile-tel'>Call us</a> and we will review your company's online footprint and send you your code!</p>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					document.getElementById('crpi_ac').focus();
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
		if(!$result) {
			echo "
Try Again<br>
Access code: <input type='number' maxlength='7' onkeyup='cr_getter(this)' id='cr_ac'>
			";
		} else {
			echo "
<h1>Online Presence Evaluation</h1>
<h2>$result->business_name - $result->website</h2>		
			";
			self::populate_tq();
			$table = current(self::$tables);
			$tablen = $table . "_n";
			$cs = current(self::$questionnaire);
			while(!empty($cs)) {
				$subject = key(self::$questionnaire);
				$cc = current(self::$questionnaire[$subject]);
				$subshow = true;
				while(!empty($cc)) {
					$category = key(self::$questionnaire[$subject]);
					$catshow = true;
					foreach(self::$questionnaire[$subject][$category] as $qsc) {
						if(isset($result->$table)) {
							if($result->$table != 0){
								if($subshow) echo "<h3>$subject</h3>";
								$subshow = false;
								if($catshow) echo "<h4>$category</h4><div class='crpi_review_category'>";
								$catshow = false;
								echo "<li class='crpi_review_score".$result->$table."'>".$qsc[$result->$table];
								$iscode = false;
								if(!empty($result->$tablen)) {
									if(strlen($result->$tablen) > 4) {
										if(substr($result->$tablen,3,1) == ":") {
											$iscode = true;
											$scode = substr($result->$tablen, 0, 3);
											$cont = substr($result->$tablen, 4);
											switch($scode) {
												case 'img':
													echo "<div class='crpi_review_note'><img src='$cont'></div>";
													break;
												default:
													$iscode = false;
											}
										}
									}
									if(!$iscode) {
										echo "<div class='crpi_review_note'>".$result->$tablen."</div>";
									}
								}
								echo "</li>";
							}
						}
						next(self::$tables);
						$table = current(self::$tables);
						$tablen = $table . "_n";
					}
					if(!$catshow) echo "</div>";
					next(self::$questionnaire[$subject]);
					$cc = current(self::$questionnaire[$subject]);
				}
				next(self::$questionnaire);
				$cs = current(self::$questionnaire);
			}
			self::style();
		}
		die(); // Required
	}

	public static function givehead() {
		?>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed">
		<?
	}
	public static function style() {
		echo "
<style type='text/css'>
			#crpi_review{
				font-family: 'Ubuntu Condensed';
				display: block;
				overflow: hidden;
				position: relative;
				left: 0;
				padding: 25px;
				padding-bottom: 75px;
			}
			#crpi_review h1 {
				font-family: 'Ubuntu Condensed';
			}
			#crpi_review h2 {
				font-family: 'Ubuntu Condensed';
				font-size: 19px;
				font-weight: normal;
			}
			#crpi_review h3 {
				font-family: 'Ubuntu Condensed';
				padding: 35px 0 15px 0;
			}
			#crpi_review_category {
				display: block;
			}

			#crpi_review li {
				font-family: 'Ubuntu';
				font-size: 16px;
				margin-left: 45px;
				display: block;
				padding: 15px;
				position: relative;
				border-radius: 7px;
			}
			.crpi_review_note{
				padding: 35px;
				box-shadow: 5px 5px 15px black;
				background: rgba(213, 236, 255, 1);
				position: absolute;
				top: 0;
				right: -100%;
				font-weight: bold;
				font-size: 18px;
				max-width: 60%;
				z-index: 10;
			}
			
			#crpi_review li:hover{
				cursor: pointer;
				box-shadow: 1px 1px 7px black;			
				background-color: rgba(213, 236, 255, .6);
			}	
			#crpi_review li.active{
				background-color: rgba(95, 181, 255, .6);			
			}		
			#crpi_review li:before{
				position: absolute;
				top: -10px;
				left: -50px;
			}
			
			#crpi_review li:before{
			    background-size: cover;
			    content: '';
 			 	height: 20px;
				 width: 20px;
				 position: absolute;
				 left: -25px;
				 vertical-align: middle;
				 top: 9px;	
				 background-position: center center;
			}			
			
			.crpi_review_score1:before {
			    background-image: url('https://logicdudes.com/wp-content/plugins/clientreview/img/green-check.png');
			    
			}
			.crpi_review_score2:before {
			    background-image: url('https://logicdudes.com/wp-content/plugins/clientreview/img/red-x.png');
			}
			.crpi_review_score3:before {
			    background-image: url('https://logicdudes.com/wp-content/plugins/clientreview/img/black-question.png');
			}
</style>
			";			
	}
}