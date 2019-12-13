/*   
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 1.9.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v1.9/admin/
    ----------------------------
        APPS CONTENT TABLE
    ----------------------------
    
    <!-- ======== GLOBAL SCRIPT SETTING ======== -->
    01. Handle Scrollbar
    
    02. Handle Sidebar - Menu
    03. Handle Sidebar - Mobile View Toggle
    04. Handle Sidebar - Minify / Expand
    05. Handle Page Load - Fade in
    06. Handle Panel - Remove / Reload / Collapse / Expand
    07. Handle Panel - Draggable
    08. Handle Tooltip & Popover Activation
    09. Handle Scroll to Top Button Activation
    
    <!-- ======== Added in V1.2 ======== -->
    10. Handle Theme & Page Structure Configuration
    11. Handle Theme Panel Expand
    12. Handle After Page Load Add Class Function - added in V1.2
    
    <!-- ======== Added in V1.5 ======== -->
    13. Handle Save Panel Position Function - added in V1.5
    14. Handle Draggable Panel Local Storage Function - added in V1.5
    15. Handle Reset Local Storage - added in V1.5
    
    <!-- ======== Added in V1.6 ======== -->
    16. Handle IE Full Height Page Compatibility - added in V1.6
    17. Handle Unlimited Nav Tabs - added in V1.6
    
    <!-- ======== Added in V1.7 ======== -->
    18. Handle Mobile Sidebar Scrolling Feature - added in V1.7
    
    <!-- ======== Added in V1.9 ======== -->
    19. Handle Top Menu - Unlimited Top Menu Render - added in V1.9
    20. Handle Top Menu - Sub Menu Toggle - added in V1.9
    21. Handle Top Menu - Mobile Sub Menu Toggle - added in V1.9
    22. Handle Top Menu - Mobile Top Menu Toggle - added in V1.9
    23. Handle Clear Sidebar Selection & Hide Mobile Menu - added in V1.9
	
    <!-- ======== APPLICATION SETTING ======== -->
    Application Controller
*/



/* 01. Handle Scrollbar
------------------------------------------------ */
/*var handleSlimScroll = function() {
    "use strict";
    $('[data-scrollbar=true]').each( function() {
        generateSlimScroll($(this));
    });
};
var generateSlimScroll = function(element) {
    if ($(element).attr('data-init')) {
        return;
    }
    var dataHeight = $(element).attr('data-height');
        dataHeight = (!dataHeight) ? $(element).height() : dataHeight;
    
    var scrollBarOption = {
        height: dataHeight, 
        alwaysVisible: true
    };
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $(element).css('height', dataHeight);
        $(element).css('overflow-x','scroll');
    } else {
        $(element).slimScroll(scrollBarOption);
    }
    $(element).attr('data-init', true);
};
*/

/* 02. Handle Sidebar - Menu
------------------------------------------------ */
var handleSidebarMenu = function() {
    "use strict";
    $('.sidebar .nav > .has-sub > a').click(function() {
        var target = $(this).next('.sub-menu');
        var otherMenu = '.sidebar .nav > li.has-sub > .sub-menu';
    
        if ($('.page-sidebar-minified').length === 0) {
            $(otherMenu).not(target).slideUp(250, function() {
                $(this).closest('li').removeClass('expand');
            });
            $(target).slideToggle(250, function() {
                var targetLi = $(this).closest('li');
                if ($(targetLi).hasClass('expand')) {
                    $(targetLi).removeClass('expand');
                } else {
                    $(targetLi).addClass('expand');
                }
            });
        }
    });
    $('.sidebar .nav > .has-sub .sub-menu li.has-sub > a').click(function() {
        if ($('.page-sidebar-minified').length === 0) {
            var target = $(this).next('.sub-menu');
            $(target).slideToggle(250);
        }
    });
};


/* 03. Handle Sidebar - Mobile View Toggle
------------------------------------------------ */
var handleMobileSidebarToggle = function() {
    var sidebarProgress = false;
    $('.sidebar').bind('click touchstart', function(e) {
        if ($(e.target).closest('.sidebar').length !== 0) {
            sidebarProgress = true;
        } else {
            sidebarProgress = false;
            e.stopPropagation();
        }
    });
    
    $(document).bind('click touchstart', function(e) {
        if ($(e.target).closest('.sidebar').length === 0) {
            sidebarProgress = false;
        }
        if (!e.isPropagationStopped() && sidebarProgress !== true) {
            if ($('#page-container').hasClass('page-sidebar-toggled')) {
                sidebarProgress = true;
                $('#page-container').removeClass('page-sidebar-toggled');
            }
            if ($(window).width() <= 767) {
                if ($('#page-container').hasClass('page-right-sidebar-toggled')) {
                    sidebarProgress = true;
                    $('#page-container').removeClass('page-right-sidebar-toggled');
                }
            }
        }
    });
    
    $('[data-click=right-sidebar-toggled]').click(function(e) {
        e.stopPropagation();
        var targetContainer = '#page-container';
        var targetClass = 'page-right-sidebar-collapsed';
            targetClass = ($(window).width() < 979) ? 'page-right-sidebar-toggled' : targetClass;
        if ($(targetContainer).hasClass(targetClass)) {
            $(targetContainer).removeClass(targetClass);
        } else if (sidebarProgress !== true) {
            $(targetContainer).addClass(targetClass);
        } else {
            sidebarProgress = false;
        }
        if ($(window).width() < 480) {
            $('#page-container').removeClass('page-sidebar-toggled');
        }
    });
    
    $('[data-click=sidebar-toggled]').click(function(e) {
        e.stopPropagation();
        var sidebarClass = 'page-sidebar-toggled';
        var targetContainer = '#page-container';

        if ($(targetContainer).hasClass(sidebarClass)) {
            $(targetContainer).removeClass(sidebarClass);
        } else if (sidebarProgress !== true) {
            $(targetContainer).addClass(sidebarClass);
        } else {
            sidebarProgress = false;
        }
        if ($(window).width() < 480) {
            $('#page-container').removeClass('page-right-sidebar-toggled');
        }
    });
};



/* 09. Handle Scroll to Top Button Activation
------------------------------------------------ */
var handleScrollToTopButton = function() {
    "use strict";
    $(document).scroll( function() {
        var totalScroll = $(document).scrollTop();

        if (totalScroll >= 200) {
            $('[data-click=scroll-top]').addClass('in');
        } else {
            $('[data-click=scroll-top]').removeClass('in');
        }
    });

    $('[data-click=scroll-top]').click(function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $("body").offset().top
        }, 500);
    });
}

/* 16. Handle IE Full Height Page Compatibility - added in V1.6
------------------------------------------------ */
var handleIEFullHeightContent = function() {
    var userAgent = window.navigator.userAgent;
    var msie = userAgent.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        $('.vertical-box-row [data-scrollbar="true"][data-height="100%"]').each(function() {
            var targetRow = $(this).closest('.vertical-box-row');
            var targetHeight = $(targetRow).height();
            $(targetRow).find('.vertical-box-cell').height(targetHeight);
        });
    }
};

/* 18. Handle Mobile Sidebar Scrolling Feature - added in V1.7
------------------------------------------------ */
var handleMobileSidebar = function() {
    "use strict";
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        if ($('#page-container').hasClass('page-sidebar-minified')) {
            $('#sidebar [data-scrollbar="true"]').css('overflow', 'visible');
            $('.page-sidebar-minified #sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
            $('.page-sidebar-minified #sidebar [data-scrollbar="true"]').removeAttr('style');
            $('.page-sidebar-minified #sidebar [data-scrollbar=true]').trigger('mouseover');
        }
    }

    var oriTouch = 0;
    $('.page-sidebar-minified .sidebar [data-scrollbar=true] a').bind('touchstart', function(e) {
        var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
        var touchVertical = touch.pageY;
        oriTouch = touchVertical - parseInt($(this).closest('[data-scrollbar=true]').css('margin-top'));
    });

    $('.page-sidebar-minified .sidebar [data-scrollbar=true] a').bind('touchmove',function(e){
        e.preventDefault();
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
            var touchVertical = touch.pageY;
            var elementTop = touchVertical - oriTouch;
            
            $(this).closest('[data-scrollbar=true]').css('margin-top', elementTop + 'px');
        }
    });

    $('.page-sidebar-minified .sidebar [data-scrollbar=true] a').bind('touchend', function(e) {
        var targetScrollBar = $(this).closest('[data-scrollbar=true]');
        var windowHeight = $(window).height();
        var sidebarTopPosition = parseInt($('#sidebar').css('padding-top'));
        var sidebarContainerHeight = $('#sidebar').height();
        oriTouch = $(targetScrollBar).css('margin-top');

        var sidebarHeight = sidebarTopPosition;
        $('.sidebar').not('.sidebar-right').find('.nav').each(function() {
            sidebarHeight += $(this).height();
        });
        var finalHeight = -parseInt(oriTouch) + $('.sidebar').height();
        if (finalHeight >= sidebarHeight && windowHeight <= sidebarHeight && sidebarContainerHeight <= sidebarHeight) {
            var finalMargin = windowHeight - sidebarHeight - 20;
            $(targetScrollBar).animate({marginTop: finalMargin + 'px'});
        } else if (parseInt(oriTouch) >= 0 || sidebarContainerHeight >= sidebarHeight) {
            $(targetScrollBar).animate({marginTop: '0px'});
        } else {
            finalMargin = oriTouch;
            $(targetScrollBar).animate({marginTop: finalMargin + 'px'});
        }
    });
};



/* 23. Handle Clear Sidebar Selection & Hide Mobile Menu - added in V1.9
------------------------------------------------ */
var handleClearSidebarSelection = function() {
    $('.sidebar .nav > li, .sidebar .nav .sub-menu').removeClass('expand').removeAttr('style');
};
var handleClearSidebarMobileSelection = function() {
    $('#page-container').removeClass('page-sidebar-toggled');
};

/** Review This Later */
/*var handleDatepicker = function() {
    $("input[data-type=datepicker-autoClose]").datepicker({
        todayHighlight: true,
        autoclose: true
    });
};*/

var handleSelectall = function() {
    $("#selectall").change(function () {
        $(".checkbox1").prop('checked', $(this).prop("checked"));
    });
};


/* Application Controller
------------------------------------------------ */
var App = function () {
	"use strict";
	return {
		//main function
		init: function () {
		    this.initSidebar();
		    this.initComponent();
            //handleDatepicker();
            handleSelectall();
		},
		initSidebar: function() {
			handleSidebarMenu();
			handleMobileSidebarToggle();
			handleMobileSidebar();
		},
		initComponent: function() {
			handleIEFullHeightContent();
			//handleSlimScroll();
			handleScrollToTopButton();
		},
		scrollTop: function() {
            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 0);
		}
  };
}();

var ajaxLink = function(link) {
    // Will work only if in the onclick there is no error!

    var href,target;
    href = link.href;
    target = link.target;
    if (!target) {
        target = 'content';
    }
    /*if ( typeof link == 'string' ) {
        href = link;
        target = 'body';
        if ( href == 'Side.php' ) target = 'menu';
        else if ( href == 'Side.php?sidefunc=update' ) target = 'menu-top';
        else if ( href.indexOf('Bottom.php') === 0 ) target = 'footer';
    } else {

    }

    if (href.indexOf('#') != -1 || target == '_blank' || target == '_top') // Internal/external/top anchor.
        return true;

    if (!target) {
        if (href.indexOf('Modules.php') != -1) target = 'body';
        else return true;
    }*/
    if (!link.href) return true;
    if (href.indexOf('logout') != -1) return true;
    if (href.indexOf('javascript:') != -1) return true;
    if (link.hash) return true;
    $.ajax(href, ajaxOptions(target, href, false));
    return false;
};

var ajaxOptions = function(target, url, form) {
    return {
        dataType: (target === 'inline') ? 'json' :'html',
        beforeSend: function (data) {
            // AJAX error hide.
            $('.ajax-error').hide();

            $('.loading').css('visibility', 'visible');
        },
        success: function (data, s, xhr) {
            // See PHP RedirectURL().
            if (target === "in-line") {
                // display the message in-line in the system
                alert(xhr.responseText);
            } else {
                var redirectUrl = xhr.getResponseHeader("X-Redirect-Url");
                if (redirectUrl) {
                    url = redirectUrl;
                }
                else if (form && form.method == 'get') {
                    var getStr = [];

                    // Fix advanced search forms (student & user) URL > 2000 chars.
                    if (form.name == 'search') {
                        var formArray = $(form).formToArray();

                        $(formArray).each(function(i,el){
                            // Only add not empty values.
                            if (el.value !== '')
                                getStr.push(el.name + '=' + el.value);
                        });

                        getStr = getStr.join('&');
                    } else {
                        getStr = $(form).formSerialize();
                    }

                    url += (url.indexOf('?') != -1 ? '&' : '?') + getStr;
                }
                ajaxSuccess(data, target, url);
            }
        },
        error: function(xhr, status, error){
            ajaxError(xhr, status, error, url, target, form);
        },
        complete: function (xhr, status) {
            $('.loading').css('visibility', 'hidden');

            //hideHelp();
        }
    };
}

var ajaxSuccess = function(data, target, url) {
    // Change URL after AJAX.
    //http://stackoverflow.com/questions/5525890/how-to-change-url-after-an-ajax-request#5527095
    $('#' + target).html(data);

    var doc = document;

    if (history.pushState && target == 'content' && doc.URL != url) history.pushState(null, doc.title, url);

    ajaxPrepare('#' + target);
};

var ajaxError = function(xhr, status, error, url, target, form) {
    var code = xhr.status,
        errorMsg = 'AJAX error. ' + code + ' ';
    if (code === 403) {
        // access denied
        // redirect to login page
        window.location = window.location.origin + '/login';
    }

    if ( typeof ajaxError.num === 'undefined' ) {
        ajaxError.num = 0;
    }

    ajaxError.num++;

    if (code === 0) {
        errorMsg += 'Check your Network';

        if ( url && ajaxError.num === 1 ) {
            window.setTimeout(function () {
                // Retry once on AJAX error 0, maybe a micro Wifi interruption.
                $.ajax(url, ajaxOptions(target, url, form));
            }, 1000);
            return;
        }
    } else if (status == 'parsererror') {
        errorMsg += 'JSON parse failed';
    } else if (status == 'timeout') {
        errorMsg += 'Request Timeout';
    } else if (status == 'abort') {
        errorMsg += 'Request Aborted';
    } else {
        errorMsg += error;
    }

    errorMsg += '. ' + url;

    ajaxError.num = 0;

    // AJAX error popup.
    $('.ajax-error').html(errorMsg).fadeIn();
}

var ajaxPrepare = function(target) {
    /*if (scrollTop == 'Y' && target == '#content')*/
    //body.scrollIntoView();

    $(target + ' form').each(function () {
        ajaxPostForm(this, false);
    });
};

var ajaxPostForm = function(form, submit) {
    var target = form.target || 'content';

    var options = ajaxOptions(target, form.action, form);
    if (submit) $(form).ajaxSubmit(options);
    else $(form).ajaxForm(options);
    return false;
};

window.onload = function() {
    // Cache <script> resources loaded in AJAX.
    $.ajaxPrefilter('script', function(options) { options.cache = true; });

    $(document).on('click', 'a', function (e) {
        return $(this).css('pointer-events') == 'none' ? e.preventDefault() : ajaxLink(this);
    });

    ajaxPrepare('body');
    // Load body after browser history.
    if (history.pushState) window.setTimeout(function () {
        window.addEventListener('popstate', function (e) {
            ajaxLink(document.URL);
        }, false);
    }, 1);
};