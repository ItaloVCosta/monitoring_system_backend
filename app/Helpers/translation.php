<?php

function __($key, array $attributes = [])
{
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

    if (is_string($translations)) {
        foreach ($attributes as $placeholder => $value) {
            $translations = str_replace(":$placeholder", $value, $translations);
        }
    }

    return is_string($translations) ? $translations : $key; 
}
