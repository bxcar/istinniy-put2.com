/*
 * Karma Music Player by Kadar - JS Core File
 * http://kadarclaudiu.com/karma
 *
 * Author: Kadar Claudiu
 * Version: 1.0.0
 * Date: 25th June 2017
 */

jQuery(document).ready(function(){

	var isMobile = false;
	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;

	jQuery('.karma-by-kadar__simple-player').each(function(i){

		var $this 					= jQuery(this),
			actualPlayerSelector 	= '.karma-by-kadar__simple-player[data-index=karma-by-kadar__simple__index-' + i + ']';

		$this.attr('data-index', 'karma-by-kadar__simple__index-' + i);

		$this = jQuery(actualPlayerSelector);

		var	theSrc				= $this.attr('data-src'),
			theAudioTitle		= $this.attr('data-title'),
			thePoster			= $this.attr('data-poster'),
			theAudioVolume		= $this.attr('data-volume'),
			theAudioLoop		= $this.attr('data-loop'),
			theAudioAutoplay	= $this.attr('data-autoplay'),
			theAudioRTL			= $this.attr('data-rtl'),
			seekBarClass 		= '.karma-by-kadar__simple-player__seekbar',
			playButtonClass 	= '.karma-by-kadar__simple-player__play',
			pauseButtonClass 	= '.karma-by-kadar__simple-player__pause',
			playerClass 		= '.karma-by-kadar__simple-player__player',
			titleClass 			= '.karma-by-kadar__simple-player__title',
			currentTimeClass 	= '.karma-by-kadar__simple-player__current-time',
			durationClass 		= '.karma-by-kadar__simple-player__duration',
			volumeClass 		= '.karma-by-kadar__simple-player__volume',
			volumeSeekbarClass 	= '.karma-by-kadar__simple-player__volume__seekbar',
			muteClass 			= '.karma-by-kadar__simple-player__mute',
			unmuteClass 		= '.karma-by-kadar__simple-player__unmute',
			theSeekBar 			= $this.find(seekBarClass),
			playButton 			= $this.find(playButtonClass),
			pauseButton 		= $this.find(pauseButtonClass),
			thePlayer 			= $this.find(playerClass),
			theTitle 			= $this.find(titleClass),
			theVolume 			= $this.find(volumeClass),
			theVolumeSeekbar 	= $this.find(volumeSeekbarClass),
			theMute 			= $this.find(muteClass),
			theUnmute 			= $this.find(unmuteClass),
			actualVolume 		= theAudioVolume;

		if ( theAudioLoop === 'loop' ) {

			theAudioLoop = true;

		}

		if ( theAudioRTL === 'rtl' ) {

			theAudioRTL = true;

		} else {

			theAudioRTL = false;

		}

		thePlayer.jPlayer({
			ready: function() {

				thePlayer.jPlayer( 'setMedia', {
					m4a: theSrc,
					title: theAudioTitle,
				});

				thePlayer.jPlayer('volume', theAudioVolume);

				if ( theAudioAutoplay === 'autoplay' ) {

					thePlayer.jPlayer('play');

				}

			},
			play: function() {

				thePlayer.jPlayer('pauseOthers');

			},
			timeupdate: function(event) {

				var currentPercent = event.jPlayer.status.currentPercentAbsolute;

				theSeekBar.slider('value', currentPercent);

			},
			volumechange: function(event) {

				if ( isMobile === false ) {

					if(event.jPlayer.options.muted) {

						theVolumeSeekbar.slider('value', 0);

					} else {

						theVolumeSeekbar.slider('value', actualVolume);

					}

				}

			},
			supplied: 'm4a',
			preload: 'metadata',
			loop: theAudioLoop,
			cssSelectorAncestor: actualPlayerSelector,
			cssSelector: {
				play: playButtonClass,
				pause: pauseButtonClass,
				currentTime: currentTimeClass,
				duration: durationClass,
				mute: muteClass,
				unmute: unmuteClass
			},
		});

		var playerData = thePlayer.data('jPlayer');

		theSeekBar.slider({
			range: 'min',
			value: 0,
			min: 0,
			step: 0.1,
			max: 100,
			isRTL: theAudioRTL,
			slide: function( event, ui ) {

				var actualSeekPercent = playerData.status.seekPercent;

				if(actualSeekPercent > 0) {

					thePlayer.jPlayer('playHead', ui.value * (100 / actualSeekPercent));

				} else {

					setTimeout(function() {

						theSeekBar.slider('value', 0);

					}, 0);

				}

			}
		});

		theTitle.each(function(){

			var $this = jQuery(this),
				titleText = $this.find('.karma-by-kadar__simple-player__title__the-title').text();

			$this.append('<div class="karma-by-kadar__simple-player__title__tooltip">' + titleText + '</div>');

			$this.on('click', function(e){

				e.stopPropagation();

				jQuery(titleClass).removeClass('active');

				jQuery(this).addClass('active');

			});

		});

		jQuery('body').on('click', function(){

			jQuery(titleClass).removeClass('active');

		});

		if ( isMobile === true ) {

			$this.addClass('is-mobile-device');

		} else {

			theVolumeSeekbar.slider({
				range: 'min',
				value: theAudioVolume * 100,
				min: 0,
				step: 0.01,
				max: 1,
				isRTL: theAudioRTL,
				slide: function( event, ui ) {

					actualVolume = ui.value;

					thePlayer.jPlayer('option', 'muted', false);

					thePlayer.jPlayer('volume', actualVolume);

				}
			});

			theVolume.on('hover', function(){

				$this.toggleClass('volume-is-opened');

			});

		}

	});

});