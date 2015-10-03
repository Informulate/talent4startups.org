<div class="flag-content">
    <span class="link">
        <i class="glyphicons-flag glyphicons"></i>
        Flag Content
    </span>
    <div class="report" style="display: none; ">
        <textarea cols="40" rows="2" placeholder="If it's not obvious please let us know why this content is objectionable"></textarea>
        <input type="hidden" name="page" value="{{ Request::url() }}" />
        <input type="hidden" name="token" value="{{ csrf_token() }}" />
        <p class="submit btn btn-default">Report</p>
    </div>
</div>