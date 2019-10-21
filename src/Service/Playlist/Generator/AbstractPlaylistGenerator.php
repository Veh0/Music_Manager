<?php


namespace App\Service\Playlist\Generator;


use App\Gateway\PlaylistGateway;

abstract class AbstractPlaylistGenerator implements PlaylistGeneratorInterface
{

    /** @var PlaylistGateway */
    protected $playlistGateway;

    /**
     * AbstractPlaylistGenerator constructor.
     * @param PlaylistGateway $playlistGateway
     */
    public function __construct(PlaylistGateway $playlistGateway)
    {
        $this->playlistGateway = $playlistGateway;
    }

    /**
     * @return PlaylistGateway
     */
    public function getPlaylistGateway(): PlaylistGateway
    {
        return $this->playlistGateway;
    }

    /**
     * @param PlaylistGateway $playlistGateway
     */
    public function setPlaylistGateway(PlaylistGateway $playlistGateway): void
    {
        $this->playlistGateway = $playlistGateway;
    }

}
