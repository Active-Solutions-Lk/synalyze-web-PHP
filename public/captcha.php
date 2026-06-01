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

header('Content-Type: image/svg+xml');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<svg width="<?= $width ?>" height="<?= $height ?>" viewBox="0 0 <?= $width ?> <?= $height ?>" xmlns="http://www.w3.org/2000/svg">
    <!-- Background -->
    <rect width="<?= $width ?>" height="<?= $height ?>" fill="#ffffff" />
    
    <!-- Grid Lines (Noise) -->
    <?php for ($i = 0; $i < 10; $i++): ?>
        <line x1="<?= rand(0, $width) ?>" y1="0" x2="<?= rand(0, $width) ?>" y2="<?= $height ?>" stroke="rgba(0,0,0,0.15)" stroke-width="<?= rand(1, 3) ?>" />
        <line x1="0" y1="<?= rand(0, $height) ?>" x2="<?= $width ?>" y2="<?= rand(0, $height) ?>" stroke="rgba(0,0,0,0.15)" stroke-width="<?= rand(1, 3) ?>" />
    <?php endfor; ?>

    <!-- Noise Dots -->
    <?php for ($i = 0; $i < 40; $i++): ?>
        <circle cx="<?= rand(0, $width) ?>" cy="<?= rand(0, $height) ?>" r="<?= rand(1, 3) ?>" fill="rgba(0,0,0,0.2)" />
    <?php endfor; ?>

    <!-- Text -->
    <?php 
    for ($i = 0; $i < strlen($captcha_text); $i++) {
        $x = 20 + ($i * 26) + rand(-4, 4);
        $y = 40 + rand(-5, 5);
        $rotation = rand(-20, 20);
        $fontSize = rand(26, 32);
        $color = 'rgba('.rand(0, 150).','.rand(0, 150).','.rand(0, 150).',1)';
        ?>
        <text x="<?= $x ?>" y="<?= $y ?>" font-family="monospace, sans-serif" font-size="<?= $fontSize ?>" font-weight="bold" fill="<?= $color ?>" transform="rotate(<?= $rotation ?> <?= $x ?> <?= $y ?>)">
            <?= $captcha_text[$i] ?>
        </text>
        <?php
    }
    ?>
</svg>
