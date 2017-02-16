;(function($) {
	'use strict';
	$(document).ready(function(){
        if(bgUrl) $('body').css('background-image', 'url('+bgUrl+')');
        
        $('.container').fitVids();

        //Remove class after animation ends.
		var $btn = $('.popup-trigger');

		$btn.click(function () { 

		  $(this).addClass('pulse');
		  
		  $(this).one('webkitAnimationEnd oanimationend msAnimationEnd animationend',   
		    function(e) { $btn.removeClass('pulse'); });
		});

		//Open popup
		$('.popup-trigger').on('click', function(event){
			event.preventDefault();
			$('.share-facebook').attr('data-id', $(this).attr('data-id'));
			$('.share-twitter').attr('data-id', $(this).attr('data-id'));
			$('.popup').addClass('is-visible');
			$('.container').addClass('blur');
		});
		
		//Close popup
		$('.popup').on('click', function(event){
			if( $(event.target).is('.popup-close') || $(event.target).is('.popup') ) {
				event.preventDefault();
				$(this).removeClass('is-visible');
				$('.container').removeClass('blur');
			}
		});
		//Close popup when clicking the esc keyboard button
		$(document).keyup(function(event){
	    	if(event.which=='27'){
	    		$('.popup').removeClass('is-visible');
	    		$('.container').removeClass('blur');
		    }
	    });

		$('.share').on('click', function(e){
			e.preventDefault();
			var title = $(this).attr('data-title');
			var image = $(this).attr('data-image');
			var desc = 'Rösta på vårt bidrag på http://www.lysuppsundsvall.nu';
			var caption = 'Lysuppsundsvall';
			var redir = 'http://www.lysuppsundsvall.nu';
			var share_url = 'http://www.lysuppsundsvall.nu';
			var facebook_appID = '113148352540493'

			var url = "https://www.facebook.com/dialog/feed?app_id="+facebook_appID+"&link="+encodeURIComponent(share_url)+ 
				"&name=" + encodeURIComponent(title)+
				"&caption=" + encodeURIComponent(caption)+
				"&description=" + encodeURIComponent(desc)+
				"&picture=" + encodeURIComponent(image)+
				"&redirect_uri="+encodeURIComponent(redir);
			window.open(url);
		});

        //
        //FACEBOOK 
        //

        //Load Facebook SDK
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		//Init
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '113148352540493',
				cookie     : true, 
				xfbml      : true, 
				version    : 'v2.2' 
			});

			$('.share-facebook').on('click', function(){
				can_haz_vote($(this).attr('data-id'), $(this));
			});

			function can_haz_vote(id, trigger){
				FB.getLoginStatus(function(response) {
					if(response.status != 'connected'){
						//User is not connected to app, trigger Facebook connect dialog
						triggerConnect(id, trigger);
					} else {
						//User is already connected to app, let hen vote
						FB.api('/me', function(response) {
							vote(id, response.id, 'facebook');
						});
					}
				});
			}

			function triggerConnect(id, trigger){
				FB.login(function(response) {
					if(response.authResponse) {
						//User connected, check if hen can haz vote
						can_haz_vote(id, trigger);
					} else {
						//User didn't connected to app, don't let hen vote
						console.log('User cancelled app connect or did not fully authorize.');
					}
				});
			}

		};

		//
		//TWITTER
		//

		$('.share-twitter').on('click', function(){
			$(location).attr('href', 'http://www.lysuppsundsvall.nu?redir&contrib='+$(this).attr('data-id'));
		});

		if((typeof(twitter_user_id) != 'undefined') && (typeof(twitter_contrib_id) != 'undefined')){
			vote(twitter_contrib_id, twitter_user_id, 'twitter');
		}

		//
		//VOTE
		//

		function vote(id, voter, via){
			$.ajax({
		        url: ajaxurl,
		        type: 'POST',
		        data: {
					action: 'lysupp_vote',
					id: id,
					voter: voter,
					via: via
		        },
		        success: function(response){
		        	var resp = $.parseJSON(response);
		        	$('.popup').removeClass('is-visible');
					$('.container').removeClass('blur');

					if(resp.success){
						$('div').find('.vote[data-id="'+id+'"]').parent('.vote-1').addClass('slide-out');
						$('div').find('.vote[data-id="'+id+'"]').parent('.vote-2').addClass('slide-in');

						setTimeout(function(){
						  $('div').find('.vote[data-id="'+id+'"]').parent('.vote-2').addClass('bounce');
						}, 200);
					} else {
						$('div').find('.vote[data-id="'+id+'"]').parent('.vote-1').addClass('slide-out-right');
			        	$('div').find('.vote[data-id="'+id+'"]').parent('.vote-2').removeClass('slide-in');
			        	$('div').find('.vote[data-id="'+id+'"]').parent('.vote-3').addClass('slide-in');

			        	$('div').find('.vote[data-id="'+id+'"]').siblings('.voteing-results').html(resp.error);

			        	setTimeout(function(){
						  $('div').find('.vote[data-id="'+id+'"]').parent('.vote-3').addClass('bounce');
						}, 200);
					}
		        }
	      });
		}

	});
})(jQuery);