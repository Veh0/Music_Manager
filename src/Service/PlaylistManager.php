<?php


namespace App\src\Service;


use App\Entity\Playlist\PlaylistInterface;
use App\src\Gateway\PlaylistGateway;

class PlaylistManager
{
    /** @var PlaylistGateway */
    protected $playlistGateway;

    public function __construct(PlaylistGateway $playlistGateway)
    {
        $this->playlistGateway = $playlistGateway;
    }

    /**
     * @param PlaylistInterface $playlist
     * @return PlaylistInterface
     */
    public function shuffllePlaylist(PlaylistInterface $playlist): PlaylistInterface
    {
        shuffle($playlist->getTracks());
        return $playlist;
    }

    public function limitedDurationPlaylist(PlaylistInterface $playlist, int $limit): PlaylistInterface
    {

    }
}