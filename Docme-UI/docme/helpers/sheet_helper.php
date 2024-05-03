<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'Spreadsheet/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function multi_sheet_report($data, $file_name = 'Report')
{
    if (!empty($data)) {
        $spreadsheet = new Spreadsheet();
        $main_array = array_keys($data);
        $i = 0;
        foreach ($main_array as $key) {
            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex($i);
            $spreadsheet->getActiveSheet()->setTitle($key);
            $sheet = $spreadsheet->getActiveSheet();
            if (!empty($data[$key])) {
                $formatted_array = columnIndexValue($data[$key]);
                $column_array    = array_keys($formatted_array[1]);
                foreach ($formatted_array  as $key => $value) {
                    foreach ($column_array as $column) {
                        if ($key == 1) {
                            $sheet->getStyle($column . ($key))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                        }
                        $sheet->getColumnDimension($column)->setAutoSize(true);
                        $sheet->setCellValue($column . $key, strtoupper($value[$column]));
                    }
                }
            }
            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename_report = strtoupper($file_name) . '_' . date('dmY') . '.xlsx';
        if (!is_dir(FCPATH . 'reports/sheets')) {
            mkdir(FCPATH . 'reports/sheets');
        }
        $filename = FCPATH . 'reports/sheets/' . $filename_report;

        $writer->save($filename);
        return $filename_report;
    }
}
function get_excel_report($data, $filename_a = 'excel_report', $collectiondate = '', $total_array = '')
{
    $CI = get_instance();
    $styleArray = [
        'font' => [
            'bold' => true,
        ],
    ];
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Institution Name');
    $sheet->getStyle('A1')->applyFromArray($styleArray);
    $sheet->mergeCells('B1:D1');
    $sheet->setCellValue('B1', $CI->session->userdata('Institution_Name') . ',' . $CI->session->userdata('Institution_Place'));
    $sheet->setCellValue('A2', 'Report Name');

    $sheet->setCellValue('B2', str_replace('_', ' ', strtoupper($filename_a)));
    $sheet->getStyle('A2')->applyFromArray($styleArray);
    //print_r($collectiondate);exit;
    if (isset($collectiondate) && ($collectiondate != "")) {
        $check_name = explode(":", $collectiondate);
        if (count($check_name) > 1) {
            $sheet->setCellValue('A3', $check_name[0]);
            $sheet->setCellValue('B3', $check_name[1]);
            $sheet->getStyle('A3')->applyFromArray($styleArray);
        } else {
            $sheet->setCellValue('A3', 'Report Date');
            $sheet->setCellValue('B3', $collectiondate);
            $sheet->getStyle('A3')->applyFromArray($styleArray);
        }
    } else {
        $sheet->setCellValue('A3', 'Report Date');
        $sheet->setCellValue('B3', date('d-m-Y'));
        $sheet->getStyle('A3')->applyFromArray($styleArray);
    }

    if (!empty($data)) {
        $formatted_array = columnIndexValue($data);
        $column_array = array_keys($formatted_array[1]);
        foreach ($formatted_array  as $key => $value) {
            foreach ($column_array as $column) {
                if ($key == 1) {
                    $sheet->getStyle($column . ($key + 4))->applyFromArray($styleArray);
                    $sheet->getStyle($column . ($key + 4))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $sheet->setCellValue($column . ($key + 4), str_replace('_', ' ', strtoupper($value[$column])));
                } else {
                    $sheet->setCellValue($column . ($key + 4), strtoupper($value[$column]));
                }
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }
            $data['key_set'] = $key;
        }

        if (!empty($total_array) && ($total_array)) {
            $count_arr = count($column_array);
            $find_cell = $count_arr - 3;
            $index_array = columnIndex();
            $key_val = $data['key_set'] + 1;
            foreach ($total_array as $tarr => $value_arr) {
                $i = 1;
                $j = 2;
                // $sheet->mergeCells('B1:D1');
                $ret = 'A' . ($key_val + 4) . ":" . $index_array[$find_cell]  . ($key_val + 4);
                $sheet->mergeCells($ret);
                $sheet->getStyle($ret)->applyFromArray($styleArray);
                $sheet->getStyle('A' . ($key_val + 4))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue('A' . ($key_val + 4), str_replace('_', ' ', strtoupper($tarr)));
                $sheet->mergeCells($index_array[$find_cell + $i]  . ($key_val + 4) . ":" . $index_array[$find_cell + $j]  . ($key_val + 4));
                $sheet->getStyle($index_array[$find_cell + $i]  . ($key_val + 4))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue($index_array[$find_cell + $i]  . ($key_val + 4), $value_arr);
                $key_val++;
            }
        }
        $writer = new Xlsx($spreadsheet);
        $filename_report = strtoupper($filename_a) . '_' . rand(1, 100) . '_' . date('dmY') . '.xlsx';
        if (!is_dir(FCPATH . 'reports/sheets')) {
            mkdir(FCPATH . 'reports/sheets');
        }
        $filename = FCPATH . 'reports/sheets/' . $filename_report;

        $writer->save($filename);
        return $filename_report;
    }
}

function multi_sheet_template_report($data, $file_name = 'Report', $template_name)
{
    if (!empty($data)) {
        $temlate_path = FCPATH . 'assets/excel_templates/' . $template_name . '.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($temlate_path);
        $main_array = array_keys($data);
        $i = 0;
        foreach ($main_array as $key) {
            //$spreadsheet->getSheetByName($key);
            //$spreadsheet->getActiveSheet()->setTitle($key);
            $sheet = $spreadsheet->getSheetByName($key);
            //$sheet = $spreadsheet->getActiveSheet();
            if (!empty($data[$key])) {
                $formatted_array = columnIndexValue($data[$key]);
                $column_array = array_keys($formatted_array[1]);
                foreach ($formatted_array  as $key => $value) {
                    foreach ($column_array as $column) {
                        if ($key != 1) {
                            // $sheet->getStyle($column . ($key + 2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                            // $sheet->getColumnDimension($column)->setAutoSize(true);
                            $sheet->setCellValue($column . ($key + 1), strtoupper($value[$column]));
                        }
                    }
                }
            }
            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename_report = strtoupper($file_name) . '_' . date('dmY') . '.xlsx';
        if (!is_dir(FCPATH . 'reports/sheets')) {
            mkdir(FCPATH . 'reports/sheets');
        }
        $filename = FCPATH . 'reports/sheets/' . $filename_report;

        $writer->save($filename);
        return $filename_report;
    }
}

function get_excel_report_dynamic($data, $filename_a = 'excel_report', $collectiondate = '', $total_array = '')
{
    $CI = get_instance();
    $styleArray = [
        'font' => [
            'bold' => true,
        ],
    ];
    $spreadsheet = new Spreadsheet();
    $main_array = array_keys($data);
    $itab = 0;
    foreach ($main_array as $key) {
        $data_key = $key;
        $spreadsheet->createSheet();
        $spreadsheet->setActiveSheetIndex($itab);
        $spreadsheet->getActiveSheet()->setTitle(strtoupper($key));
        $sheet = $spreadsheet->getActiveSheet();
        //  if($i==0){
        $sheet->setCellValue('A1', 'Institution Name');
        $sheet->getStyle('A1')->applyFromArray($styleArray);
        $sheet->mergeCells('B1:D1');
        $sheet->setCellValue('B1', $CI->session->userdata('Institution_Name') . ',' . $CI->session->userdata('Institution_Place'));
        $sheet->setCellValue('A2', 'Report Name');
        $sheet->setCellValue('B2', str_replace('_', ' ', strtoupper($filename_a)));
        $sheet->getStyle('A2')->applyFromArray($styleArray);
        if (isset($collectiondate) && ($collectiondate != "")) {
            $check_name = explode(":", $collectiondate);
            if (count($check_name) > 1) {
                $sheet->setCellValue('A3', $check_name[0]);
                $sheet->setCellValue('B3', $check_name[1]);
                $sheet->getStyle('A3')->applyFromArray($styleArray);
            } else {
                $sheet->setCellValue('A3', 'Report Date');
                $sheet->setCellValue('B3', $collectiondate);
                $sheet->getStyle('A3')->applyFromArray($styleArray);
            }
        }

        //  }
        if (!empty($data[$key])) {

            $formatted_array = columnIndexValue($data[$key]);
            $column_array = array_keys($formatted_array[1]);
            foreach ($formatted_array  as $key => $value) {
                foreach ($column_array as $column) {
                    if ($key == 1) {
                        $sheet->getStyle($column . ($key + 4))->applyFromArray($styleArray);
                        $sheet->getStyle($column . ($key + 4))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    }
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                    $sheet->setCellValue($column . ($key + 4), strtoupper($value[$column]));
                }
                $data['key_set'] = $key;
            }
        }
        if (!empty($total_array[$data_key])) {
            $count_arr = count($column_array);
            $find_cell = $count_arr - 3;
            $index_array = columnIndex();
            $key_val = $data['key_set'] + 1;
            foreach ($total_array[$data_key] as $tarr => $value_arr) {
                $i = 1;
                $j = 2;
                // $sheet->mergeCells('B1:D1');
                $ret = 'A' . ($key_val + 4) . ":" . $index_array[$find_cell]  . ($key_val + 4);
                $sheet->mergeCells($ret);
                $sheet->getStyle($ret)->applyFromArray($styleArray);
                $sheet->getStyle('A' . ($key_val + 4))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue('A' . ($key_val + 4), str_replace('_', ' ', strtoupper($tarr)));
                $sheet->mergeCells($index_array[$find_cell + $i]  . ($key_val + 4) . ":" . $index_array[$find_cell + $j]  . ($key_val + 4));
                $sheet->getStyle($index_array[$find_cell + $i]  . ($key_val + 4))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue($index_array[$find_cell + $i]  . ($key_val + 4), $value_arr);
                $key_val++;
            }
        }
        $itab++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename_report = strtoupper($filename_a) . '_' . rand(1, 100) . '_' . date('dmY') . '.xlsx';
    if (!is_dir(FCPATH . 'reports/sheets')) {
        mkdir(FCPATH . 'reports/sheets');
    }
    $filename = FCPATH . 'reports/sheets/' . $filename_report;

    $writer->save($filename);
    return $filename_report;
}

function columnIndexValue($data)
{
    $index = columnIndex();
    $i = 0;
    $heading_array = array_keys($data[0]);
    foreach ($heading_array as $heading) {
        $format[1][$index[$i]] =  $heading;
        $i++;
    }
    $j = 2;
    $k = 0;
    foreach ($data as $value) {
        $k = 0;
        foreach ($heading_array as $index_value) {
            $format[$j][$index[$k]] = $value[$index_value];
            $k++;
        }
        $j++;
    }
    return $format;
}
function columnIndex()
{
    $alpha = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
        'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ'
    ];
    return $alpha;
}
