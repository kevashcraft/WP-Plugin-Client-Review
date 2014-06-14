<?php

// Collect Tables
$file = "template.html";
$fh = fopen($file,'r');
$x = 0;
$questionare = [];
$tables = [];

while($line = fgets($fh)) {
	if(strpos($line, "<h3>") !== false) {
		$subject = trim(str_replace(array('<h3>','</h3>'),"",$line));
	} elseif(strpos($line, "<h4>") !== false) {
		$category = trim(str_replace(array('<h4>','</h4>'),"",$line));
		$y = 0;
	} elseif(strpos($line, "<ul>") !== false) {
		$tables[] = trim(str_replace('<ul>',"",$line));
	} elseif(strpos($line, "<li>") !== false) {
		$questionare[$subject][$category][$y][$x] = trim(str_replace(array('<li>','</li>'),"",$line));
		$x++;
		if($x >= 4) {
			$x=0;
			$y++;
		}		
	}
}
fclose($fh);
$table = current($tables);

echo "<h1>Online Presence Evaluation</h1>";
echo "<h2>business_name - ->website</h2>";
echo "<form id='cr_edit_form'>";
while(!empty(current($questionare))) {
	$subject = key($questionare);
//	echo "<h3>$subject</h3>";
	while(!empty(current($questionare[$subject]))) {
		$category = key($questionare[$subject]);
//		echo "<h4>$category</h4>";
		foreach($questionare[$subject][$category] as $qsc)
		if(true) {
//			echo "<li class='c1'>" . $qsc[2] . "</li>";
		}
		next($questionare[$subject]);
		next($tables);
		$table = current($tables);
	}
	next($questionare);
}
fclose($tfh);
print_r($tables);