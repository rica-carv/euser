jQuery(function($){
    function atualizarAvatares() {
        var $avatars = $('.user-avatar');
        if (!$avatars.length) return;

        // Recolher IDs e remover duplicados
        var ids = [];
        $avatars.each(function(){
            var idAttr = $(this).attr('id');
            if (!idAttr) return;
            var id = parseInt(idAttr.replace(/[^\d]/g,''), 10);
            if (id) ids.push(id);
        });
        ids = Array.from(new Set(ids));
        if (!ids.length) return;

        // AJAX para o handler
        $.ajax({
            type: 'POST',
            url: ajaxUrl, // variável definida via e107::js()
            data: { ids: ids },
            dataType: 'json',
            success: function(data){
                if (!data.online) return;

                $avatars.each(function(){
                    var $img = $(this);
                    var idAttr = $img.attr('id');
                    if (!idAttr) return;
                    var id = parseInt(idAttr.replace(/[^\d]/g,''), 10);
                    if (!id) return;

                    // Atualiza o avatar
                    $img.toggleClass('user-avatar-online', data.online[id] === 'online');

                    // Atualiza o <a> ou outro wrapper
                    var $parentLink = $img.closest('a');
                    if ($parentLink.length) {
                        $parentLink.removeClass('euseron euseroff')
                                   .addClass(data.online[id] === 'online' ? 'euseron' : 'euseroff');
                    }
                });
            },
            error: function(xhr, status, err){
                console.warn('avatarStatus: AJAX ERRO →', status, err);
            }
        });
    }

    // Chamada inicial e atualização periódica (60s)
    atualizarAvatares();
    setInterval(atualizarAvatares, 60000);
});
