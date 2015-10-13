$(function(){
 $('.block').hide();
 $('.accordion h2').on('click',function(){
    if($(this).next().is(':visible')){
     $(this).next().slideUp('slow');
    }
    if($(this).next().is(':hidden')){
     $('.accordion h2').next().slideUp();
     $(this).next().slideDown('slow');
   }
  });
 });