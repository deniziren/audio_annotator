// Click event for the emotion icons. 
$('.item').click(function() {
  markIt(this.id);
});

// Marks the current position of the slider with the relevant emotion icon (using the id). Also logs the time of the recording and the emotion annotation.
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
        top: 115
    })
 marker.appendTo(sld);
 var value = $("#tags").val(); 
 var audioName = $("#audioFile").val();
 var emoVal = $("#emoVal").val();
	
 value = value + audioName + "," + cTime + "," + emoVal + ";";
 $("#tags").val(value);
 //alert($("#tags").val()); 
}

// Returns the icon image path for the relevant emotion. 
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

// Eventlistener for the submit button
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