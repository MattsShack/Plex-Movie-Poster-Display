
<?php
  // PMPD Configuration
  $pmpConfigVersion = '2.10.7';
  $pmpUsername = 'admin';
  $pmpPassword = 'password1';
  $pmpClearImageCache = 'Yes'; // Default: Yes
  // $pmpImageSpeed = '30'; // Default: 30 (Seconds)

  // Cache Configuration
  $cacheEnabled = '1'; // Default: TRUE
  $pmpPosterDir = 'cache/posters/'; // Default: cache/posters/
  $pmpPosterDir_24hExp = '1'; // Default: TRUE
  $pmpArtDir = 'cache/art/'; // Default: cache/art/
  $pmpArtDir_24hExp = '1'; // Default: TRUE
  $pmpCustomDir = 'cache/custom/'; // Default: cache/custom/
  $pmpCustomDir_24hExp = ''; // Default: FALSE
  $pmpFontDir = 'cache/fonts/'; // Default: cache/fonts/
  $pmpFontDir_24hExp = ''; // Default: FALSE
  $pmpLogDir = 'cache/logs/'; // Default: cache/logs/
  $pmpLogDir_24hExp = ''; // Default: FALSE

  // Plex Configuration
  $plexServer = '';
  $plexServerDirect = '';
  $plexToken = '';
  $plexServerMovieSection = '';
  $plexServerSSL = ''; // Default: FALSE
  $plexClient = '';
  $plexClientName = '';

  // Custom Image Configuration
  $customBackgroundArt = ''; // Default: FALSE
  $customFullScreenArt = ''; // Default: FALSE
  $customRefreshSpeed = '30'; // Default: 30 (Seconds)
  $customImageEnabled = 'Disabled'; // Default: Disabled
  $customImage = '';

  // Custom Image Configuration - Top Settings
  $customTopText = '';
  $customTopFontSize = '55'; // Default: 55 (px)
  $customTopFontColor = '#FFFF00'; // Default: #FFFF00 (Yellow)
  $customTopFontOutlineSize = '0'; // Default: 0 (px)
  $customTopFontOutlineColor = '#FFFF00'; // Default: #FFFF00 (Yellow)
  $customTopFontEnabled = ''; // Default: FALSE
  $customTopFontID = 'None'; // Default: None

  // Custom Image Configuration - Bottom Settings
  $customBottomText = '';
  $customBottomFontSize = '25'; // Default: 25 (px)
  $customBottomFontColor = '#FFFFFF'; // Default: #FFFFFF (White)
  $customBottomFontOutlineSize = '0'; // Default: 0 (px)
  $customBottomFontOutlineColor = '#FFFFFF'; // Default: #FFFFFF (White)
  $customBottomFontEnabled = ''; // Default: FALSE
  $customBottomFontID = 'None'; // Default: None

  // Coming Soon Configuration
  $comingSoonBackgroundArt = ''; // Default: FALSE
  $comingSoonFullScreenArt = ''; // Default: FALSE
  $comingSoonRefreshSpeed = '30'; // Default: 30 (Seconds)
  $comingSoonShowTVThumb = 'series'; // Default: series
  $comingSoonShowSelection = 'unwatched'; // Default: unwatched
  // $showComingSoonInfo = ''; // Default: FALSE

  // Coming Soon Configuration - Top Settings
  $comingSoonTop = 'custom'; // Default: custom (title/summary/tagline/custom)
  $comingSoonTopText = 'COMING SOON';
  $comingSoonTopFontSize = '55'; // Default: 55 (px)
  $comingSoonTopFontColor = '#FFFF00'; // Default: #FFFF00 (Yellow)
  $comingSoonTopFontOutlineSize = '0'; // Default: 0 (px)
  $comingSoonTopFontOutlineColor = '#FFFF00'; // Default: #FFFF00 (Yellow)
  $comingSoonTopFontEnabled = ''; // Default: FALSE
  $comingSoonTopFontID = 'None'; // Default: None
  $comingSoonTopAutoScale = ''; // Default: FALSE

  // Coming Soon Configuration - Bottom Settings
  $comingSoonBottom = 'custom'; // Default: custom (title/summary/tagline/presented/custom)
  $comingSoonBottomText = 'www.mattsshack.com';
  $comingSoonBottomFontSize = '25'; // Default: 25 (px)
  $comingSoonBottomFontColor = '#FFFFFF'; // Default: #FFFFFF (White)
  $comingSoonBottomFontOutlineSize = '0'; // Default: 0 (px)
  $comingSoonBottomFontOutlineColor = '#FFFFFF'; // Default: #FFFFFF (White)
  $comingSoonBottomFontEnabled = ''; // Default: FALSE
  $comingSoonBottomFontID = 'None'; // Default: None
  $comingSoonBottomAutoScale = ''; // Default: FALSE
  $comingSoonBottomScroll = 'Disabled'; // Default: Disabled

  // Now Showing Configuration
  $nowShowingBackgroundArt = ''; // Default: FALSE
  $nowShowingFullScreenArt = ''; // Default: FALSE
  $nowShowingRefreshSpeed = '30'; // Default: 30 (Seconds)
  $nowShowingShowTVThumb = 'series'; // Default: series
  $pmpDisplayProgress = 'Disabled'; // Default: Disabled
  $pmpDisplayProgressSize = '5'; // Default: 5 (px)
  $pmpDisplayProgressColor = '#FFFF00'; // Default: #FFFF00 (Yellow)

  // Now Showing Configuration - Top Settings
  $nowShowingTop = 'custom'; // Default: custom (title/summary/tagline/custom)
  $nowShowingTopText = 'NOW SHOWING';
  $nowShowingTopFontSize = '55'; // Default: 55 (px)
  $nowShowingTopFontColor = '#FFFF00'; // Default: #FFFF00 (Yellow)
  $nowShowingTopFontOutlineSize = '0'; // Default: 0 (px)
  $nowShowingTopFontOutlineColor = '#FFFF00'; // Default: #FFFF00 (Yellow)
  $nowShowingTopFontEnabled = ''; // Default: FALSE
  $nowShowingTopFontID = 'None'; // Default: None
  $nowShowingTopAutoScale = ''; // Default: FALSE

  // Now Showing Configuration - Bottom Settings
  $nowShowingBottom = 'title'; // Default: title (title/summary/tagline/presented/custom)
  $nowShowingBottomText = '';
  $nowShowingBottomFontSize = '25'; // Default: 25 (px)
  $nowShowingBottomFontColor = '#FFFFFF'; // Default: #FFFFFF (White)
  $nowShowingBottomFontOutlineSize = '0'; // Default: 0 (px)
  $nowShowingBottomFontOutlineColor = '#FFFFFF'; // Default: #FFFFFF (White)
  $nowShowingBottomFontEnabled = ''; // Default: FALSE
  $nowShowingBottomFontID = 'None'; // Default: None
  $nowShowingBottomAutoScale = ''; // Default: FALSE
  $nowShowingBottomScroll = 'Disabled'; // Default: Disabled

  // Misc Configuration
  $pmpDisplayClock = 'Disabled'; // Default: Disabled (FUTURE)
  // $pmpBottomScroll = 'Disabled'; // Default: Disabled
  $pmpBottomScrollSpeed = '1'; // Default: 1 (FUTURE)
?>