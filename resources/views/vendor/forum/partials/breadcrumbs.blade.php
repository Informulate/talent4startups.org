<ol class="breadcrumb">
    @if (isset($parentCategory) && $parentCategory)
        <li><a href="{!! $parentCategory->route !!}">{!! $parentCategory->title !!}</a></li>
    @endif
    @if (isset($category) && $category)
        <li><a href="{!! $category->route !!}">Index</a></li>
    @endif
    @if (isset($thread) && $thread)
        <li><a href="{!! $thread->route !!}">{!! $thread->title !!}</a></li>
    @endif
    @if (isset($other) && $other)
        <li>{!! $other !!}</li>
    @endif
</ol>
