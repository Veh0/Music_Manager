<?php


namespace App\Service;


use App\Entity\Media\MediumInterface;
use App\Gateway\TrackGateway;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class TrackManager
{
    /** @var TrackGateway */
    protected $trackGateway;

    public function __construct(TrackGateway $trackGateway)
    {
        $this->trackGateway = $trackGateway;
    }

    /**
     * @param string $title
     * @return MediumInterface[]|null
     */
    public function getTrackMedia(string $title): ?array
    {
        return $this->trackGateway->fetchMediaByTrackTitle($title);
    }

    public function exportToCsv()
    {
        $fetchTracks = $this->trackGateway->fetchAll();

        $fp = fopen('tracks.csv', 'w');

        foreach ($fetchTracks as $track)
        {
            fputcsv($fp, (array) $track);
        }

        fclose($fp);
    }

    public function exportToXls()
    {
        $fetchTracks = $this->trackGateway->fetchAll();

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
        try {
            $spreadsheet->getActiveSheet()->getStyle('A1:E1')->applyFromArray($firstCellsStyle);
        } catch (Exception $e) {
        }

        $i = 2;

        foreach ($fetchTracks as $track)
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

        $writer = new Xls($spreadsheet);
        $writer->save($filename);
    }
}