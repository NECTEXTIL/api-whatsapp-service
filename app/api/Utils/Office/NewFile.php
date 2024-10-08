<?php

namespace App\Utils\Office;

use App\Utils\Utils;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class NewFile
{
    private $type;

    function __construct($type = null)
    {
        $this->type = $type;
    }

    public static  function Excel($proveedores, $Ctx)
    {
        // Crear un nuevo documento de hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet_data = array();
        $data = array();
        $codigo_evaluacion = 'No Data';
        $text = '';

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_BLACK],
                'size' => 16, // Tamaño del texto
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        $titulo = ['RESULTADOS DE EVALUACIÓN CONVOCATORIA '];


        // Definir los datos de la tabla
        $headers = [
            [
                'ITEM', 'N CONVOCATORIA', 'FECHA DE CONVOCATORIA', 'COD DE EVALUACIÓN', 'NOMBRE EVALUACIÓN', 'CODIGO DE EXPEDIENTE',//'NUMERO DE EXPEDIENTE',
                 'NOMBRE DEL BIEN',
                'CODIGO INSUMO', 'INSUMO', 'RUC', 'NOMBRE / RAZÓN SOCIAL', 'DISTRITO', 'PROVINCIA', 'DEPARTAMENTO REGIÓN',
                'E.Documenta', 'E. de Muestra', 'M. Cumplimineto Tec.',//'C. de Calidad', 'M. Fisica',
                'P. Entrega', 'Stock MP', 'C. de Maquinaria', 'Experiencia', 'Precio Of.','Moneda', 'Puntaje (PI)', 'P. Total', 'Obs. Documental',
                'Obs. M. Cert. C', 'Obs. M Física', 'Obs. P Entrega', 'Obs. Stock MP', 'Obs. C Maquinaria', 'Obs. E. Igual Similar', 'Obs. Precio Of'
            ],
        ];

        foreach ($proveedores as $key => $v) {
            $codigo_evaluacion = "{$v['nombre_convocatoria']}";
            $text = $v['nombre_convocatoria'];
            $data[] = [
                ($key + 1),
                $v['nombre_convocatoria'], $v['fecha_convocatoria'], $v['codigo_evaluacion'], $v['nombre_evaluacion'], $v['codigo_expediente'],// $v['numero_expediente'],
                 $v['nombre_bien'],
                $v['codigo_insumo'], $v['nombre_insumo'], $v['ruc'], $v['empresa_razon_social'], $v['distrito'], $v['provincia'], $v['departamento'],

                $v['evaluacion_documentaria'], $v['muestra_fisica'], $v['certificado_calidad'], $v['muestra_fisica'],
                $v['plazo_entrega'], $v['stock_materia_prima'], $v['capacidad_maquinaria'], $v['experiencia_bienes_igual_similar'],
                $v['precio_ofertado'], $v['moneda'], $v['puntaje_pi'],$v['puntaje_total'], $v['comentario_documentaria'],
                $v['comentario_m_cert_calidad'],
                $v['comentario_muestra_fisica'],
                $v['comentario_plazo_entrega'],
                $v['comentario_stock_m_prima'],
                $v['comentario_c_maquinaria'],
                $v['comentario_e_igual_similar'],
                $v['comentario_precio_ofertado'],
            ];
        }

        // nombre del sheet conbinado
        $sheet->mergeCells('I1:Z2');
        $sheet->setCellValue(
            'I1',
            $titulo[0] . mb_strtoupper($text),
        );
        $sheet->getStyle('I1:Z2')->applyFromArray($headerStyle);
        // Agregar imagen
        $img_path = dirname(__FILE__) . "/../../../..$Ctx->logo_empresa";
        if (file_exists("$img_path")) {
            $drawing = new Drawing();
            $drawing->setName('Image');
            $drawing->setDescription('Image Description');
            $drawing->setPath($img_path);
            $drawing->setCoordinates('W1');
            $drawing->setOffsetX(5);
            $drawing->setOffsetY(5);
            $drawing->setWidth(248);
            $drawing->setHeight(48);
            $sheet->getRowDimension(1)->setRowHeight(34);
            $sheet->getDrawingCollection()->offsetSet('W1', $drawing);
        }
        //
        $sheet_data = array_merge($headers, $data);
        // Escribir los datos en la hoja de cálculo, comenzando en B2
        $startColumn = 'B';
        $startCol = 2;
        $startRow = 3;
        // Escribir los datos en la hoja de cálculo
        foreach ($sheet_data as $rowIndex => $row) {
            foreach ($row as $colIndex => $cellValue) {
                $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + $startCol);
                $sheet->setCellValue($columnLetter . ($rowIndex  + $startRow), $cellValue);
            }
        }
        // Estilo para el encabezado de la tabla
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => Color::COLOR_BLACK],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '305496'],
            ],
        ];

        // Aplicar estilo al encabezado
        $sheet->getStyle('B3:AH3')->applyFromArray($headerStyle);

        // Autoajustar el ancho de las columnas
        foreach (generateColumnRange('B', 'AH') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $borderStyle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => Color::COLOR_BLACK],
                ],
            ],
        ];

        $sheet->getStyle('B3:AH' . ($startRow + count($sheet_data) - 1))->applyFromArray($borderStyle);

        // Definir la ruta donde se guardará el archivo
        $path = dirname(__FILE__) . "/../../../../public/docs/excel/temp";
        $filename = "{$codigo_evaluacion}_" . Utils::DateTime('Y-m-d H.i.s') . ".xlsx";
        $file = "$path/$filename";
        // Verificar si el directorio existe y si no, crearlo
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // Guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save($file);

        //
        $base64 = '';
        if (file_exists($file)) {
            // Leer el contenido del archivo
            $fileContent = file_get_contents($file);

            // Codificar el contenido en base64
            $base64 = base64_encode($fileContent);
            Utils::eliminarCarpetaArchivos($path);
        }
        return (object)[
            "nombre" => $filename,
            "url" => "/public/docs/excel/temp/$filename",
            "data" => $base64
        ];
    }
}

function generateColumnRange($start, $end)
{
    $columns = [];
    $current = $start;

    while ($current !== $end) {
        $columns[] = $current;
        $current = incrementColumn($current);
    }
    $columns[] = $end; // agregar el último valor (end)
    return $columns;
}

// Función para incrementar una columna de Excel
function incrementColumn($column)
{
    $length = strlen($column);
    $index = $length - 1;
    while ($index >= 0) {
        if ($column[$index] !== 'Z') {
            $column[$index] = chr(ord($column[$index]) + 1);
            break;
        } else {
            $column[$index] = 'A';
            if ($index === 0) {
                $column = 'A' . $column;
                break;
            } else {
                $index--;
            }
        }
    }
    return $column;
}
