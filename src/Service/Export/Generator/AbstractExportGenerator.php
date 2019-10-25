<?php


namespace App\Service\Export\Generator;


use App\Entity\Track\TrackInterface;
use App\Gateway\TrackGateway;

abstract class AbstractExportGenerator implements ExportGeneratorInterface
{
    /**
     * @var TrackGateway
     */
    protected $trackGateway;

    /**
     * AbstractExportGenerator constructor.
     * @param TrackGateway $trackGateway
     */
    public function __construct(TrackGateway $trackGateway)
    {
        $this->setTrackGateway($trackGateway);
    }

    /**
     * @return TrackGateway
     */
    public function getTrackGateway(): TrackGateway
    {
        return $this->trackGateway;
    }

    /**
     * @param TrackGateway $trackGateway
     */
    public function setTrackGateway(TrackGateway $trackGateway): void
    {
        $this->trackGateway = $trackGateway;
    }

    public function formatData(array $fetchTracks): ? array
    {
        foreach ($fetchTracks as $track)
        {
            $media = $track->getMedia();
            foreach ($media as $medium)
            {
                $arrayMedia[] = $medium->getType();
            }
            $data[] = array(
                "title" => $track->getTitle(),
                "album" => $track->getAlbum()->getTitle(),
                "artist" => $track->getArtist()->getName(),
                "duration" => $track->getDuration(),
                "media" => implode("/", $arrayMedia)
            );
            $arrayMedia = [];
        }

        return $data;
    }
}
