<?php

echo "Thumb (Posters):<br><br>";

$source = "../../cache/posters/";
$images = glob($source."*");
foreach($images as $image) {
    echo '<img style="max-width: 250px; height: auto;" src="'.$image.'" />';
}

echo "<br><br>";
echo "Art (Background):<br><br>";

$source = "../../cache/art/";
$images = glob($source."*");
foreach($images as $image) {
    echo '<img style="max-width: 250px; height: auto;" src="'.$image.'" />';
}

