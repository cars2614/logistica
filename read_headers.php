<?php
require __DIR__.'/vendor/autoload.php';

$inputFileName = __DIR__.'/public/templates/plantilla_guias.xlsx';

if (!file_exists($inputFileName)) {
    echo "File not found.";
    exit;
}

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($inputFileName);
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load($inputFileName);
$worksheet = $spreadsheet->getActiveSheet();
$firstRow = [];
foreach ($worksheet->getRowIterator(1, 1) as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false); 
    foreach ($cellIterator as $cell) {
        $firstRow[] = $cell->getValue();
    }
}
print_r($firstRow);
