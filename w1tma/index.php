<?php
require_once('includes/functions.php');
require_once 'includes/config.php';
require_once 'languages/' . $config['language'] . '.php';

if (!isset($_GET['page'])) {
    $id = 'home';
} else {
    
    $id = $_GET['page'];
}
$heading = '';
$content = '';


switch ($id) {
    case 'home':
        include 'views/home.php';
        break;
    case 'artists':
        include 'views/artists.php';
        break;
    case 'songs':
        include 'views/songs.php';
        break;
    default:
        include 'views/404.php';
}

$allHeader = 'templates/header.html';
$tpl       = file_get_contents($allHeader);
$keys[]    = '[+pageTitle+]';
$keys[]    = '[+heading+]';
$keys[]    = '[+content+]';
$values[]  = $PAGE_TITLE;
$values[]  = $heading;
$values[]  = $content;
$content   = str_replace($keys, $values, $tpl);
echo ($content);

include('includes/footer.php');
?>