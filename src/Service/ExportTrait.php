<?php


namespace App\Service;


use App\Entity\Track\TrackInterface;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

trait ExportTrait
{
    /**
     * @param TrackInterface[] $fetch
     */
    public function toCsv(array $fetch) {
        $fp = fopen('tracks.csv', 'w');

        foreach ($fetch as $track)
        {
            fputcsv($fp, (array) $track);
        }

        fclose($fp);
    }

    /**
     * @param TrackInterface[] $fetch
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function toXls(array $fetch)
    {
        $filename = 'tracks.xls';

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

        foreach ($fetch as $track)
        {
            $media = $track->getMedia();
            foreach ($media as $medium)
            {
                $arrayMedia[] = $medium->getType();
            }
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $track->getTitle())
                ->setCellValue('B'.$i, $track->getAlbum()->getTitle())
                ->setCellValue('C'.$i, $track->getArtist()->getName())
                ->setCellValue('D'.$i, $track->getDuration())
                ->setCellValue('E'.$i,implode(" / ", $arrayMedia));

            $i++;
            $arrayMedia = [];
        }

        $writer = new Xls($spreadsheet);
        $writer->save($filename);
    }
}