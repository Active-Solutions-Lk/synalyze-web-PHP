<?php
session_start();

$chars = "ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789";
$captcha_text = '';
for ($i = 0; $i < 6; $i++) {
    $captcha_text .= $chars[rand(0, strlen($chars) - 1)];
}
$_SESSION['captcha'] = $captcha_text;

$width = 200;
$height = 60;
$image = imagecreatetruecolor($width, $height);

$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocatealpha($image, 0, 0, 0, 100);
$dot_color = imagecolorallocatealpha($image, 0, 0, 0, 90);

imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// Draw grid lines
for ($i = 0; $i < 6; $i++) {
    imageline($image, rand(0, $width), 0, rand(0, $width), $height, $line_color);
    imageline($image, 0, rand(0, $height), $width, rand(0, $height), $line_color);
}

// Draw noise dots
for ($i = 0; $i < 40; $i++) {
    imagefilledellipse($image, rand(0, $width), rand(0, $height), 3, 3, $dot_color);
}

// Draw text
// Note: imagettftext requires a TTF font file. For simplicity, we use imagestring or basic GD text if TTF is not available.
// The NextJS project used Canvas, so we will try to make it look decent with GD's imagestring if no TTF.
for ($i = 0; $i < strlen($captcha_text); $i++) {
    $x = ($width / 7) * ($i + 1) + rand(-3, 3);
    $y = ($height / 2) - 10 + rand(-5, 5);
    imagestring($image, 5, $x, $y, $captcha_text[$i], $text_color);
}

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
