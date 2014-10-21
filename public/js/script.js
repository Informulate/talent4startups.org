jQuery( function($) {
  $( 'a.delete' ).on( 'click', function()
  {
    var
      id = $( this ).attr( 'id' );

    if( confirm( 'Really Delete?' ) )
    {
      $.ajax({
        type: 'DELETE',
        url: window.location.pathname + '/' + id,
        success: function( result )
        {
          $( 'a#' + id ).closest( 'tr' ).remove();
        }
      });
    }
  });

  // Colorbox
  $( '.icon a i.fa.fa-info-circle' ).on( 'click', function() {
    var projectid = $(this).data( 'projectid' ),
        url = $( '.icon a i.fa.fa-info-circle' ).data( 'url' );

    $(this).colorbox({
      href: url + '?projectid=' + projectid,
      width: '50%',
      height: '50%',
      scrolling: false
    });
  })
});