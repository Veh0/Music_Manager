<?php


namespace App\Service\Playlist\Generator;


use App\Gateway\TrackGateway;

abstract class AbstractPlaylistGenerator implements PlaylistGeneratorInterface
{

    /** @var TrackGateway */
    protected $playlistGateway;

    /**
     * AbstractPlaylistGenerator constructor.
     * @param TrackGateway $playlistGateway
     */
    public function __construct(TrackGateway $playlistGateway)
    {
        $this->setPlaylistGateway($playlistGateway);
    }

    /**
     * @return TrackGateway
     */
    public function getPlaylistGateway(): TrackGateway
    {
        return $this->playlistGateway;
    }

    /**
     * @param TrackGateway $playlistGateway
     */
    public function setPlaylistGateway(TrackGateway $playlistGateway): void
    {
        $this->playlistGateway = $playlistGateway;
    }

}
