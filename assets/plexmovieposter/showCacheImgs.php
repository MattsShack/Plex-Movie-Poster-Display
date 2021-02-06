<?php

$source = "../../cache/posters/";
$images = glob($source."*");
foreach($images as $image) {
    echo '<img style="max-width: 250px; height: auto;" src="'.$image.'" />';
}

