<!DOCTYPE html>
<html lang="en">
<HEAD>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="main.css">
	
	<title>Audio Annotator: Discrete by Bin Zihnin Sesi | Voice of a Thousand Minds</title>
</HEAD>
<BODY>
	<div class="container" style="width: 100%;">
	
	<H2>Annotate!</H2>		
	<br>
	<P>Please listen to the audio file and try to understand the emotion in the voice. Then, select the corresponding emotion from the list below.<br><br>
<?php
$dir    = 'input/';
$files1 = scandir($dir);

$log_array = array();
$myfile = fopen("data.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  //echo fgets($myfile) . "<br>";
  $line = fgets($myfile); 
  $pieces = explode(",", $line);
  if(strlen($pieces[0])>3)
  {
	array_push($log_array, $pieces[0]);
  }
   
}
  
fclose($myfile);

$arrlen_files = count($files1);

echo "<ul class='audioPlayer'>";
$moreFiles = false;
for($x = 0; $x < $arrlen_files; $x++) 
{
	if(strlen($files1[$x])>3)
	{
		if (in_array($files1[$x], $log_array)) 
		{
			// Do nothing.
		}
		else
		{
			$moreFiles = true;
			echo "<audio src='input/" . $files1[$x] .  "' controls='controls' id='player'></audio><br><br><br>";
			echo "<form action='write.php' method=POST><input type='hidden' id='filename' name='filename' value='". $files1[$x] ."'>
			<div class='item'><label><input type='checkbox' id='opt_anger' name='emotion' value='anger'><img src='img/anger.png' class='emotions'><span class='caption'>Anger</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_disgust' name='emotion' value='disgust'><img src='img/disgust.png' class='emotions'><span class='caption'>Disgust</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_sad' name='emotion' value='sadness'><img src='img/sadness.png' class='emotions'><span class='caption'>Sadness</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_fear' name='emotion' value='fear'><img src='img/fear.png' class='emotions'><span class='caption'>Fear</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_surprise' name='emotion' value='surprise'><img src='img/surprise.png' class='emotions'><span class='caption'>Surprise</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_happy' name='emotion' value='happiness'><img src='img/happiness.png' class='emotions'><span class='caption'>Happiness</span></label></div>
			<div class='item'><label><input type='checkbox' id='opt_neutral' name='emotion' value='neutral'><img src='img/neutral.png' class='emotions'><span class='caption'>Neutral</span></label></div>
			
			</form>";

			break;		
		}
	}
}
echo "</ul>";
if(!$moreFiles)
{
	echo 'no more files left to annotate.';
}
else
{
	echo "<br><button type='button' id='submit' class='btn btn-primary btn-lg submit'>Submit</button>";
}
echo '<br><br><progress class="progress_bottom" max="' . ($arrlen_files - 2) . '" value="' . count($log_array) . '"></progress></div>';
?>

	<script src="script.js"></script>
</BODY>
</HTML>