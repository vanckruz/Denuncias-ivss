<script type="text/javascript" src="../../../public_html/js/jquery-2.1.4.min.js"></script>
<script type='text/javascript'>
  function regresar()
  {
    var pagina = '../denuncias.php';
    location.href=pagina
  }

  function regresar_quejas()
  {
    var pagina = '../quejas.php?ruta_menu';
    location.href=pagina
  }

  function volver()
  {
   history.back();
 }


 $(document).on("ready",function(){
  $("#imprimir_denuncia, #imprimir").on("click",function(){
    window.document.location.href=$("#pdf_denuncia").data("src");
  });
/*
  $("#imprimir").on("click",function(){
    $("#content_pdf").fadeIn();
    $("#pdf_denuncia").attr("src",$("#pdf_denuncia").data('src'));
  });*/

 $(this).on("keydown",function(event){
  if(event.keyCode == 27){
    $("#content_pdf").fadeOut();
  }
});

 $("#cerrar_pdf").on('click',function(){
   $("#content_pdf").fadeOut();
 });

});
</script>
</body>
</html>