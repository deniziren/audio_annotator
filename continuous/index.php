<!DOCTYPE html>
<HTML lang="en">
<HEAD>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!--<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">-->
	<script src="https://use.fontawesome.com/dde2fd55a0.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	
	<!--<script src="https://use.fontawesome.com/f0f3d079bf.js"></script>-->
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
		
		
<script>
$('.item').click(function() {
  //alert(this.id);
  markIt(this.id);
});
 
function markIt(id)
{
 var imageName = getMarkerImageName(id);

 var sld = document.getElementById("slider");
 var audio = document.getElementById("myaudio");
 var cTime = audio.currentTime;
 var duration = audio.duration;
 var percentage = cTime / duration;
 var sliderWidth = document.getElementById("slider").offsetWidth; 
 var sliderX = document.getElementById("slider").offsetLeft;
 //alert(sliderX);
 var putMark = sliderX - 28 + (sliderWidth * percentage);
 var marker = $('<img class="sliderMarker" src="' + imageName + '" style="position:absolute;">').addClass('marker'); //your marker class
    marker.css({
        left: putMark,
        top: 210
    })
    marker.appendTo(sld);
	var value = $("#tags").val();
	var audioName = $("#audioFile").val();
	var emoVal = $("#emoVal").val();
	
	value = value + audioName + "," + cTime + "," + emoVal + ";";
$("#tags").val(value);
//alert($("#tags").val()); 
}

function getMarkerImageName(id)
{
	switch(id)
	{
		case 'anger':
		$("#emoVal").val("anger");
			return 'img/anger.png';
		case 'disgust':
		$("#emoVal").val("disgust");
			return 'img/disgust.png';
		case 'sadness':
		$("#emoVal").val("sadness");
			return 'img/sadness.png';
		case 'fear':
		$("#emoVal").val("fear");
			return 'img/fear.png';
		case 'surprise':
		$("#emoVal").val("surprise");
			return 'img/surprise.png';
		case 'happiness':
		$("#emoVal").val("happiness");
			return 'img/happiness.png';
		case 'neutral':
		$("#emoVal").val("neutral");
			return 'img/neutral.png';
		default:
			return 'marker_area.png';
	}
}
$('#submit').click(function() {
var send = $("#tags").val();
//alert(send);
    $.ajax({
        url: 'write_continuous.php',
        type: 'POST',
        data: {
			annotations: $('#tags').val()
			
        },
        success: function(msg) {
            //alert('Done');
			//alert($('input[name=emotion]:checked').val());
			location.reload();
        }               
    });
});
</script>
</BODY>
</HTML>