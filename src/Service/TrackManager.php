<?php


namespace App\Service;


use App\Entity\Media\MediumInterface;
use App\Gateway\TrackGateway;

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
    }
}