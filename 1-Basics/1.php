<?php 

	unset($argv[0]);

	function get_formatted_nr_of_letters($len, $counter) {
		$letters = (string) $len - $counter;
	
		if(strlen($letters) < 2) {
			return $letters . " ";
		}
		else {
			return $letters;
		}
	}

	function print_diamond(string $str) : string{
		$len = strlen($str);
		$diamond = "";
		
		for($i=-$len+1; $i<=$len-1; $i = $i+2) {
			$counter = abs($i);
			
			$nr_of_letters = $len - $counter;
			
			$word = substr($str, $counter/2, $nr_of_letters);
			$spaces = str_repeat(" ", floor($counter/2));
			
			$nr_of_letters_str = get_formatted_nr_of_letters($len, $counter);
			
			$diamond .= $nr_of_letters_str . " " . $spaces . $word . $spaces . PHP_EOL;
		}
		
		return $diamond;
	
	}

	foreach($argv as $key => $arg) {
		echo print_diamond($arg) . PHP_EOL;
	}

	
?>


