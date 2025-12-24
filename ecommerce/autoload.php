<?php 
// Fix: Correct autoloader comparison operator and add missing semicolon
spl_autoload_register(function (string $class) {
    $prefix = 'App\\';

    $baseDir = __DIR__ . '/app/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
?>