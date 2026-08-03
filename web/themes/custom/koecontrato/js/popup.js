if(typeof jQuery !== 'undefined' && jQuery('#avisoejecutivo').length){
  (function ($) {
    // si no hay llave con nombre `mostraModal`
    // crear la llave y mostrar el modal
    if(!window.sessionStorage.getItem("mostrarModal")){
          
      window.sessionStorage.setItem("mostrarModal","no");
              
      $('#avisoejecutivo').modal('show');     
     
     }
                  
  })(jQuery);
}
