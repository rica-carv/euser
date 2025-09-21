var replaceurltext = function(element, find, replace) {
      /*
            var url = $('.mylink').attr('href');
            url = url.replace('us-test', 'replaced-text');
            $('.mylink').attr('href', url);
      */
      //      console.log (e);
      
            var url = element.attr('href');
            url = url.replace(find, replace);
            element.attr('href', url);
      }
      
      $(function () {
        $('#ltype').change(function () {
//            console.log('Toggle: ' + $(this).prop('checked'));
      
            if ($(this).prop('checked')) {
      
            $( 'a.havexc' ).each(function() {
              $(this).html($(this).attr('data-html'));
              var self = $(this);
              $.each($(this).data('events'), function (_, e) {
                self.on(e[0].type, e[0].handler);
              });
            }).addClass('have imagepop').removeClass('havexc');
      
            $('#phil_pdf, #phil_print').each(function (){replaceurltext($(this), '.x', '.d')});
      
            } else {
      
            $( 'a.have' ).each(function(){
              $(this).attr('data-html', $(this).html()).data('events', $.extend(true, {}, $._data(this, 'events')));
            }).off().html(' | ');
            $( 'a.have' ).addClass('havexc').removeClass('have imagepop');
      
            $('#phil_pdf, #phil_print').each(function (){replaceurltext($(this), '.d', '.x')});
          
            }
      
        });
      });