@if (Auth::user())
    <div class="social-likes" style="margin: 10px 0;">
        <h4>Tell your friends: </h4>
        <br/>
        <a href="#"><i class="social social-facebook"></i></a> <a href="#"><i class="social social-twitter"></i></a> <a href="#"><i class="social social-google-plus"></i></a>
    </div>
@else
    <div style="margin: 10px 0;">&nbsp;</div>
@endif
