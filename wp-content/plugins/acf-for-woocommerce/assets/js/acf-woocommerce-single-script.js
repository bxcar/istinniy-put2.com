(function ($) {
    $.fn.prependOn = function (ev, f) {
        return this.each(function () {
            var elem = this,
                ele = $(this),
                events = $._data(this, 'events'),
                revts = ev.split(/\s+/);

            // cycle through all the requested events, and handle each one separately
            $.each(revts, function (rind, revt) {
                // split the requested event into event and namespace
                var namespaces = revt.split(/\./),
                    type = namespaces.shift(),
                    data = null;

                // if there are no events yet, then assume this is the first. no special logic here
                if (!events) {
                    ele.on(ev, f);
                    // otherwise we need some help
                } else {
                    var eventHandle, special, handlers;
                    // copied from jquery core
                    if (!( eventHandle = elemData.handle )) {
                        eventHandle = elemData.handle = function (e) {
                            // Discard the second event of a jQuery.event.trigger() and
                            // when an event is called after a page has unloaded
                            return typeof jQuery !== "undefined" && jQuery.event.triggered !== e.type ? jQuery.event.dispatch.apply(elem, arguments) : undefined;
                        };
                    }

                    // figure out the special event handler
                    special = jQuery.event.special[type] || {};

                    // again, copied from jquery core
                    // Init the event handler queue if we're the first
                    if (!( handlers = events[type] )) {
                        handlers = events[type] = [];
                        handlers.delegateCount = 0;

                        // Only use addEventListener if the special events handler returns false
                        if (!special.setup || special.setup.call(elem, data, namespaces, eventHandle) === false) {
                            if (elem.addEventListener) {
                                elem.addEventListener(type, eventHandle);
                            }
                        }
                    }
                    console.log('inside', events);

                    // prepend the envent handler
                    handlers.unshift(f);

                    // reintegrate the event list
                    $._data(elem, 'events', events);
                }
            });
        });
    };

    // copy of form submission check from advanced-custom-fields/js/input.js, but specifically for woocommerce forms
    // removed delegation, so that it can run earlier in jquery bubble stack
    // prepending it to the jquery event list, so that it beats out any WooCommerce core js that might already be attached (since load order of js can vary from site to site)
    $(function () {
            // If disabled, bail early on the validation check
        var $form = $('.woocommerce div.product form.cart');
        acf.validation.valid = false;

        $('.woocommerce div.product form.cart').prependOn('submit', function (e) {
            // e.preventDefault(e);
            // Validation form on click place order
            if (!acf.validation.valid) {
                e.preventDefault(e);
                acf.validation.fetch($form);
                e.stopImmediatePropagation(e);

            //update acf.validation.valid according to xhr response - done by acf-inputs.js
            } else {
                if ($form.find('input[type="file"]').length > 0) {

                    if ($form.data('uploading') != 'complete') {
                        e.stopImmediatePropagation(e);
                    }

                    if ($form.data('uploading') != 'runing' && $form.data('uploading') != 'complete') {
                        $form.data('uploading', 'runing');
                        var form = new FormData();
                        $form.find('input[type="file"]').each(function(index, el){
                            var files = $(el).prop('files');
                            if (files.length > 0) {
                                $.each(files, function(index, file){
                                    form.append($(el).attr('name'), file);
                                });
                            }
                        });

                        $.ajax({
                            method: 'post',
                            data: form,
                            async:false,
                            cache: false,
                            contentType: false,
                            processData: false,
                            url: wc_cart_fragments_params.ajax_url + '?action=upload_ajax',
                            success: function(data){
                                if (data.success == true) {
                                    $.each(data.data, function(index, value){
                                        var $input = $('#acf-' + value.key);
                                        var $wrapPreview = $('[name="acf['+value.key+']"]').closest('.acf-file-uploader');
                                        
                                        $input.val('');

                                        $('[type="hidden"][name="acf['+value.key+']"]').val(value.attachment_id);
                                        $wrapPreview.addClass('has-value');
                                        $wrapPreview.find('img').attr('src', value.src);
                                        $wrapPreview.find('[data-name="filename"]').text(value.post_title);
                                        $wrapPreview.find('[data-name="filesize"]').text(value.size);
                                    });
                                }
                            }, 
                            error: function(){
                               
                            },
                            complete: function(){
                                $form.data('uploading', 'complete');
                            }
                        });
                    }
                }

                e.stopImmediatePropagation(e);
            }
            

            
        });
    });
})(jQuery);
