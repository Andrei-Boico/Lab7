<?php

function getData($file = "data.json") {
    return file_exists($file)
        ? json_decode(file_get_contents($file), true)
        : [];
}

function saveData($data, $file = "data.json") {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}