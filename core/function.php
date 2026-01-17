<?php

function layout(string $name): void
{
    $path = LAYOUT_PATH . '/' . $name . '.php';

    if (file_exists($path)) {
        require $path;
    } else {
        echo "Layout $name not found";
    }
}

function url_css(){
    if (!function_exists('css')) {
        function css(string $file): void
        {
            echo '<link rel="stylesheet" href="' . BASE_URL . 'public/css/' . $file . '">';
        }
    }
}


?>