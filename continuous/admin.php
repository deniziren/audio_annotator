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
<DIV class="container">
<H1>ADMIN INTERFACE</H1><BR><BR>
<?php
$myfile = fopen("data.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
echo '<TABLE border=1><TR><TH>Filename</TH><TH>Time</TH><TH>Emotion</TH><TH>Timestamp</TH></TR>';
while(!feof($myfile)) {
  $line = fgets($myfile); 
  $pieces = explode(",", $line);
  if(strlen($pieces[0])>3)
  {
	echo '<TR><TD>';
	print_r(str_replace(",", "</TD><TD>", $line));
	echo '</TD></TR>';
  }
  //echo $line;
}
echo '</TABLE>';
fclose($myfile);
?>
<BR><BR>
<button type="button" id="" class="btn btn-primary btn-lg" onclick="window.location='index.php';">Home</button> <button type="button" id="" class="btn btn-danger btn-lg" onclick="window.location='resetData.php';">Delete logs</button>
</DIV>
</BODY>
</HTML>