function generate_the_wcmp()
{
	if('undefined' !== typeof generated_the_wcmp) return;
	generated_the_wcmp = true;

	var $ = jQuery;
	$(document).on('click', '.wcmp-player-container', function(evt){evt.preventDefault();evt.stopPropagation();});
	play_all = (typeof wcmp_global_settings != 'undefined') ? wcmp_global_settings[ 'play_all' ] : true; // Play all songs on page

	/**
	 * Play next player
	 */
	function _playNext( playerNumber )
	{
		if( playerNumber+1 < player_counter )
		{
			var toPlay = playerNumber+1;
			if( players[ toPlay ] instanceof jQuery && players[ toPlay ].is( 'a' ) ) players[ toPlay ].click();
			else players[ toPlay ].play();
		}
	};

	jQuery.expr[':'].regex = function(elem, index, match) {
		var matchParams = match[3].split(','),
			validLabels = /^(data|css):/,
			attr = {
				method: matchParams[0].match(validLabels) ?
							matchParams[0].split(':')[0] : 'attr',
				property: matchParams.shift().replace(validLabels,'')
			},
			regexFlags = 'ig',
			regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g,''), regexFlags);
		return regex.test(jQuery(elem)[attr.method](attr.property));
	}

	//------------------------ MAIN CODE ------------------------
	var players = [],
		player_counter = 0,
		s = $('.wcmp-player:not(.track)'),
		m = $('.wcmp-player.track'),
		c = {
				iPadUseNativeControls: false,
				iPhoneUseNativeControls: false,
				success: function( media, dom ){
					var update_duration = function(e){
						var t = $(e.target),
							duration = t.data('duration');
						if(typeof duration != 'undefined')
						{
							t.closest('.wcmp-player-container')
							 .find('.mejs-duration')
							 .html(duration);
						}
					};
					media.addEventListener( 'timeupdate', function( e ){
						update_duration(e);
						if( !isNaN( this.currentTime ) && !isNaN( this.duration ) && this.src.indexOf( 'ms-action=secure' ) != -1 )
						{
							if( this.duration - this.currentTime < 4 )
							{
								this.setVolume( this.volume - this.volume / 3 );
							}
							else
							{
								if( typeof this[ 'bkVolume' ] == 'undefined' ) this[ 'bkVolume' ] = this.volume;
								this.setVolume( this.bkVolume );
							}

						}
					});
					media.addEventListener( 'volumechange', function( e ){
						if( !isNaN( this.currentTime ) && !isNaN( this.duration ) && this.src.indexOf( 'ms-action=secure' ) != -1 )
						{
							if( ( this.duration - this.currentTime > 4 ) && this.currentTime )  this[ 'bkVolume' ] = this.volume;
						}
					});

					media.addEventListener( 'ended', function( e ){
						if( play_all*1 )
						{
							var playerNumber = $(this).attr('playerNumber')*1;
							_playNext( playerNumber );
						}
					});

					media.addEventListener('loadedmetadata', function( e ){
						update_duration(e);
					});
				}
			},
		selector = '.product-type-grouped :regex(name,quantity\\[\\d+\\])';

	s.each(function(){
		var e 	= $(this),
			src = e.find( 'source' ).attr( 'src' );

		c['audioVolume'] = 'vertical';
		try{
			players[ player_counter ] = new MediaElementPlayer(e, c);
		}
		catch(err)
		{
			players[ player_counter ] = new MediaElementPlayer(e[0], c);
		}
		e.attr('playerNumber', player_counter);
		player_counter++;
	});


	m.each(function(){
		var e = $(this),
			src = e.find( 'source' ).attr( 'src' );

		c['features'] = ['playpause'];
		try{
			players[ player_counter ] = new MediaElementPlayer(e, c);
		}
		catch(err)
		{
			players[ player_counter ] = new MediaElementPlayer(e[0], c);
		}
		e.attr('playerNumber', player_counter);
		player_counter++;
	});

	if(!$(selector).length) selector = '.product-type-grouped [data-product_id]';
	$(selector).each(function(){
		var e = $(this),
			i = e.data( 'product_id' )||e.attr('name').replace(/[^\d]/g,''),
			c = $( '.wcmp-player-list.merge_in_grouped_products .product-'+i+':first .wcmp-player-title' ), /* Replaced :last with :first 2018.06.12 */
			t = $('<table></table>');

		if(c.length)
		{
			c.closest('tr').addClass('wcmp-first-in-product'); /* To identify the firs element in the produdct */
			if(c.closest('form').length == 0)
			{
				c.closest('.wcmp-player-list').prependTo(e.closest('form'));
			}
			t.append(e.closest('tr').prepend('<td>'+c.html()+'</td>'));
			c.html('').append(t);
		}
	});
}
jQuery(generate_the_wcmp);
jQuery(window).on('load', generate_the_wcmp);