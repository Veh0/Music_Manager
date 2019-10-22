<?php


namespace App\Service\Export\Generator;


use App\Service\Export\ExportManagerException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class ExportToXlsGenerator extends  AbstractExportGenerator
{
    /**
     * @param array $criteria
     * @return bool
     */
    public function doesHandle(array $criteria): bool
    {
        return !empty($criteria["format"] == "xls");
    }

    /**
     * @param array $criteria
     * @return mixed|void
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function generate(array $criteria)
    {
        $fetchTracks = $this->trackGateway->fetchAllTracks();

        $data = $this->formatData($fetchTracks);

        $filename = 'tracks.xls';

        if ($data)
        {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Title')
                ->setCellValue('B1', 'Album')
                ->setCellValue('C1', 'Artist')
                ->setCellValue('D1', 'Duration')
                ->setCellValue('E1', 'Media');

            $firstCellsStyle = [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['bottom' => ['styles' => Border::BORDER_MEDIUM]]
            ];
            $spreadsheet->getActiveSheet()->getStyle('A1:E1')->applyFromArray($firstCellsStyle);

            $i = 2;

            foreach ($data as $datum) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $datum["title"])
                    ->setCellValue('B'.$i, $datum["album"])
                    ->setCellValue('C'.$i, $datum["artist"])
                    ->setCellValue('D'.$i, $datum["duration"])
                    ->setCellValue('E'.$i, $datum["media"]);

                $i++;
            }

            $writer = new Xls($spreadsheet);
            return $writer;
        }


        //$writer->save($filename);

        throw new Exception();
    }

}