jQuery(document).ready(function(){
	jQuery(".sidebar_shop ul.chapters li a").click(function(){
		jQuery(".sidebar_shop ul.chapters li a").removeClass("select");
		jQuery(this).addClass("select");
		jQuery(".chapterstabs").css("display","none");
		jQuery("#"+jQuery(this).attr("href")).fadeIn(300);
		return false;
	});
});