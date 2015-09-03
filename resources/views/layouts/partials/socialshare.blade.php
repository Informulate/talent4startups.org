@if (Auth::user())
    <div class="social-likes" style="margin: 10px 0;">
        <h4>Share: </h4>
        <div class="facebook" title="Share link on Facebook">Facebook</div>
        <div class="twitter" title="Share link on Twitter">Twitter</div>
        <div class="plusone" title="Share link on Google+">Google+</div>
    </div>
@else
    <div style="margin: 10px 0;">&nbsp;</div>
@endif