<?php $type = isset($type) ? $type : Auth::user()->type ?>
<ol class="steps list-inline" style="margin-top: 40px;">
	<li @if (Request::path() === 'auth/register') class="active" @endif>
		<span>1</span>
		Account Setup
	</li>
	<li @if (Request::path() === 'setup/profile') class="active" @endif>
		<span>2</span>
		Personal Profile
	</li>
	@if ($type == 'startup')
		<li @if (Request::path() === 'setup/startup') class="active" @endif>
			<span>3</span>
			Startup Profile
		</li>
	@endif
</ol>
