  $('#listingu a').click(function(){
//    console.log($(location).attr('href'));
//    window.location.href = $(location).attr('href')+"."+$(this).attr('data-popimage')+"|"+$(this).attr('data-code');
//    var pageurl = $(location).attr('href')+"."+$(this).attr('data-popimage')+"|"+$(this).attr('data-code');
//    console.log(pageurl);
//    alert ($(location).attr('href')+"."+$(this).attr('data-popimage')+"|"+$(this).attr('data-code'));
    var pushedA = $(this);
    $.ajax({
//      url: pageurl,
      url: $(location).attr('href')+"."+$(this).attr('data-phl-image')+"|"+$(this).attr('data-phl-code'),
//////      url: 'testeajax.php',
        dataType: 'json',
        success: function(result){
          pushedA.toggleClass('col list');
          var title = 'Adicionar';
//          var code = '';
          if( pushedA.hasClass('col')){
            title = 'Remover';
//            code = result.val;
          }
//          pushedA.attr('title', title).attr('data-code', code);
          pushedA.attr('title', title).attr('data-phl-code', result.val);
//          console.log(arguments);
//          console.log(result.val);
          alert(result.text);
        }, 

//      error: alert("ERRO!!!!"+function(xhr){xhr.responseText})
error: function(xhr, status, error) {
          console.log(arguments);
  var err = eval("(" + xhr.responseText + ")");
  alert(err.Message);
}
    });

//    e.observe('click',tclass);

  });
//  $('#listingu a').each(function(e) {
//    e.observe('click',tclass);
//  });

//	document.write("<link rel='stylesheet' href='../phil/dialog/dialog_box.css' type='text/css'>");
//	document.write("<script src='../phil/dialog/dialog_box.js'><\/script>");
/*    
function tclass(e) {
  new Ajax.Request(this.href, {
    method: 'GET',
    dataType: 'json',
    onSuccess: successFunc(this),
    onFailure:  failureFunc,
// O showDialog est� temporariamente desligado - o servidor p�ra de responder ao tentar fechar o dialog....
//    onLoading: function() {
//        showDialog('','<span><img src="../phil/images/loading.gif">&nbsp;&nbsp;POR FAVOR AGUARDE&nbsp;&nbsp;<img src="../phil/images/loading.gif"></span>','warning',1000);
//      },
    });

  function successFunc(el){
    return function(response){ // Your old success function
      var mouseoverevent = el.onmouseover; 
      var strevent=mouseoverevent.toString();
      var imageurl=strevent.match(/plugins([^}]*)jpg/)[1];
      var json = response.responseText.evalJSON(true);
// O showDialog est� temporariamente desligado - o servidor p�ra de responder ao tentar fechar o dialog....
//      showDialog('','<img src="..'+imageurl.replace('/d/', '/t/')+'jpg"><br>'+json.text,'success',3);

      if (el.href.indexOf('|')>0) {
        var href = el.href.split('|')[0]; 
        var elt = 'Adicionar';
// Por enquanto, fica desactivado, o phil_edit ainda n�o est� a 100%
//        if (el.next().readAttribute('title')=='Editar') {
//          el.next().remove();
//        }
      } else {
        var href = el.href+'|'+json.val;
        var elt = 'Remover';
// Por enquanto, fica desactivado, o phil_edit ainda n�o est� a 100%
//        el.insert({after: '<a title=\'Editar\' href=\'phil_edit.php?'+json.val+'\'><img src=\'../phil/images/edit.png\'></img></a>'});
      }
      // Mudan�a do titulo...
      el.href = href; 
      el.setAttribute('title', elt);
      // Mudan�a da cor...
      el.toggleClassName('col');
      el.toggleClassName('list');
  }
}

function failureFunc(response){
  var json = response.responseText.evalJSON(true);
// O showDialog est� temporariamente desligado - o servidor p�ra de responder ao tentar fechar o dialog....
//  showDialog('',json.text,'error');
//      showDialog('',response.responseText,'error',3);

//      alert(response.responseText);

}
  e.stop();
  */