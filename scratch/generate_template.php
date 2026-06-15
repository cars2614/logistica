<?php
require __DIR__ . '/../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!is_dir(__DIR__ . '/../public/templates')) {
    mkdir(__DIR__ . '/../public/templates', 0777, true);
}

$s = new Spreadsheet();
$sh = $s->getActiveSheet();
$h = ['A1'=>'cedula_origen', 'B1'=>'nombre_origen', 'C1'=>'telefono_origen', 'D1'=>'direccion_origen', 'E1'=>'cedula_destino', 'F1'=>'nombre_destino', 'G1'=>'telefono_destino', 'H1'=>'direccion_destino', 'I1'=>'piezas', 'J1'=>'peso', 'K1'=>'largo', 'L1'=>'ancho', 'M1'=>'alto', 'N1'=>'precio_envio', 'O1'=>'valor_declarado', 'P1'=>'observacion'];
foreach ($h as $c => $v) {
    $sh->setCellValue($c, $v);
}
$sh->getStyle('A1:P1')->getFont()->setBold(true);
$w = new Xlsx($s);
$w->save(__DIR__ . '/../public/templates/plantilla_guias.xlsx');
echo 'Template generated successfully.';
