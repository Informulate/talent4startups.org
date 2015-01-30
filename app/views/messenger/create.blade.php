@extends('layouts.default')

@section('content')
<h1>Create a new message</h1>
{{Form::open(['route' => 'messages.store'])}}
<div class="col-md-6">
    <!-- Subject Form Input -->
    <div class="form-group">
        {{ Form::label('recipient_ac', 'To ', ['class' => 'control-label']) }}
        {{ Form::text('recipient_ac', null, ['class' => 'form-control', 'autocomplete' => 'on', 'autofocus' => 'autofocus', 'placeholder' => 'Start typing the name(s) of others you are connected with']) }}
        {{ Form::hidden('recipients', $recipient->id, ['class' => 'form-control', 'id' => 'recipients']) }}
        <ul id="recipient_list" class="list-inline">
            <span class="text-muted">Recipients: </span>
        @if ($recipient->id > 0)
            <li class="btn btn-default btn-xs" rel="{{ $recipient->id }}">{{ $recipient->profile->first_name }} {{ $recipient->profile->last_name }}</li>
        @endif
        </ul>
        {{ Form::label('subject', 'Subject', ['class' => 'control-label']) }}
        {{ Form::text('subject', null, ['class' => 'form-control']) }}
    </div>

    <!-- Message Form Input -->
    <div class="form-group">
        {{ Form::label('message', 'Message', ['class' => 'control-label']) }}
        {{ Form::textarea('message', null, ['class' => 'form-control']) }}
    </div>


    
    <!-- Submit Form Input -->
    <div class="form-group">
        {{ Form::submit('Submit', ['class' => 'btn btn-primary form-control']) }}
    </div>
</div>
{{Form::close()}}
@stop

@section('javascript')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
      function split( val ) {
        return val.split( /,\s*/ );
      }
      function extractLast( term ) {
        return split( term ).pop();
      }

  $( "#recipient_ac" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
         $.ajax({
          url: "{{ route('messages.search') }}/" + request.term,
          dataType: "json",
          success: function (data) {
                response($.map(data.data, function (item) {
                    return {
                        label: item.first_name + ' ' + item.last_name, //map properties used in class returned by JSON to what autocomplete wants
                        value: item.id
                    }
                }))
          }
         });
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 2 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = $("#recipients").val().split("/,/");
          terms.push(ui.item.value);
          $('#recipient_list').append('<li class="btn btn-default btn-xs" rel="' + ui.item.value + '">' + ui.item.label + '</li>');
          $("#recipients").val(terms.join());
          this.value = "";
          return false;
        }
      });

      $('#recipient_list').on('click', 'li', function() {
        var user_id = $(this).attr('rel');
        $(this).remove();
        var terms = $("#recipients").val().split(',');
        for(var i = terms.length - 1; i >= 0; i--) {
            if(terms[i] === user_id) {
               terms.splice(i, 1);
            }
        }
        $("#recipients").val(terms.join());
      });
  });
  </script>
@stop