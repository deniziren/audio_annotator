<!DOCTYPE html>
<HTML lang="en">
<HEAD>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Audio Annotator: Continuous by Bin Zihnin Sesi | Voice of a Thousand Minds</title>
</HEAD>
<BODY>
	<div class="container" style="width: 100%;">
		<H2>Annotate!</H2>
			<P>Please listen to the audio file. Whenever you detect an emotion, please place a mark by selecting the corresponding emotion icon from the list below.
<?php
$dir    = 'input/';
$files1 = scandir($dir);

$log_array = array();
$myfile = fopen("data.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  $line = fgets($myfile); 
  $pieces = explode(",", $line);
  if(strlen($pieces[0])>3)
  {
	  if(!in_array($pieces[0], $log_array))
	  {
		array_push($log_array, $pieces[0]);
	  }
  } 
}
fclose($myfile);

$arrlen_files = count($files1);
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

			echo '<div class="container" style="width: 100%;">';
				echo '<audio id="myaudio" src="input/' . $files1[$x] .  '" controls="off">';
			echo '</div><br><br>';
			
			echo '<div class="progress">';
				echo '<div id="leftbar"></div>';
				echo '<div id="slider" class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">';
				
				echo '<div id="anger" class="item"><img src="img/anger.png" class="emotions"><span class="caption">Anger</span></div>';
				echo '<div id="disgust" class="item"><img src="img/disgust.png" class="emotions"><span class="caption">Disgust</span></div>';
				echo '<div id="sadness" class="item"><img src="img/sadness.png" class="emotions"><span class="caption">Sadness</span></div>';
				echo '<div id="fear" class="item"><img src="img/fear.png" class="emotions"><span class="caption">Fear</span></div>';
				echo '<div id="surprise" class="item"><img src="img/surprise.png" class="emotions"><span class="caption">Surprise</span></div>';
				echo '<div id="happiness" class="item"><img src="img/happiness.png" class="emotions"><span class="caption">Happiness</span></div>';
				echo '<div id="neutral" class="item"><img src="img/neutral.png" class="emotions"><span class="caption">Neutral</span></div>';
				
				echo '</div>';
				echo '<div id="rightbar"></div>';
			echo '</div>';
			echo '<br><button type="button" id="submit" class="btn btn-primary btn-lg submit">Submit</button><input id="audioFile" type="hidden" value="' . $files1[$x] .  '"><input id="emoVal" type="hidden" value="">';
		
		break;
		}
	}
}
if(!$moreFiles)
{
	echo '<br><br>no more files left to annotate.';
}
echo	'</div><input id="tags" type="hidden" value="">';
?>
		
	<script src="script.js"></script>
</BODY>
</HTML>