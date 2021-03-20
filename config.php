
<?php
  //PMPD Configuration
  $pmpConfigVersion = '2';
  $pmpUsername = 'admin';
  $pmpPassword = 'password1';
  $pmpClearImageCache = 'Yes'; //Default Yes
  $pmpImageSpeed = '30'; //Default 30 Seconds
  $pmpPosterDir = 'cache/posters/'; //Default cache/posters/ (FUTURE)
  $pmpArtDir = 'cache/art/'; //Default cache/art/ (FUTURE)
  $pmpCustomDir = 'cache/custom/'; //Default cache/custom/ (FUTURE)
  $pmpLogDir = 'cache/logs/'; //Default cache/logs/ (FUTURE)

  //Server Configuration
  $plexServer = '';
  $plexServerDirect = '';
  $plexToken = '';
  $plexServerMovieSection = '';
  $cacheEnabled = ''; //Default true
  $plexServerSSL = ''; //Default: Unchecked

  //Client Configuration
  $plexClient = '';
  $plexClientName = '';

  //Custom Image Configuration
  $customBackgroundArt = ''; //Default: false
  $customImageEnabled = 'Disabled'; //Default: Disabled
  $customRefreshSpeed = '30'; //Default 30 Seconds
  $customImage = '';
  $customTopText = '';
  $customTopFontSize = '55'; //Default: 55 (px)
  $customTopFontColor = '#FFFF00'; //Default: #FFFF00 (Yellow)
  $customTopFontEnabled = ''; //Default: Unchecked
  $customTopFontID = 'None'; //Default: None
  $customTopFontOutlineSize = '0'; //Default: 0 (px)
  $customTopFontOutlineColor = '#FFFF00'; //Default: #FFFF00 (Yellow)
  $customBottomText = '';
  $customBottomFontSize = '25'; //Default: 25 (px)
  $customBottomFontColor = '#FFFFFF'; //Default: #FFFFFF (White)
  $customBottomFontEnabled = ''; //Default: Unchecked
  $customBottomFontID = 'None'; //Default: None
  $customBottomFontOutlineSize = '0'; //Default: 0 (px)
  $customBottomFontOutlineColor = '#FFFFFF'; //Default: #FFFFFF (White)

  //Coming Soon Configuration
  $comingSoonBackgroundArt = ''; //Default: false
  $comingSoonRefreshSpeed = '30'; //Default 30 Seconds
  $comingSoonTop = 'custom'; //Default: custom (title/summary/tagline/custom)
  $comingSoonTopAutoScale = ''; //Default: false
  $comingSoonTopText = 'COMING SOON';
  $comingSoonTopFontSize = '55'; //Default: 55 (px)
  $comingSoonTopFontColor = '#FFFF00'; //Default: #FFFF00 (Yellow)
  $comingSoonTopFontEnabled = ''; //Default: Unchecked
  $comingSoonTopFontID = 'None'; //Default: None
  $comingSoonTopFontOutlineSize = '0'; //Default: 0 (px)
  $comingSoonTopFontOutlineColor = '#FFFF00'; //Default: #FFFF00 (Yellow)
  $showComingSoonInfo = ''; //Default: false
  $comingSoonBottom = 'custom'; //Default: custom (title/summary/tagline/custom)
  $comingSoonBottomText = 'www.mattsshack.com';
  $comingSoonBottomAutoScale = ''; //Default: false
  $comingSoonBottomScroll = 'Disabled'; //Default: Disabled
  $comingSoonBottomFontSize = '25'; //Default: 25 (px)
  $comingSoonBottomFontColor = '#FFFFFF'; //Default: #FFFFFF (White)
  $comingSoonBottomFontEnabled = ''; //Default: Unchecked
  $comingSoonBottomFontID = 'None'; //Default: None
  $comingSoonBottomFontOutlineSize = '0'; //Default: 0 (px)
  $comingSoonBottomFontOutlineColor = '#FFFFFF'; //Default: #FFFFFF (White)
  $comingSoonShowSelection = 'unwatched'; //Default: unwatched
  $comingSoonShowTVThumb = 'series'; //Default: series

  //Now Showing Configuration
  $nowShowingBackgroundArt = ''; //Default: false
  $nowShowingRefreshSpeed = '30'; //Default 30 Seconds
  $nowShowingTop = 'custom'; //Default: custom (title/summary/tagline/custom)
  $nowShowingTopAutoScale = ''; //Default: false
  $nowShowingTopText = 'NOW SHOWING';
  $nowShowingTopFontSize = '55'; //Default: 55 (px)
  $nowShowingTopFontColor = '#FFFF00'; //Default: #FFFF00 (Yellow)
  $nowShowingTopFontEnabled = ''; //Default: Unchecked
  $nowShowingTopFontID = 'None'; //Default: None
  $nowShowingTopFontOutlineSize = '0'; //Default: 0 (px)
  $nowShowingTopFontOutlineColor = '#FFFF00'; //Default: #FFFF00 (Yellow)
  $nowShowingBottom = 'title'; //Default: title (title/summary/tagline/custom)
  $nowShowingBottomText = '';
  $nowShowingBottomAutoScale = ''; //Default: false
  $nowShowingBottomScroll = 'Disabled'; //Default: Disabled
  $nowShowingBottomFontSize = '25'; //Default: 25 (px)
  $nowShowingBottomFontColor = '#FFFFFF'; //Default: #FFFFFF (White)
  $nowShowingBottomFontEnabled = ''; //Default: Unchecked
  $nowShowingBottomFontID = 'None'; //Default: None
  $nowShowingBottomFontOutlineSize = '0'; //Default: 0 (px)
  $nowShowingBottomFontOutlineColor = '#FFFFFF'; //Default: #FFFFFF (White)
  $nowShowingShowTVThumb = 'series'; //Default: series

  //Misc Configuration
  $pmpDisplayProgress = 'Disabled'; //Default: Disabled
  $pmpDisplayProgressSize = '5'; //Default: 5 (px)
  $pmpDisplayProgressColor = '#FFFF00'; //Default: #FFFF00 (Yellow)
  $pmpDisplayClock = 'Disabled'; //Default: Disabled (FUTURE)
  $pmpBottomScroll = 'Disabled'; //Default: Disabled
  $pmpBottomScrollSpeed = '1'; //Default: 1 (FUTURE)
?>