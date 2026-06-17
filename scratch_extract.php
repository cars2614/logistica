<?php
$bladePath = 'C:\\Users\\ASUS\\Desktop\\logistica\\resources\\views\\admin\\dashboard.blade.php';
$cssPath = 'C:\\Users\\ASUS\\Desktop\\logistica\\public\\css\\responsive.css';

$lines = file($bladePath);
$inStyle = false;
$styleContent = [];
$newBladeContent = [];

foreach ($lines as $line) {
    if (strpos($line, '<style>') !== false) {
        $inStyle = true;
        $newBladeContent[] = '<link rel="stylesheet" href="{{ asset(\'css/responsive.css\') }}?v={{ time() }}">' . PHP_EOL;
        continue;
    }
    if (strpos($line, '</style>') !== false) {
        $inStyle = false;
        continue;
    }
    if ($inStyle) {
        $styleContent[] = $line;
    } else {
        $newBladeContent[] = $line;
    }
}

file_put_contents($cssPath, PHP_EOL . '/* Estilos del Dashboard Extraidos */' . PHP_EOL . implode('', $styleContent), FILE_APPEND);
file_put_contents($bladePath, implode('', $newBladeContent));

echo 'CSS extracted successfully.';
