jQuery( window ).on(
	'load', 
	function()
	{
		var $ 		= jQuery,
			cname 	= 'wcmp_playing',
			ctime 	= 0;
		
		function setCookie( value ) 
		{
			var expires = "expires="+ctime;
			document.cookie = cname + "=" + value + "; " + expires;
		}

		function deleteCookie() 
		{
			document.cookie = cname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
		}

		function getCookie() 
		{
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}
		
		// Get history
		var cookie = getCookie(),
			parts,
			player;
		
		if( !/^\s*$/.test( cookie ) )
		{
			parts  = cookie.split( '||' );
			if( parts.length == 2 )
			{
				player = $( '#'+parts[ 0 ] );
				if( player.length )
				{
					player[0].currentTime = parts[1];
					player[0].play();
				}	
			}	
		}	
		
		// Set events
		$( '.wcmp-player audio' )
		.on( 
			'timeupdate', 
			function()
			{
				var id = $( this ).attr( 'id' );
				setCookie( id+'||'+this.currentTime );
			} 
		)
		.on( 
			'ended pause', 
			function()
			{
				deleteCookie();
			} 
		);
	}
);