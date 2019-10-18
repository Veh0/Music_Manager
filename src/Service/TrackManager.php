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
    use ExportTrait;

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

    /**
     * @param string $file
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * Create a file which contains all Track
     */
    public function export(string $file)
    {
        $fetchTracks = $this->trackGateway->fetchAll();

        switch (true)
        {
            case $file == 'csv':
                $this->toCsv($fetchTracks);
                break;
            case $file == 'xls':
                $this->toXls($fetchTracks);
                break;
        }
    }
}