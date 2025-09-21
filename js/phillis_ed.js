/*
    // Create a new div element 
    const divElement = document.createElement('div'); 
     
    // Set the ID of the element 
    divElement.id = 'phillis-toast-container'; 
     
    // Optionally, add some text content 
//    divElement.textContent = 'Hello, World!'; 
    // Set the class of the element 
    divElement.className = 'toast-container bottom-0 end-0 p-3'; 

    // Append the element to the body or another container 
    document.body.appendChild(divElement); 
*/

/**
 * UI Toasts
 */

"use strict";

// Bootstrap toasts example
// --------------------------------------------------------------------
// window.onload = (event) => {
/*
const baseEl = `<div class="bs-toast toast toast-placement-ex m-2" role="alert" aria-live="assertive" aria-atomic="true" data-phil-toast="stack">
                    <div class="toast-header">
                        <span class="toast-icon">
                            <i class="fa fa-bell me-2"></i>
                        </span>
                        <div class="me-auto fw-bolder toast-title">Bootstrap</div>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>`;
*/
const baseEl = ``;
//                <div class="toast-body toast-message">Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.</div>

// document.body.innerHTML += baseEl;
//document.querySelector(".content-toast").innerHTML += baseEl;
document.querySelector("#phillis-toast-container").innerHTML += baseEl;

// placement position
const TopLeft = "top-0 start-0";
const TopCenter = "top-0 start-50 translate-middle-x";
const TopRight = "top-0 end-0";
const MiddleLeft = "top-50 start-0 translate-middle-y";
const MiddleCenter = "top-50 start-50 translate-middle";
const MiddleRight = "top-50 end-0 translate-middle-y";
const BottomLeft = "bottom-0 start-0";
const BottomCenter = "bottom-0 start-50 translate-middle-x";
const BottomRight = "bottom-0 end-0";

const toastContainer = document.getElementById('phillis-toast-container');
const targetElement = document.querySelector('[data-phil-toast="stack"]'); // Use CSS class or HTML attr to avoid duplicating ids

const toastPlacementExample = document.querySelector(".toast-placement-ex");
const toastPlacementBtn = document.querySelector("#showToastPlacement");
const toastTitle = document.querySelector(".toast-title");
const toastMessage = document.querySelector(".toast-message");
const toastIcon = document.querySelector(".toast-icon");
let selectedType, selectedPlacement, toastPlacement;

// Dispose toast when open another
/*
function toastDispose(toast) {
    if (toast && toast._element !== null) {
        if (toastPlacementExample) {
            toastPlacementExample.classList.remove(selectedType);
            DOMTokenList.prototype.remove.apply(
                toastPlacementExample.classList,
                selectedPlacement
            );
        }
        toast.dispose();
    }
}
*/
//*---function bootstrapToast(selectedType, title, message, icon, position) {
//    if (toastPlacement) {
//        toastDispose(toastPlacement);
//    }
/*
    // Create new toast element
    const newToast = document.querySelector(".toast").cloneNode(true);
    document.querySelector(".toast-container").append(newToast);

    // Create new toast instance --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#getorcreateinstance
    const toast = bootstrap.Toast.getOrCreateInstance(newToast);
*/    
/*---
    selectedPlacement = position ? position.split(" ") : TopCenter.split(" ");

    toastPlacementExample.classList.add(selectedType);
    DOMTokenList.prototype.add.apply(
        toastPlacementExample.classList,
        selectedPlacement
    );

    toastTitle.textContent = title;
//    toastMessage.textContent = message;
    if (icon) toastIcon.innerHTML = icon;

    const newToast = targetElement.cloneNode(true);
    toastContainer.append(newToast);
---*/
//  const newToast = document.querySelector(".bs-toast").cloneNode(true);
//  toastPlacement = bootstrap.Toast.getOrCreateInstance(baseEl);
//    toastPlacement = bootstrap.Toast.getOrCreateInstance(baseEl, {
/*
    toastPlacement = new bootstrap.Toast(toastPlacementExample, {
        autohide: true,
        delay: 3000,
    });
*/
/*----
    toastPlacement = bootstrap.Toast.getOrCreateInstance(newToast);
    toastPlacement.show();
}
---*/

function bootstrapToast(selectedType, title, message, icon, position) {
    // Cria o HTML do toast
/*
    const toastHtml = `
        <div class="bs-toast toast m-2 ${selectedType}" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <span class="toast-icon">${icon || ''}</span>
                <div class="me-auto fw-bolder toast-title">${title || ''}</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body toast-message">${message || ''}</div>
        </div>
    `;
*/
    const toastHtml = `
        <div class="bs-toast toast m-2 ${selectedType}" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <span class="toast-icon">${icon || ''}</span>
                <div class="me-auto fw-bolder toast-title">${title || ''}</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

    // Adiciona ao container
    const toastContainer = document.getElementById('phillis-toast-container');
    toastContainer.insertAdjacentHTML('beforeend', toastHtml);

    // Inicializa e mostra o toast
    const newToast = toastContainer.lastElementChild;
    const toastInstance = new bootstrap.Toast(newToast);
    toastInstance.show();
}

// Parent function
/*
const Toast = {
    primary(title = null, message = null, icon = null, position = null) {
        bootstrapToast("bg-primary", title, message, icon, position);
    },
    secondary(title = null, message = null, icon = null, position = null) {
        bootstrapToast("bg-secondary", title, message, icon, position);
    },
    success(title = null, message = null, icon = null, position = null) {
        bootstrapToast("bg-success", title, message, icon, position);
    },
    danger(title = null, message = null, icon = null, position = null) {
        bootstrapToast("bg-danger", title, message, icon, position);
    },
    warning(title = null, message = null, icon = null, position = null) {
        bootstrapToast("bg-warning", title, message, icon, position);
    },
    info(title = null, message = null, icon = null, position = null) {
        bootstrapToast("bg-info", title, message, icon, position);
    },
    dark(title = null, message = null, icon = null, position = null) {
        bootstrapToast("bg-dark", title, message, icon, position);
    },
};
*/
$(document).ready(function() {
$('#edlis a').click(function(){
//    console.log($(location).attr('href'));
//    window.location.href = $(location).attr('href')+"."+$(this).attr('data-popimage')+"|"+$(this).attr('data-code');
//    var pageurl = $(location).attr('href')+"."+$(this).attr('data-popimage')+"|"+$(this).attr('data-code');
//    console.log($(this));
//    alert ($(location).attr('href')+"."+$(this).attr('data-popimage')+"|"+$(this).attr('data-code'));
    var pushedA = $(this);
    var symbol = (pushedA.hasClass('have')) ? "-" : "+";

//    console.log($(location).attr('href')+"&doid="+$(this).text()+"."+symbol+$(this).attr('data-phl-code'));
//    console.log($(location).attr('href')+"&doid="+$(this).text()+"."+symbol+$(this).attr('data-phl-code'));

    $.ajax({
    //      url: pageurl,
    //      url: $(location).attr('href')+"."+$(this).attr('data-phl-image')+"|"+$(this).attr('data-phl-code'),
      url: $(location).attr('href')+"&doid="+$(this).text()+"."+symbol+$(this).attr('data-phl-code'),
    //////      url: 'testeajax.php',
        dataType: 'json',
        success: function(result){
                let type, icon; // Adicione esta linha
//    console.log(result);  
            if(result.status === "success") {

            pushedA.toggleClass('have');
    //          var code = '';
//    title = symbol!="" ? 'Remover' : 'Adicionar';
//    if( pushedA.hasClass('have')){
//            title = 'Remover';
    //            code = result.val;
//          } else {
//            title = 'Adicionar';
//          }
    //          pushedA.attr('title', title).attr('data-code', code);
//          pushedA.attr('title', title).attr('data-phl-code', result.val);
////          pushedA.attr('data-bs-original-title', (symbol==="-" ? 'Remover da lista' : 'Adicionar á lista'));
//                console.log(lan_add);
                pushedA.attr('data-bs-original-title', (symbol==="-" ? lan_add : lan_remove));
    //          console.log(arguments);
    //          console.log(result.val);
//          alert(result.text);
    // Toggle toast to show --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#show
//    Toast.success('Sukses', 'Pesan berhasil terkirim!', null, TopCenter)
//    Toast.success(result.text, null, '<i class="fa fa-check me-2"></i>', BottomRight)
//        bootstrapToast((symbol=="-"?"bg-warning":"bg-success"),result.text, null, '<i class="fa fa-2x fa-circle-'+(symbol=="-"?"xmark":"check")+' me-2"></i>', BottomRight)
//          console.log(symbol);
//          console.log(symbol=="-");
//          console.log(symbol==="-");
    type = (symbol==="-" ? 'warning' : 'success');
//          console.log(type);
    icon = (symbol==="-" ? 'xmark' : 'check')
//    toast.setText(result.text);
//    toast.show();
//        }, 
        } else if (result.status === "error"){
    //      error: alert("ERRO!!!!"+function(xhr){xhr.responseText})
//    error: function(error) {
//          console.error(result.text);
//    var err = JSON.parse(xhr.responseText);
//    alert(err.Message);
    // Toggle toast to show --- more info: https://getbootstrap.com/docs/5.1/components/toasts/#show
//    toast.setText(err.Message);
//    toast.show();
//        Toast.danger(result.text, null, '<i class="fa fa-triangle-exclamation me-2"></i>', BottomRight)
//bootstrapToast("bg-danger", result.text, null, '<i class="fa fa-2x fa-circle-exclamation me-2"></i>', BottomRight)
            type = "danger";
            icon = "exclamation"
      }
//      console.log(type);
      bootstrapToast('bg-'+type, result.text, null, '<i class="fa fa-2x fa-circle-'+icon+' me-2"></i>', BottomRight)
    },
/*
        error: function(xhr, status, error) {
        console.error("AJAX Error:", status, error);
        console.error("Response:", xhr.responseText);
        bootstrapToast('bg-danger', 'Erro na requisição AJAX', xhr.responseText, '<i class="fa fa-2x fa-circle-exclamation me-2"></i>', BottomRight);
    }
*/
    });
});

//});


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