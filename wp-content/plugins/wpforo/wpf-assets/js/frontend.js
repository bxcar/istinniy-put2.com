jQuery.fn.visible = function() {
    return this.css('visibility', 'visible');
};

jQuery.fn.invisible = function() {
    return this.css('visibility', 'hidden');
};

jQuery.fn.visibilityToggle = function() {
    return this.css('visibility', function(i, visibility) {
        return (visibility === 'visible') ? 'hidden' : 'visible';
    });
};

function wpforo_notice_clear() {
    var msg_box = jQuery("#wpf-msg-box");
    msg_box.hide();
    msg_box.empty();
}

function wpforo_notice_show(notice){
	if( notice === undefined || notice === '' ) return;

    var n = notice.search(/<p(?:\s[^<>]*?)?>/i);
    if( n < 0 ) notice = '<p>' + wpforo_phrase(notice) + '</p>';

	var msg_box = jQuery("#wpf-msg-box");
	msg_box.hide();
	msg_box.html(notice);
	msg_box.show(150).delay(1000);
	setTimeout(function(){ jQuery("#wpf-msg-box > p.error").remove(); }, 6500);
	setTimeout(function(){ jQuery("#wpf-msg-box > p.success").remove(); }, 2500);
}

function wpforo_phrase(phrase_key){
	if( typeof wpforo_phrases !== 'undefined' ){
        phrase_key = phrase_key.toLowerCase();
        if( wpforo_phrases[phrase_key] !== undefined ) phrase_key = wpforo_phrases[phrase_key];
    }
	return phrase_key;
}

jQuery(document).ready(function($){
	var wpforo_wrap = $('#wpforo-wrap');

	var _m = $("#m_");
	if( _m !== undefined && _m.length ){
        $('html, body').scrollTop(_m.offset().top - 25);
	}

	$(document).on('click', '#add_wpftopic:not(.not_reg_user)', function(){
        var stat = $( ".wpf-topic-create" ).is( ":hidden" );
        $( ".wpf-topic-create" ).slideToggle( "slow" );
        var add_wpftopic = '<i class="fas fa-times" aria-hidden="true"></i>';
        if( !stat ) add_wpftopic = wpforo_phrase('add topic');
        $( "#add_wpftopic" ).html(add_wpftopic);
        $('html, body').animate({ scrollTop: ($(".wpforo-main").offset().top - 25) }, 415);
	});
	
	$(document).on('click','.not_reg_user', function(){
		$("#wpf-msg-box").hide();
		$('#wpforo-load').visible();
		$('#wpf-msg-box').show(150).delay(1000);
		$('#wpforo-load').invisible();
	});

	$(document).on('click','#wpf-msg-box', function(){
		$(this).hide();
	});

	/* Home page loyouts toipcs toglle */
	$( ".topictoggle" ).click(function(){
		var wpfload = $('#wpforo-load');
        wpfload.visible();
		
		var id = $(this).attr( 'id' );
		
		id = id.replace( "img-arrow-", "" );
		$( ".wpforo-last-topics-" + id ).slideToggle( "slow" );
		if( $(this).hasClass('topictoggle') && $(this).hasClass('fa-chevron-down') ){
            $( '#img-arrow-' + id ).removeClass('fa-chevron-down').addClass('fa-chevron-up');
        }else{
            $( '#img-arrow-' + id ).removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }
		
		id = id.replace( "button-arrow-", "" );
		$( ".wpforo-last-posts-" + id ).slideToggle( "slow" );
		if( $(this).hasClass('topictoggle') && $(this).hasClass('wpfcl-a') && $(this).hasClass('fa-chevron-down') ){
			$( '#button-arrow-' + id ).removeClass('fa-chevron-down').addClass('fa-chevron-up');
		}else{
			$( '#button-arrow-' + id ).removeClass('fa-chevron-up').addClass('fa-chevron-down');
		}

        wpfload.invisible();
	});
	
	/* Home page loyouts toipcs toglle */
	$( ".wpforo-membertoggle" ).click(function(){
		var id = $(this).attr( 'id' );
		id = id.replace( "wpforo-memberinfo-toggle-", "" );
		$( "#wpforo-memberinfo-" + id ).slideToggle( "slow" );
		if( $(this).find( "i" ).hasClass('fa-caret-down') ){
			$(this).find( "i" ).removeClass('fa-caret-down').addClass('fa-caret-up');
		}else{
			$(this).find( "i" ).removeClass('fa-caret-up').addClass('fa-caret-down');
		}
	});
	
	
//	Reply
	$( ".wpforo-reply" ).click(function(){
		
		$("#wpf-msg-box").hide();  $('#wpforo-load').visible();
		$("#wpf-reply-form-title").html( wpforo_phrase('Leave a reply') );
		
		var parentpostid = $(this).attr('id');
		parentpostid = parentpostid.replace("parentpostid", "");
		$("#wpf_postparentid").val( parentpostid );
		
		tinyMCE.activeEditor.setContent('');
		$( ".wpf-topic-sbs" ).show();
		$( "#wpf-topic-sbs" ).prop("disabled", false);
		
		$( "#wpf_formaction" ).attr('name', 'post[action]');
		$( "#wpf_formbutton" ).attr('name', 'post[save]');
		$( "#wpf_formtopicid" ).attr('name', 'post[topicid]');
		$( "#wpf_title" ).attr('name', 'post[title]');
		$( "#wpf_formaction" ).val( 'add' );
		$( "#wpf_formpostid" ).val( '' );
		$( "#wpf_formbutton" ).val( wpforo_phrase('Save') );
		$( "#wpf_title").val( wpforo_phrase('re') + ": " + $("#wpf_title").attr('placeholder').replace( wpforo_phrase('re') + ": ", ""));
		
		$('html, body').animate({ scrollTop: $("#wpf-form-wrapper").offset().top }, 500);
		
		tinymce.execCommand('mceFocus',false,'postbody');
		tinyMCE.activeEditor.selection.select(tinyMCE.activeEditor.getBody(), true);
		tinyMCE.activeEditor.selection.collapse(false);
		
		$('#wpforo-load').invisible();
		
	});
	
	//Answer
	$( ".wpforo-answer" ).click(function(){
		
		$("#wpf-msg-box").hide();  $('#wpforo-load').visible();
		$("#wpf-reply-form-title").html( wpforo_phrase('Your answer') );
		
		tinyMCE.activeEditor.setContent('');
		$( "#wpf_formaction" ).attr('name', 'post[action]');
		$( "#wpf_formbutton" ).attr('name', 'post[save]');
		$( "#wpf_formtopicid" ).attr('name', 'post[topicid]');
		$( "#wpf_title" ).attr('name', 'post[title]');
		$( "#wpf_formaction" ).val( 'add' );
		$( "#wpf_formpostid" ).val( '' );
		$( "#wpf_formbutton" ).val( wpforo_phrase('Save') );
		$( "#wpf_title").val( wpforo_phrase('Answer to') + ": " + $("#wpf_title").attr('placeholder').replace( wpforo_phrase('re') + ": ", "").replace( wpforo_phrase('Answer to') + ": ", ""));
		$('html, body').animate({ scrollTop: $("#wpf-form-wrapper").offset().top }, 500);
		
		tinymce.execCommand('mceFocus',false,'postbody');
		tinyMCE.activeEditor.selection.select(tinyMCE.activeEditor.getBody(), true);
		tinyMCE.activeEditor.selection.collapse(false);
		
		$('#wpforo-load').invisible();
		
	});
	
	//Comment
	$( ".wpforo-childreply" ).click(function(){
		$("#wpf-msg-box").hide();  $('#wpforo-load').visible();
		$("#wpf-reply-form-title").html( wpforo_phrase('Leave a comment') );
		
		var parentpostid = $(this).attr('id');
		var postid = parentpostid.replace("parentpostid", "");
		$("#wpf_postparentid").val( postid );
		
		tinyMCE.activeEditor.setContent('');
		$( ".wpf-topic-sbs" ).show();
		$( "#wpf-topic-sbs" ).prop("disabled", false);
		
		$( "#wpf_formaction" ).attr('name', 'post[action]');
		$( "#wpf_formbutton" ).attr('name', 'post[save]');
		$( "#wpf_formtopicid" ).attr('name', 'post[topicid]');
		$( "#wpf_title" ).attr('name', 'post[title]');
		$( "#wpf_formaction" ).val( 'add' );
		$( "#wpf_formpostid" ).val( '' );
		$( "#wpf_formbutton" ).val( wpforo_phrase('Save') );
		$( "#wpf_title").val( wpforo_phrase('re') + ": " + $("#wpf_title").attr('placeholder').replace( wpforo_phrase('re') + ": ", "").replace( wpforo_phrase('Answer to') + ": ", "") );
		$('html, body').animate({ scrollTop: $("#wpf-form-wrapper").offset().top }, 800);
		
		tinymce.execCommand('mceFocus',false,'postbody');
		tinyMCE.activeEditor.selection.select(tinyMCE.activeEditor.getBody(), true);
		tinyMCE.activeEditor.selection.collapse(false);
		
		$('#wpforo-load').invisible();
	});
	
	//mobile menu responsive toggle
	$("#wpforo-menu .wpf-res-menu").click(function(){
		$("#wpforo-menu .wpf-menu").toggle();
	});
	var wpfwin = $(window).width();
	var wpfwrap = wpforo_wrap.width();
	if( wpfwin >= 602 && wpfwrap < 700 ){
		$("#wpforo-menu .wpf-search-field").focus(function(){
			$("#wpforo-menu .wpf-menu li").hide();
            wpforo_wrap.find("#wpforo-menu .wpf-res-menu").show();
			$("#wpforo-menu .wpf-search-field").css('transition-duration', '0s');
		});
		$("#wpforo-menu .wpf-search-field").blur(function(){
            wpforo_wrap.find("#wpforo-menu .wpf-res-menu").hide();
			$("#wpforo-menu .wpf-menu li").show();
			$("#wpforo-menu .wpf-search-field").css('transition-duration', '0.4s');
		});
	}
	
	// password show/hide switcher */
    $(document).delegate('.wpf-show-password', 'click', function () {
        var btn = $(this);
        var parent = btn.parents('.wpf-field-wrap');
        var input = $(':input', parent);
        if (input.attr('type') == 'password') {
            input.attr('type', 'text');
            btn.removeClass('fa-eye-slash');
            btn.addClass('fa-eye');
        } else {
            input.attr('type', 'password');
            btn.removeClass('fa-eye');
            btn.addClass('fa-eye-slash');
        }
    });
	
	//Turn off on dev mode
	//$(window).bind('resize', function(){ if (window.RT) { clearTimeout(window.RT); } window.RT = setTimeout(function(){ this.location.reload(false);}, 100); });

    wpforo_wrap.on("change", "#wpforo_split_form #wpf_split_create_new", function () {
		var checked = $("#wpf_split_create_new").is(":checked"),
		target_url 	= $("#wpf_split_target_url"),
		append 		= $("#wpf_split_append"),
		new_title 	= $("#wpf_split_new_title"),
		forumid 	= $("#wpf_split_forumid");
		if( checked ){
            target_url.children("input").prop("disabled", true);
            target_url.hide();
            append.children("input").prop("disabled", true);
            append.hide();
            new_title.children("input").prop("disabled", false);
            new_title.show();
            forumid.children("select").prop("disabled", false);
            forumid.show();
		}else{
            target_url.children("input").prop("disabled", false);
            target_url.show();
            append.children("input").prop("disabled", false);
            append.show();
            new_title.children("input").prop("disabled", true);
            new_title.hide();
            forumid.children("select").prop("disabled", true);
            forumid.hide();
		}
    });

});
