<?php
include 'config.php';

// Hot Fix. Security!
// This will grab the image server side.

function getPoster($artWorkLocation) {
	global $plexServer, $plexToken, $plexServerSSL;

	// Setting SSL Prefix
	if ($plexServerSSL) {
		$URLScheme = "https";
		$plexServer = $plexServerDirect;
	}
	else {
		$URLScheme = "http";
	}

	// $posterUrl = "http://$plexServer:32400$artWorkLocation?X-Plex-Token=$plexToken";
	$posterUrl = "$URLScheme://$plexServer:32400$artWorkLocation?X-Plex-Token=$plexToken";

	// Grab Poster
	$ch = curl_init($posterUrl);
	curl_setopt_array(
		$ch,
		 array(
			CURLOPT_RETURNTRANSFER  => true
		)
	);
	$imgRaw = curl_exec($ch);
	curl_close($ch);

	// Get information about the image.
	$imgInfo=getImageSizeFromString($imgRaw);

	// Ensure image, is indeed an image.
	if (empty($imgInfo['mime']) || strpos($imgInfo['mime'], 'image/') !== 0) {
		die('Invalid Image');
	}

	// Create base64 version of image
	$imgBase64 = base64_encode($imgRaw);

	// Return Base64
	return $imgBase64;
}
?>
