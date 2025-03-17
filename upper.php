<?php
function upperHTML($css_name, $js_name) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Pin Login</title>
        <link rel="stylesheet" href="css/' . $css_name .'.css">
        <script src="js/' . $js_name . '.js" defer></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=League+Gothic:wdth@87.5&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>';
}
?>
