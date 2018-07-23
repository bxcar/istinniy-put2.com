jQuery(document).ready(function($) {

	$('#slider-text').slick({
		dots: true,
		arrows: true,
		speed: 300,
	 	slidesToShow: 1,
	 	slidesToScroll: 1,
	 	autoplay: false
	});

	$('#slider').slick({
		dots: true,
 		speed: 300,
  	slidesToShow: 1,
  	slidesToScroll: 1
	})
	$('#slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
  	//$('#slider-text').slick('slickNext');
  	$('#slider-text').slick('slickGoTo', nextSlide);
	});

	$('.search-link').click(function( event ){
		 event.preventDefault();
	})
           
      


});