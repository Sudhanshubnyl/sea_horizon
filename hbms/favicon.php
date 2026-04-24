<?php

/**
 * favicon.php — PHP GD library generates hotel favicon dynamically
 * Link in <head>: <link rel="icon" type="image/png" href="favicon.php">
 */
header('Content-Type: image/png');
header('Cache-Control: public, max-age=86400');

$size = 64;
$im = imagecreatetruecolor($size, $size);
imagesavealpha($im, true);
$transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);
imagefill($im, 0, 0, $transparent);

$bg    = imagecolorallocate($im, 129, 88, 84);   // #815854
$white = imagecolorallocate($im, 255, 255, 255);
$light = imagecolorallocate($im, 240, 213, 192);  // #F0D5C0

// Rounded background square
$r = 12;
imagefilledrectangle($im, $r, 0, $size - $r, $size, $bg);
imagefilledrectangle($im, 0, $r, $size, $size - $r, $bg);
imagefilledellipse($im, $r,       $r,       $r * 2, $r * 2, $bg);
imagefilledellipse($im, $size - $r, $r,       $r * 2, $r * 2, $bg);
imagefilledellipse($im, $r,       $size - $r, $r * 2, $r * 2, $bg);
imagefilledellipse($im, $size - $r, $size - $r, $r * 2, $r * 2, $bg);

// Hotel building body
imagefilledrectangle($im, 14, 26, 50, 52, $white);
imagefilledrectangle($im, 22, 18, 42, 26, $white);
// Roof peak
imagefilledpolygon($im, [32, 10, 22, 18, 42, 18], 3, $light);
// Floor separator
imagefilledrectangle($im, 14, 25, 50, 27, $light);
// Windows
imagefilledrectangle($im, 17, 32, 26, 42, $light);
imagefilledrectangle($im, 38, 32, 47, 42, $light);
// Door
imagefilledrectangle($im, 28, 40, 36, 52, $light);
// Base
imagefilledrectangle($im, 10, 52, 54, 54, $white);

imagepng($im);
imagedestroy($im);
