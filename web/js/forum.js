$(function() {
  
  // On cache tous les forum de chaque categorie
  $('.forum-list .panel-body').hide();
  
  // Affichage des forums au clic sur la categorie
  $('.forum-list').children('.panel-heading').each(function() {
    $(this).click(function() {

      $(this).parent('.forum-list').children('.panel-body').toggle();
      
      $(this).children('span.pull-right').each(function() {
        if ($(this).children('i').hasClass('fa-compress')) {
          $(this).children('i').removeClass('fa-compress');
          $(this).children('i').addClass('fa-expand');
        } else {
          $(this).children('i').removeClass('fa-expand');
          $(this).children('i').addClass('fa-compress');
        }
      });
      
    });
  });
  
});