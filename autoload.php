<?php
spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . '/src/'; 
    $relativePath = str_replace('App\\', '', $className); 
    $filePath = $baseDir . str_replace('\\', '/', $relativePath) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    } else {
        echo "Autoload failed: $filePath not found.\n";
    }
});