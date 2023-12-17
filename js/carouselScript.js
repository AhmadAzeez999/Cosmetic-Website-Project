$(document).ready(function () 
{
    var currentIndex = 0;
    var slides = $('.slides li');
    var totalSlides = slides.length;
  
    // Create dots based on the number of slides
    for (var i = 0; i < totalSlides; i++) 
    {
      $('.dots-navigation').append('<div class="dot" data-index="' + i + '"></div>');
    }
  
    // Show initial active dot
    $('.dot:first').addClass('active');
  
    // Click event for dots
    $('.dot').on('click', function () 
    {
      var index = $(this).data('index');
      changeSlide(index);
    });
  
    function changeSlide(index) 
    {
      currentIndex = index;
      $('.slides').css('transform', 'translateX(' + -currentIndex * 100 + '%)');
      updateDots();
    }
  
    function updateDots() 
    {
      $('.dot').removeClass('active');
      $('.dot[data-index="' + currentIndex + '"]').addClass('active');
    }
  
    // Autoplay (optional)
    var autoplayInterval = setInterval(function () 
    {
      currentIndex = (currentIndex + 1) % totalSlides;
      changeSlide(currentIndex);
    }, 3000); // Change slide every 3 seconds
  
    // Pause autoplay on hover (optional)
    $('.carousel-container').hover(
      function () 
      {
        clearInterval(autoplayInterval);
      },
      function () 
      {
        autoplayInterval = setInterval(function () 
        {
          currentIndex = (currentIndex + 1) % totalSlides;
          changeSlide(currentIndex);
        }, 3000);
      }
    );
  });
  