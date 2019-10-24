<?php


namespace App\Service\Playlist\Generator;


use App\Entity\Playlist\Playlist;
use App\Entity\Playlist\PlaylistInterface;

class DurationLimitedPlaylistGenerator extends AbstractPlaylistGenerator
{
    public function doesHandle(array $criteria): bool
    {
        return !empty($criteria['max_duration']) && count($criteria) == 1;
    }

    public function generate(array $criteria): PlaylistInterface
    {
        $fetchTracks = $this->playlistGateway->fetchAllTracks();

        $random = rand(0, count($fetchTracks)-1);

        $playlist = new Playlist();

        while ($playlist->getDuration() < $criteria['max_duration'])
        {
            $track = $fetchTracks[$random];

            if ($playlist->getDuration() + $track->getDuration() > $criteria['max_duration']) break;

            $playlist->addTrack($track);
        }

        return $playlist;
    }

}
