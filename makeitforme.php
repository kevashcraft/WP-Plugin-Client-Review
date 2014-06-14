<?
	$input_file = 'online_presence-2.html';
	$input = fopen($input_file, 'r');
	$tables_file = 'tables';
	$tables = fopen($tables_file, 'r');
	$search = "<li><span>";
	while($line = fgets($input)) {
		if(strpos($line,$search) !== false) { 
			$table = trim(fgets($tables));
			$clean = trim(str_replace("<li><span>","",str_replace("</span></li>","",$line)));
			$replace = "<? if(\$result->$table != NULL){?> <li class=\"<? echo \$result->$table ?>\"><span>"; 
//			$line = "<li><span>$clean</span><input type='radio' name='$table' id='P_$table' value='PASS'><label for='P_$table'>Pass</label> / <input type='radio' name='$table' id='F_$table' value='FAIL'><label for='F_$table'>Fail</label> / <input type='radio' name='$table' id='U_$table' value='UNKN'><label for='U_$table'>Unknown</label><span><input type='text' name='$table" . "_n'></span></li>";	

//edit.php
/*		$line = "<li><span>$clean</span>
			<input type='radio' name='$table' <? if(\$result->$table == 'PASS') echo 'checked=\'checked\''; ?> id='P_$table' value='PASS'><label for='P_$table'>Pass</label> / 
			<input type='radio' name='$table' <? if(\$result->$table == 'FAIL') echo 'checked=\'checked\''; ?> id='F_$table' value='FAIL'><label for='F_$table'>Fail</label> / 
			<input type='radio' name='$table' <? if(\$result->$table == 'UNKN') echo 'checked=\'checked\''; ?> id='U_$table' value='UNKN'><label for='U_$table'>Unknown</label>
			<span><input type='text' name='$table" . "_n' value=\"<? echo \$result->$table" . "_n ?>\"></span></li>";
*/

			$line = str_replace($search, $replace, $line);
			$osearch = "</span></li>";
			$oreplace = "</span><? if(\$result->$table"."_n != NULL){?><span class='cr_commit'><? echo \$result->$table" . "_n ?></span><?}?></li><?}?>";
			$line = str_replace($osearch, $oreplace, $line);

		}
		echo $line;
	}
	echo "\n\n\n";