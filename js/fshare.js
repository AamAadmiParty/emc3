	jQuery(document).ready(function(){
	jQuery('#sharestart').prepend('<div id="floating-bar"></div>');
	jQuery('#sharestart').prepend('<div id="upper-limit-element"></div> ');		
	jQuery('.footer').prepend('<div id="lower-limit-element"></div>');				

  $('#floating-bar').fshare({ theme: 'default', upperLimitElementId: 'upper-limit-element', lowerLimitElementId: 'lower-limit-element' });
  
	});
	 

(function ($) {
    $.fn.extend({
        fshare: function (options) {
            var settings = $.extend({
                speed: 500,
                theme: 'default',
                upperLimitElementId: '',
                lowerLimitElementId: '',
                facebook: true,
                twitter: true,
                stumbleupon: false,
                linkedin: true,
                googleplus: true,
                yoursitetitle: 'Citizen Call Campaign',
                yoursiteurl: 'http://usa.aamaadmiparty.org/missionc3/',
                yoursitename: 'Mission C-Cube',
                desc: 'Mission C-Cube is a Mission taken up by citizens of India to call Delhi Voters and request their valuable vote for Aam Aadmi Party which in turn is a vote for the start of Clean Politics.',
                countReader: 'count-reader.php'
            }, options);
            return this.each(function () {
                if (settings.countReader == '') {
                    alert('countReader is required!');
                    return;
                }
                if (settings.upperLimitElementId == '') {
                    alert('Upper limit not defined');
                    return;
                }
                if (settings.lowerLimitElementId == '') {
                    alert('Lower limit not defined');
                    return;
                }
                var mediaSource = ["http://www.facebook.com/share.php?u={ADDRESS}",
                                   "http://twitter.com/home?status={TITLE}{ADDRESS}",
                                   "https://plusone.google.com/_/+1/confirm?hl=en&url={ADDRESS}",
                                   "http://www.linkedin.com/shareArticle?mini=true&url={ADDRESS}&title={TITLE}&summary={SDESCRIPTION}&source={SITENAME}",
                                   "http://www.stumbleupon.com/submit?url={ADDRESS}&amp;title={TITLE}"];

                //var floatingBox = { top: $('#' + settings.upperLimitElementId).offset().top + $('#' + settings.upperLimitElementId).outerHeight(), bottom: $('#' + settings.lowerLimitElementId).offset().top };
                var floatingBox = { top: $('#' + settings.upperLimitElementId).offset().top , bottom: $('#' + settings.lowerLimitElementId).offset().top };
                var widget = $(this).css({ top: floatingBox.top });
				
				widget.append('<div id="fshare-close"></div><div id="fshare-collapsed">Share</div>');
				widget.append('<div id="fshare-expanded"></div>');
               
				var themeClass = 'fshare-' + settings.theme;
				widget.addClass(themeClass);
				widgetContainer = widget.find('#fshare-expanded');
				
                if (settings.facebook) {
                    var facebook = getSocialButton('facebook');
                    if (facebook != null) {
                        widgetContainer.append(facebook);
                    }
                }
                if (settings.twitter) {
                    var twitter = getSocialButton('twitter');
                    if (twitter != null) {
                        widgetContainer.append(twitter);
                    }
                }
                if (settings.googleplus) {
                    var gplus = getSocialButton('googleplus');
                    if (gplus != null) {
                        widgetContainer.append(gplus);
                    }
                }
                if (settings.linkedin) {
                    var linkedin = getSocialButton('linkedin');
                    if (linkedin != null) {
                        widgetContainer.append(linkedin);
                    }
                }
				//if its compact theme show minimal display at the time of login
				if(settings.theme == 'compact')				{
					var h = 0;
					var padding = parseInt( widget.find('#fshare-expanded').css('padding-left'));
					
					widget.find('#fshare-collapsed').mouseenter(function(){
						widget.find('#fshare-close').css('display','inline-block');						
						widget.find('#fshare-expanded').css('display','block').animate({height:h,padding:padding},500,function(){
							$(this).find('.fshare-box').css('display','block');
						});
					});
					h = widget.find('#fshare-expanded').outerHeight();
					widget.find('#fshare-expanded').animate({height:0,padding:0},500,function(){
							$(this).find('.fshare-box').css('display','none');
							$(this).css('display','none');
					});
					widget.find('#fshare-close').css('display','none').click(function(){
						widget.find('#fshare-close').css('display','none');
						widget.find('#fshare-expanded').animate({height:0,padding:0},500,function(){
							$(this).find('.fshare-box').css('display','none');
							$(this).css('display','none');
						});
					});
					
				}
                $(window).scroll(scrollWidget).resize(scrollWidget);

                function scrollWidget() {
                    var scrollTop = $(window).scrollTop();
                    var top = scrollTop > floatingBox.top ? scrollTop : floatingBox.top;
                    var bottom = floatingBox.bottom - widget.outerHeight();
                    if (top < bottom) {
                        widget.stop(true, false).animate({ top: top }, settings.speed);
                    }
                    else
                        widget.stop(true, false).animate({ top: bottom }, settings.speed);
                }

                function getCount(media) {
                    var count = '0';
                    url = location.href;
                    $.ajax({
                        url: settings.countReader,
                        type: "POST",
                        data: { 'type': media, 'url': url },
                        cache: false,
                        async: false,
                        success: function (result) {
                            count = result;
                        },
                        error: function (msg) {
                        }
                    });

                    return count;
                }

                function getSocialButton(type) {
                    var btn = null;
                    switch (type) {
                        case 'facebook':
                            if (settings.theme == 'large') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 0) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button fb').append('<span class="social-count">' + getCount('facebook') + '</span><span class="social-label">Fans</span>')));
                            }
                            else if (settings.theme == 'wide') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 0) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button fb').append('<span class="social-count">' + getCount('facebook'))));
                            }
                            else if (settings.theme == 'icon') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 0) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button fb').append('<span class="social-count">' + getCount('facebook'))));
                            }
                            else if (settings.theme == 'default' || settings.theme == 'compact') {
                                btn = $('<div class="fshare-box"><div class="fshare-box-inner"><div id="fb-root"></div><div class="fb-like" data-send="false" data-layout="box_count" data-width="80" data-show-faces="false" data-font="arial"></div></div></div>');
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = '//connect.facebook.net/en_US/all.js#xfbml=1';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                            }
                            break;
                        case 'twitter':
                            if (settings.theme == 'large') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 1) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button tw').append('<span class="social-count">' + getCount('twitter') + '</span><span class="social-label">Followers</span>')));
                            }
                            else if (settings.theme == 'wide') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 1) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button tw').append('<span class="social-count">' + getCount('twitter'))));
                            }
                            else if (settings.theme == 'icon') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 1) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button tw').append('<span class="social-count">' + getCount('twitter'))));
                            }
                            else if (settings.theme == 'default' || settings.theme == 'compact') {
                                btn = $('<div class="fshare-box"><div class="fshare-box-inner"><a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a></div></div>');
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = '//platform.twitter.com/widgets.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                            }
                            break;
                        case 'googleplus':
                            if (settings.theme == 'large') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 2) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button gplus').append('<span class="social-count">' + getCount('googleplus') + '</span><span class="social-label">Followers</span>')));
                            }
                            else if (settings.theme == 'wide') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 2) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button gplus').append('<span class="social-count">' + getCount('googleplus'))));
                            }
                            else if (settings.theme == 'icon') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 2) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button gplus').append('<span class="social-count">' + getCount('googleplus'))));
                            }
                            else if (settings.theme == 'default' || settings.theme == 'compact') {
                                btn = $('<div class="fshare-box"><div class="fshare-box-inner"> <g:plusone size="tall"></g:plusone></div></div>');
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                            }
                            break;
                        case 'linkedin':
                            if (settings.theme == 'large') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 3) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button in').append('<span class="social-count">' + getCount('linkedin') + '</span><span class="social-label">Connects</span>')));
                            }
                            else if (settings.theme == 'wide') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 3) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button in').append('<span class="social-count">' + getCount('linkedin'))));
                            }
                            else if (settings.theme == 'icon') {
                                btn = $('<a/>').attr('href', '' + getShareUrl(type, 3) + '').attr('target', '_blank').addClass('social-label').append($('<div/>').addClass('fshare-box-inner').append($('<div/>').addClass('fshare-box').addClass('fshare-button in').append('<span class="social-count">' + getCount('in'))));
                            }
                            else if (settings.theme == 'default' || settings.theme == 'compact') {
                                btn = $('<div class="fshare-box"><div class="fshare-box-inner"><script type="IN/Share" data-counter="top"></script></div></div>');
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = '//platform.linkedin.com/in.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                            }
                            break;
                    }
					
                    return btn;
                }
                function getShareUrl(type, index) {
                    var link = mediaSource[index].replace('{ADDRESS}', encodeURIComponent(location.href))
                                                .replace('{TITLE}', encodeURIComponent(document.title))
                                                .replace('{SDESCRIPTION}', encodeURIComponent(settings.desc))
                                                .replace('{SITEURL}', encodeURIComponent(settings.yoursiteurl))
                                                .replace('{SITETITLE}', encodeURIComponent(settings.yoursitetitle))
                                                .replace('{SITENAME}', encodeURIComponent(settings.yoursitename));
                    return link;
                }
                return this;
            });
        }
    });
})(jQuery);