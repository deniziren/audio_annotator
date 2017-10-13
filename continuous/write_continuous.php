<?php
echo ($_POST['annotations']);

$myfile = fopen("data.txt", "a") or die("Unable to open file!");

$timestamp = date("Y-m-d H:i:s");
$annotations = $_POST['annotations'];

$pieces = explode(";", $annotations);
$txt = "";
$a = 0;
foreach($pieces as $i =>$key) 
{
	$a = $a + 1;
	$i >0;
    //echo $i.' '.$key .'</br>';
	
	if($a < count($pieces))
	{
		$txt = $txt . $key . "," . $timestamp . "\r\n";
	}
	else
	{
		$txt = $txt . $key;
	}
	
}

fwrite($myfile, $txt);

fclose($myfile);

?>