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


	$('.flag-content .link').on('click', function() {
		$(this).parent().children('div.report').slideToggle();
	});

	$('.flag-content .submit').on('click', function() {
		formData = {page: $(this).parent().children('input[name="page"]').val(), message: $(this).parent().children('textarea').val(), _token: $(this).parent().children('input[name="token"]').val()};
		$.ajax({
			method: 'POST',
			url: "/flag",
			data: formData
		}).done(function() {
			$('.flag-content .link').html('Report submitted - Thanks for your feedback!');
			$('.flag-content div.report').slideUp();
		});
	});
});
