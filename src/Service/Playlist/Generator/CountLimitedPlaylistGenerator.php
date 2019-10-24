<?php


namespace App\Service\Playlist\Generator;


use App\Entity\Playlist\Playlist;
use App\Entity\Playlist\PlaylistInterface;

class CountLimitedPlaylistGenerator extends AbstractPlaylistGenerator
{
    public function doesHandle(array $criteria): bool
    {
        return !empty($criteria['max_count']);
    }

    public function generate(array $criteria): PlaylistInterface
    {
        // TODO: Implement generate() method.
        $fetchTracks = $this->playlistGateway->fetchAllTracks();

        $random = rand(0, count($fetchTracks)-1);

        $playlist = new Playlist();

        while (count($playlist->getTracks()) < $criteria['max_count'])
        {
            $playlist->addTrack($fetchTracks[$random]);
        }

        return $playlist;
    }

}