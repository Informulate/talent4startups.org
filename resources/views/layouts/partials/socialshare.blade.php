@if (Auth::user())
    <div class="social-likes social-likes_vertical social-likes_light" style="margin: 10px 0;">
        <h4>Tell your friends @if(isset($user)) about {{ $user->first_name }} @elseif(isset($startup)) about {{ $startup->name }} @endif: </h4>
        <div class="facebook" title="Share link on Facebook">Facebook</div>
        <div class="twitter" title="Share link on Twitter">Twitter</div>
        <div class="plusone" title="Share link on Google+">Google+</div>
    </div>
@endif
