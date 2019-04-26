$("#op").on("click", function (event) {
 
  event.preventDefault();
 
  const href = $(this).attr("href");
  
  window.history.pushState(null, null, href);
  
  //$("nav a").removeClass("active")
  //$(this).addClass("active")
  
  $.ajax({
    url: href,
    success: function (data) {
      $("#fun").fadeOut(250, function () {
        const newPage = $(data).filter("#fun").html();
        
        $("#fun").html(newPage);
        
        $("#fun").slideDown('slow');
      });
    }
  });
  
});


