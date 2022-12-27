<?php

function redirect($path) {
    if($path[0] !== '/') {
        $path = '/' . $path;
    }
    header('location: ' . URLROOT . $path);
}


