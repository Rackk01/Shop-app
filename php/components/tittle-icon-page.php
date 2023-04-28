<!-- Tittle -->
<title><?php echo getTittlePest(); ?></title>
<!-- Favicon -->
<?php
$url = '';
if (file_exists(getSquareLogo())) {
    $url = getSquareLogo();
} else {
    $url = '../'.getSquareLogo();
}
?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $url; ?>" />