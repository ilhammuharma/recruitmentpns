<?php
include("config.php");

$url = $_GET['url'];

function get_word($url){
	$fd = @fopen($url, "r");
	$word = "";
	while(!feof($fd)){
		$buffer = fgets($fd,1024);
		$buffer = trim($buffer);
		$buffer = strip_tags($buffer);
		$explode = explode(" ", $buffer);
		for($i = 0 ; $i<=sizeof($explode); $i++){
			$kata = stripslashes(strtolower($explode[$i]));
			$word .= $kata." ";
		}
	}

	return $word;
}

function populate($url){
	$fd = @fopen($url,"r");
	$word = "";
	$temp = array();
	while($buffer = fgets($fd,1024)){
		$buffer = trim($buffer);
		$buffer = strip_tags($buffer);
		$buffer = preg_replace('/&\w;/', '', $buffer);
		$kata = addslashes(strtolower($buffer));
		$word .= $kata." ";
	}
	return $word;
}

function populate_word($url){
	error_reporting(E_ALL & ~E_NOTICE);
	$fd = fopen($url,"r");
	$kata = '';
	$getStopWord = mysql_query("SELECT stopWord FROM stopWord");
	$temp = array();

	while($result = mysql_fetch_array($getStopWord)){
	   array_push($temp, $result['stopWord']);
	}

	while( $buf = fgets($fd,1024) ){
	   /* Remove whitespace from beginning and end of string: */
	   $buf = trim($buf);

	   /* Try to remove all HTML-tags: */
	   $buf = strip_tags($buf);
	   $buf = preg_replace('/&\w;/', '', $buf);

	   /* Extract all words matching the regexp from the current line: */
	   preg_match_all("/(\b[\w+]+\b)/",$buf,$words);

	   for( $i = 0 ; $words[$i]; $i++){
	      for($j = 0; $words[$i][$j]; $j++){
	         $word = addslashes(strtolower($words[$i][$j]));
	         if(!in_array($word, $temp)){
	            array_push($temp, $word);
	            $kata .= " ".$word." ";
	         }
	      }
	   }
	}

	return $kata;
}

echo "<h3>Fungsi Populate Sederhana</h3>";
$word = populate($url);
echo "<div>".$word."</div>";

echo "<h3>Fungsi Populate Ribet</h3>";
$ribet = populate_word($url);
echo "<div>".$ribet."</div>";

echo "<h3>Function GET WORD</h3>";
$fungsiGetWord = get_word($url);
echo "<div>".$fungsiGetWord."</div>";

?>