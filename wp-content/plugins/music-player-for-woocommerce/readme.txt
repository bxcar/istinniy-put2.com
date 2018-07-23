=== Music Player for WooCommerce ===
Contributors: codepeople
Donate link: http://wordpress.dwbooster.com/content-tools/music-player-for-woocommerce
Tags:WooCommerce,music player,audio,music,song,player,audio player,media player,mp3,wav,oga,ogg
Requires at least: 3.5.0
Tested up to: 4.9
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Music Player for WooCommerce includes the MediaElement.js music player in the pages of the products with audio files associated.

== Description ==

Music Player for WooCommerce features:

	♪ Includes an audio player that supports formats: OGA, MP3, WAV, WMA
	♪ Includes multiple skins for the Music Player
	♪ Supports all most popular web browsers and mobile devices
	♪ Includes a widget to insert a playlist on sidebars

Music Player for WooCommerce includes the MediaElement.js music player in the pages of the products with audio files associated, and in the store's pages, furthermore, the plugin allows selecting between multiple skins.

MediaElement.js is an music player compatible with all major browsers: Internet Explorer, Firefox, Opera, Safari, Chrome and mobile devices: iPhone, iPad, Android. The music player is developed following the html5 standard; in old browsers the music player uses alternative technologies like Flash and Silverlight. The music player supports the following file formats: MP3, WAV, WMA and OGA.

The basic version of the plugin, available for free from the WordPress Directory, has the features needed to include a music player in the pages of the products and the store.

**Premium Features**

*	Allows playing the audio files in secure mode to prevent unauthorized downloading of the audio files.
*	Allows to define the percent of the audio file's size to be played in secure mode.

== Installation ==

**To install Music Player for WooCommerce, follow these steps:**

1. Download and unzip the plugin
2. Upload the entire "woocommerce_music_player" directory to the "/wp-content/plugins/" directory
3. Activate the plugin through the "Plugins" menu in "WordPress"
4. Go to the products pages to configure the players.

== Interface ==

**Global Settings of Music Players**

The global settings are accessible through the menu option: "Settings/Music Player for WooCommerce".

*   Include music player in all all products: checkbox to include the music player in all products.
*   Include in: radio button to decide where to display the music player, in pages with a single entry, multiple entries, or both (both cases by default).
*   Merge in grouped products: in grouped products, display the "Add to cart" buttons and quantity fields in the players rows.
*   Player layout: list of available skins for the music player.
*   Preload: to decide if preload the audio files, their metadata, or don't preload nothing at all.
*	Play all: play all players in the page (one after the other).
*   Player controls: determines the controls to include in the music player.
*   Display the player's title: show/hide the name associated to the downloadable file.
*   Protect the file: checkbox to playback the songs in secure mode (only available in the pro version of the plugin).
*   Percent of audio used for protected playbacks: integer number from 0 to 100, that represents the percent of the size of the original audio file that will be used in the audio file for demo (only available in the pro version of the plugin).
* 	Apply the previous settings to all products pages in the website: tick the checkbox to apply the previous settings to all products overwriting the products' settings.

**Setting up the Music Players through the products' pages**

The Music Players are configured from the products pages.

**Settings Interface**

*   Include music player: checkbox to include the music player in the product's page, or not.
*   Include in: radio button to decide where to display the music player, in pages with a single entry, multiple entries, or both (both cases by default).
*   Merge in grouped products: in grouped products, display the "Add to cart" buttons and quantity fields in the players rows.
*   Player layout: list of available skins for the music player.
*   Preload: to decide if preload the audio files, their metadata, or don't preload nothing at all.
*	Play all: play all players in the page (one after the other).
*   Player controls: determines the controls to include in the music player.
*   Display the player's title: show/hide the name associated to the downloadable file.
*   Protect the file: checkbox to playback the songs in secure mode (only available in the pro version of the plugin).
*   Percent of audio used for protected playbacks: integer number from 0 to 100, that represents the percent of the size of the original audio file that will be used in the audio file for demo (only available in the pro version of the plugin).
*	Select my own demo files: checkbox to use different audio files for demo, than the audio files for selling (only available in the pro version of the plugin).
*	Demo files: section similar to the audio files for selling, but in this case it allows to select different audio files for demo, and their names (only available in the pro version of the plugin).

**How the Pro version of the Music Player for WooCommerce protect the audio files?**

If the "Protect the file" checkbox was ticked in the product's page, and was entered an integer number through the attribute: "Percent of audio used for protected playbacks", the plugin will create a truncated copy of the audio files for selling (or the audio files for demo) into the "/wp-content/plugins/wcmp" directory, to be used as demo. The sizes of the audio files for demo are a percentage of the sizes of the original files (the integer number entered in the player's settings). So, the users cannot access to the original audio files, from the public pages of the products.

**Music Player for WooCommerce - Playlist Widget**

The widget allows to include a playlist on sidebars, with the downloadable files associated to all products with the music player enabled, or for only some of the products.

The widget settings:

*	Title: the title of the widget on sidebar.
*	Products IDs: enter the ids of products to include in the playlist, separated by comma, or the * symbol to include all products.
*	Player layout: select the layout of music players (the widget uses only the play/pause control)
*   Preload: to decide if preload the audio files, their metadata, or don't preload nothing at all. This attribute has a global scope, and will modify the default settings.
*	Play all: play all players in the page (one after the other). This attribute has a global scope, and will modify the default settings.
*	Display file name: if the checkbox is ticked, the playlist will include the name of the downloadable file, or the product's name if it is unchecked.
*	Highlight the current product: if the checkbox is ticked, and the user is in the page of a product, and it is included in the playlist, the corresponding item would be highlighted in the playlist.
*	Continue playing after navigate: if the checkbox is ticked, and there is a song playing when navigates, the player will continue playing after loading the webpage, in the same position.

Note: In mobiles devices where the direct action of user is required for playing audios and videos, the plugin cannot start playing dynamically.


**Music Player for WooCommerce - [wcmp-playlist] shortcode**

The [wcmp-playlist] shortcode allows to include a playlist on the pages' contents, with all products, or for some of them.

The shortcode attributes are:

*	products_ids: define the ids of products to include in the playlist, separated by comma, or the * symbol to include all products: [wcmp-playlist products_ids="*"]
*	player_style: select the layout of music players (the playlist displays only the play/pause control): [wcmp-playlist products_ids="*" player_style="mejs-classic"]
*	file_name: if the value is 1 the playlist will include the name of the downloadable file, or the product's name if it is 0:[wcmp-playlist products_ids="*" file_name="1"]
*	highlight_current_product: if the playlist is included in a product's page, the corresponding item would be highlighted in the playlist: [wcmp-playlist products_ids="*" highlight_current_product="1"]
*	continue_playing: if there is a song playing when navigates, the player will continue playing after loading the webpage in the same position: [wcmp-playlist products_ids="*" continue_playing="1"]
*	controls: allows to define the controls to be used with the players on playlist. The possible values are: track or all, to include only a play/pause button or all player's controls respectively.

Note: In mobiles devices where the direct action of user is required for playing audios and videos, the plugin cannot start playing dynamically.


**Hooks (actions and filters)**

* wcmp_before_player_shop_page: action called before the players containers in the shop pages.
* wcmp_after_player_shop_page: action called after the players containers in the shop pages.
* wcmp_before_players_product_page: action called before the players containers in the products pages.
* wcmp_after_players_product_page: action called after the players containers in the products pages.

* wcmp_audio_tag: filter called when the audio tag is generated. The callback function receives three parameters: the audio tag, the product's id, and the file's id;
* wcmp_file_name: filter called when the file's name is included with the player. The callback function receives three parameters: the file's name, the product's id, and the file's id;

* wcmp_widget_audio_tag: filter called when the audio tag is generated as a widget on sidebars. The callback function receives three parameters: the audio tag, the product's id, and the file's id;
* wcmp_widget_file_name: filter called when the file's name is included with the player as a widget on sidebars. The callback function receives three parameters: the file's name, the product's id, and the file's id;

== Frequently Asked Questions ==

= Q: Why the audio file is played partially? =

A: If you decide to protect the audio files, the plugin creates a truncated version of the file to be used as demo and prevent that the original file be copied by unauthorized users.

= Q: Why the music player is not loading on page? =

A: Verify that the theme used in your website, includes the function wp_footer(); in the template file "footer.php" or the template file "index.php"

= Q: What can I do if the woocommerce_music_player directory exists and the premium version of plugin cannot be installed? =

A: Go to the plugins section in WordPress, deactivate the free version of Music Player for WooCommerce, and delete it ( Don't worry, this process don't modify players configured with the free version of the plugin), and finally install and activate the premium version of plugin.

= Q: Can be modified the size of audio files played in secure mode? =

A: In the pro version of the plugin the files for demo are generated dynamically to prevent the access to the original files.

Each time save the data of a product, the files for demo are deleted and generated again, so, you simply should modify the percentage of the audio file to be used for demo in the product's page.

== Screenshots ==
01. Music players in the store's pages
02. Music player in the products pages
03. Music player skins
04. Music player settings
05. Playlist widget

== Changelog ==

= 1.0.38 =

* Removes functions that were deprecated in PHP 7.2

= 1.0.37 =

* Improves the appearance and behavior of plugin in grouped products.

= 1.0.36 =

* Modifies the way the music players are generated.
* Replaces some deprecated functions in WooCommerce.
* The Professional version allows the integration with Google Drive to store the demo files in the cloud.

= 1.0.35 =

* Includes some modifications in the grouped products.

= 1.0.34 =

* Fixes an issue when the WordPress and the public website include different schemes in their URLs.

= 1.0.33 =

* Includes the crossOrigin attribute in the audio tags for playing files in external domains.

= 1.0.32 =

* Includes the controls attribute in the [wcmp-playlist] shortcode, with the possible values: track and all for displaying only the play/pause button or all player's controls.
* The professional version of the plugin allows to define a message to be shown beside the music players with a message describing the use of partial versions of the audio files for selling as demo.

= 1.0.31 =

* Includes the music player with a different WooCommerce action to display it even if the product is not for selling (does not includes an "Add to cart" button).

= 1.0.30 =

* Modifies the settings page of the plugin.
* The professional version allows to use the FFMpeg application in the server to generate the demo files.

= 1.0.29 =

* Fixes an issue with the play all feature.

= 1.0.28 =

* Adds the settings page to define the default players' settings. From the settings page it is possible activate and configure the player in all existent and future products.

= 1.0.27 =

* Improved the process that determines the duration of the original audio files.

= 1.0.26 =

* For the audio files published in the website, the plugin displays the duration of the original file, even if player was configured to protect the original files creating truncated versions for demo.

= 1.0.25 =

* Loads a specific version of the MediaElementJS library to prevent an issue with the next version of WordPress 4.9

= 1.0.24 =

* Improves the players' settings.

= 1.0.23 =

* Allows configure all products in the website at the same time.

= 1.0.22 =

* Includes a new option to decide the pages where showing the music players: pages with a single entry, with multiple-entries, or both.

= 1.0.21 =

* Allows controlling the "preload" attribute of audio tags through the player's settings.

= 1.0.20 =

* Modifies the widget.
* Adds the [wcmp-playlist] shortcode to include a playlist in the website's pages.

= 1.0.19 =

* Fixes the order of players in grouped and variable products.

= 1.0.18 =

* Fixes an issue in the promote banner.

= 1.0.17 =

* Modifies the module for accessing the WordPress reviews section.

= 1.0.16 =

* Modifies the module that merges the music players with the products titles and the "add to cart" buttons of grouped products.

= 1.0.15 =

* Improves the access to the plugin documentation.
* Modifies the module that delete the copies of files used by the player.

= 1.0.14 =

* Modifies the plugin to be compatible with the new version of WooCommerce 3.x

= 1.0.13 =

* Includes the "Play all" option in the settings, for playing all audio files in the same page, one after the other.

= 1.0.12 =

* Fixes an issue accessing to outer-domain audio files.
* Includes a new option in the player's settings to display the "Add to Cart" buttons, beside each player in the Grouped Products.
* Adds a list of Hooks (actions and filters) to allow developers and designers modify the players section.

= 1.0.11 =

* Fixes a conflict with the links to the products pages in the shop's pages.

= 1.0.10 =

* Move the Music Player settings to its own metabox.
* Allows to integrate the players with "Simple", "Variable", and "Grouped" products (the previous version was compatible only with "Simple" products).

= 1.0.9 =

* Modifies the plugin's interface.
* Fixes some tags in the music players.
* Clears the generated audio files when the plugin is deactivated.

= 1.0.8 =

* Fixes an issue with the products' ids in the playlist widget.

= 1.0.7 =

* Includes some changes in the plugin's interface.

= 1.0.6 =

* Allows show/hide the name of downloadable files beside the player.
* Includes the widget "Music Player for WooCommerce - Playlist"

= 1.0.5 =

* Adds a new feature to specify the controls in the music player.

= 1.0.4 =

* Modifies the module to determine if the audio file is local to the website or not.

= 1.0.3 =

* Allows to play m4a files.

= 1.0.2 =

* Fixed some conflicts with styles of the active themes.

= 1.0.1 =

* Fixed an issue in the URL of the audio files.

= 1.0.0 =

* First version released.

== Upgrade Notice ==

= 1.0.38 =

Important note: If you are using the Professional version don't update via the WP dashboard but using your personal update link. Contact us if you need further information: http://wordpress.dwbooster.com/support