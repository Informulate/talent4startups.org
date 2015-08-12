video_count = 1;
videoPlayer = document.getElementById("videos");

function run() {
	video_count++;
	if (video_count == 4) video_count = 1;
	var nextVideo = "videos/clip" + video_count + ".mp4";
	videoPlayer.src = nextVideo;
	videoPlayer.play();
};

// If there is an announcement, when closed marked as accepted
$(document).ready(function() {
	$('#announcement').on('closed.bs.alert', function () {
		$.get( "/announcement/accept", function() {});
	});
});
