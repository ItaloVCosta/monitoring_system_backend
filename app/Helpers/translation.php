<?php

function __($key) {
    $config = require __DIR__ . '/../../config/language.php';
    $language = $config['default'];
    
    $segments = explode('.', $key);
    $file = array_shift($segments);
    
    $filePath = __DIR__ . "/../../translations/{$language}/{$file}.php";
    
    if (!file_exists($filePath)) {
        return $key;
    }
    
    $translations = require $filePath;
    
    foreach ($segments as $segment) {
        if (isset($translations[$segment])) {
            $translations = $translations[$segment];
        } else {
            return $key;
        }
    }

    return is_string($translations) ? $translations : $key;
}
