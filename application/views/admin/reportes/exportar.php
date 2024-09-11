<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('ADMIN');
$spreadsheet->getProperties()->setTitle('Turnos');

// Establecer la hoja activa
$spreadsheet->setActiveSheetIndex(0);
$hojaActiva = $spreadsheet->getActiveSheet();

// Definir estilos
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => '00000000'],
        ]
    ]
];

$styleArrayBold = [
    'font' => [
        'bold' => true,
    ]
];

// Agregar encabezados con estilos
$hojaActiva->setCellValue('A1', 'FECHATURNO')->getStyle('A1')->applyFromArray($styleArrayBold);
$hojaActiva->setCellValue('B1', 'HORATURNO')->getStyle('B1')->applyFromArray($styleArrayBold);
$hojaActiva->setCellValue('C1', 'PACIENTETURNO')->getStyle('C1')->applyFromArray($styleArrayBold);
$hojaActiva->setCellValue('D1', 'WHATSAPP')->getStyle('D1')->applyFromArray($styleArrayBold);
$hojaActiva->setCellValue('E1', 'ESPECIALIDADTURNO')->getStyle('E1')->applyFromArray($styleArrayBold);
$hojaActiva->setCellValue('F1', 'PROFESIONALTURNO')->getStyle('F1')->applyFromArray($styleArrayBold);

$fila = 2;

// Agregar datos y aplicar estilos a las filas
if (!empty($turnos)) {
    foreach ($turnos as $row) {
        $hojaActiva->setCellValue('A' . $fila, $row->FECHATURNO);
        $hojaActiva->setCellValue('B' . $fila, $row->HORATURNO);
        $hojaActiva->setCellValue('C' . $fila, $row->PACIENTETURNO);
        $hojaActiva->setCellValue('D' . $fila, $row->WHATSAPP);
        $hojaActiva->setCellValue('E' . $fila, $row->ESPECIALIDADTURNO);
        $hojaActiva->setCellValue('F' . $fila, $row->PROFESIONALTURNO);

        // Aplicar estilos a la fila
        $hojaActiva->getStyle('A' . $fila . ':F' . $fila)->applyFromArray($styleArray);
        $hojaActiva->getStyle('D' . $fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_TEXT);

        $fila++;
    }
}

// Aplicar estilos a los encabezados
$hojaActiva->getStyle('A1:F1')->applyFromArray($styleArray);

// Ajustar el tamaño de las columnas
$columns = range('A', 'F');
foreach ($columns as $column) {
    $hojaActiva->getColumnDimension($column)->setAutoSize(true);
}

// Preparar el archivo para la descarga
$fileName = 'Turnos_' . $fecha . '.xlsx';

// Enviar encabezados HTTP para la descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

// Guardar el archivo en el flujo de salida (directamente en la descarga)
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

// Terminar el script
exit;
?>
