<?php $type = isset($type) ? $type : Auth::user()->type ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<ol class="breadcrumb steps" style="margin-top: 40px;">
				<li @if (Request::path() === 'auth/register') class="active" @endif>Step 1 of {{ $type == 'startup' ? 3 : 2 }}</li>
				<li @if (Request::path() === 'setup/profile') class="active" @endif>Step 2 of {{ $type == 'startup' ? 3 : 2 }}</li>
				@if ($type == 'startup')
					<li @if (Request::path() === 'setup/startup') class="active" @endif>Step 3 of 3</li>
				@endif
			</ol>
		</div>
	</div>
</div>
