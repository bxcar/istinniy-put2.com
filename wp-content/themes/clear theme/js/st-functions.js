/*
 * Description: functions for all pages
 * Author: ST
 */

/* global variables */
var _AJAX = 'index.php?ajax=1';
var _DIR = 'wp-content/themes/framing';
var _GET = getGET();

/* attach `active` class to active link */
$(function () {
 $('li > a[href="'+location.origin+location.pathname+'"]').closest('li').addClass('active');
});

/* Input increment and decrement */
$(function () {
  $('body').on('click', 'i.fa-minus-square-o,i.fa-minus', function (e) {
    var targetInput = $(e.target).parent().find('input:first');
    var limit = targetInput.attr('min') || 1;
    targetInput.val(Math.max(limit, targetInput.val() * 1 - 1)).change();
  });
  $('body').on('click', 'i.fa-plus-square-o,i.fa-plus', function (e) {
    var targetInput = $(e.target).parent().find('input:first');
    var limit = targetInput.attr('max') || 999;
    targetInput.val(Math.min(limit, targetInput.val() * 1 + 1)).change();
  });
  $('body').on('mousedown selectstart', 'i.fa', function (){
    return false;
  });
});

/* Menu auto direction */
$(function () {
  $(window).on('resize load', function () {
    $('nav li > ul').each(function (ind, item) {
      var clientRect = item.parentNode.getBoundingClientRect();
      if (clientRect.left > window.innerWidth - clientRect.left - clientRect.width) {
        item.style.left = '';
        item.style.right = '0px';
      } else {
        item.style.left = '0px';
        item.style.right = '';
      }
    });
  });
});

/** Alert
 * @param message -string, example: '<div class="alert alert-danger alert-dismissable fade in"><strong>Error! </strong>Text</div>'
 * @param event - object, jQuery event
 * @param timeout - int, time in ms
 */
function alertWithTimeout(message, event, timeout) {
  timeout = timeout || 1500;
  var elem = $('body').append(message).find('div.alert:last').css({
    'margin': '0px',
    'position': 'absolute',
    'z-index': 1100
  });
  if (!event) {
    elem.css({
      'left': (window.innerWidth - elem.outerWidth()) / 2,
      'top': (window.innerHeight - elem.outerHeight()) / 2
    });
  } else {
    elem.css({
      'left': event.pageX - elem.outerWidth(),
      'top': event.pageY - elem.outerHeight()
    });
  }
  setTimeout(function () {
    elem.alert('close');
  }, timeout);
}

/* Get URI params */
function getGET() {
  var get = {};
  $(location.search.substr(1).split('&')).each(function (id, item) {
    var tmp = item.split('=');
    get[tmp[0]] = tmp[1];
  });
  return get;
}

/* Change blocks size
 * Use class .row-h100 .row-h100-img for row
 * Use class .h100 for block
 */
$(function () {
  $(window).on('resize load', function () {
    $('div.row-h100').each(function (id, item) {
      h100img(item);
    });
    h100page();
  });
});
function h100img(item) {
  var targets = $('div.h100', item);
  var isImg = $(item).hasClass('row-h100-img');
  var height = 0;
  targets.each(function (id2, item2) {
    if(isImg) $('img:first', item2).css('margin-bottom', 0);
    $(item2).css('min-height', 0);
  });
  targets.each(function (id2, item2) {
    height = Math.max(height, item2.offsetHeight);
  });
  targets.each(function (id2, item2) {
    if(isImg) $('img:first', item2).css('margin-bottom', height - item2.offsetHeight);
    $(item2).css('min-height', Math.round(height) + 1);
  });
}
function h100page() {
  var doc = document.documentElement;
  $('body section:last').css('minHeight', '');
  if (doc.clientHeight > document.body.clientHeight) {
    var freeSpace = doc.clientHeight - document.body.clientHeight;
    var minHeight = $('body section:last').prop('clientHeight') + freeSpace;
    $('body section:last').css('minHeight', minHeight);
  }
}

/* Initialise cleditor */
function initialiseEditor(div) {
  div = div || 'body';
  $(div).find('textarea').each(function (id, item) {
    var elem = $(item);
    if (elem.parent().hasClass('cleditorMain')) {
      elem.cleditor()[0].refresh();
    } else {
      elem.cleditor();
      elem.cleditor()[0].change(function () {
        elem.change();
      });
    }
    elem.cleditor()[0].disable(elem.prop('disabled'));
  });
}

/* Initialise AjaxUpload */
function initialiseUploader(config) {
  return new AjaxUpload($(config.button), {
    action: config.action,
    name: 'uploadfile',
    data: {
      'dir': config.dir || '',
      'method': config.method,
      'subdir': config.subdir
    },
    onSubmit: function (file, ext) {
      if (!file || !ext || (config.regrxp && !config.regrxp.test(ext))) {
        alertWithTimeout('<div class="alert alert-danger alert-dismissable fade in">\
                <strong>Error! </strong>Incorrect file name</div>');
        return false;
      }
    },
    onComplete: function (file, response) {
      if (response.match(/error/i)) {
        alertWithTimeout('<div class="alert alert-danger alert-dismissable fade in">\
                <strong>Error! </strong>' + response.split('|') + '</div>');
        return false;
      }
      if (config.afterF) {
        config.afterA = config.afterA || {};
        config.afterA['alt'] = file;
        config.afterA['src'] = response;
        config.afterF.call(null, config.afterA);
      }
    }
  });
}

/**
 * Validate inputs
 * @param fields - object, example {'#basket input[name="email"]': [/^\w{1,30}@\w{1,12}\.\w{1,6}$/, 'Invalid E-mail']}
 * @param options - object, default {'delimeter': '<br>','invalidClass': 'invalid','validClass': ''}
 * @return - object {'errorText': string, 'isValid': bool, 'request': object}
 */
function validate(fields, options) {
  options = $.extend({
    'delimeter': '<br>',
    'invalidClass': 'invalid',
    'validClass': ''
  }, options || {});
  var errorText = '', isValid = true, request = {};
  for (var i in fields) {
    var input = jQuery(i);
    if (input.length > 0 && fields[i][0].test(input.val())) {
      input.removeClass(options.invalidClass).addClass(options.validClass);
      request[input.prop('name')] = input.val();
    } else {
      input.removeClass(options.validClass).addClass(options.invalidClass);
      errorText += fields[i][1] + options.delimeter;
      isValid = false;
    }
  }
  return {'errorText': errorText, 'isValid': isValid, 'request': request};
}