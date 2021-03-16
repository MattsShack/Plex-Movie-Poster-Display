<?php
include 'config.php';
include '/assets/plexmovieposter/tools.php';

// Hot Fix. Security!
// This will grab the image server side.

function getPoster($artWorkLocation) {
	global $plexServer, $plexToken, $plexServerSSL, $plexServerDirect;

	$logName = "getPoster";

	// Setting SSL Prefix
	if ($plexServerSSL) {
		$URLScheme = "https";
		$plexServer = "$plexServerDirect";
	}
	else {
		$URLScheme = "http";
	}

	// $mediaUrl = "http://$plexServer:32400$artWorkLocation?X-Plex-Token=$plexToken";
	$mediaUrl = "$URLScheme://$plexServer:32400$artWorkLocation?X-Plex-Token=$plexToken";

	pmp_Logging("$logName", "Media URL ($logName): $mediaUrl");

	// Grab Poster
	$ch = curl_init($mediaUrl);
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

	$testMimeData = mime_content_type($imgInfo);
	pmp_Logging("$logName", "\t Test Mime Data: $testMimeData");

	// Ensure image, is indeed an image.
	if (empty($imgInfo['mime']) || strpos($imgInfo['mime'], 'image/') !== 0) {
		pmp_Logging("$logName", "Invalid Image: $mediaUrl \n\t Check mimetype.");
		// die('Invalid Image');
		echo "Invalid Image<br>";
		return "InvalidImage";
	}

	// Create base64 version of image
	$imgBase64 = base64_encode($imgRaw);

	// Return Base64
	return $imgBase64;
}

function getCachePoster($cacheURL) {
	global $plexServer, $plexToken, $plexServerSSL, $plexServerDirect;
	$PMPServer = $_SERVER['HTTP_HOST'];

	$logName = "getCachePoster";

	// Setting SSL Prefix
	// if ($plexServerSSL) {
		// $URLScheme = "https";
		// $plexServer = "$plexServerDirect";
	// }
	// else {
		$URLScheme = "http";
	// }

	// $mediaUrl = "http://$plexServer:32400$artWorkLocation?X-Plex-Token=$plexToken";
	$mediaUrl = "$URLScheme://$PMPServer/$cacheURL";

	pmp_Logging("$logName", "Media URL ($logName): $mediaUrl");

	// Grab Poster
	$ch = curl_init($mediaUrl);
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

	$testMimeData = mime_content_type("$imgInfo");
	pmp_Logging("$logName", "\t Test Mime Data: $testMimeData");

	// Ensure image, is indeed an image.
	if (empty($imgInfo['mime']) || strpos($imgInfo['mime'], 'image/') !== 0) {
		pmp_Logging("$logName", "Invalid Image: $mediaUrl \n\t Check mimetype.");
		// die('Invalid Image');
		echo "Invalid Image<br>";
		return "InvalidImage";
	}

	// Create base64 version of image
	$imgBase64 = base64_encode($imgRaw);

	// Return Base64
	return $imgBase64;
}


?>
