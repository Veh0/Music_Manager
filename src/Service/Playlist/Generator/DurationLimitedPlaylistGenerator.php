<?php


namespace App\Service\Playlist\Generator;


use App\Entity\Playlist\PlaylistInterface;

class DurationLimitedPlaylistGenerator extends AbstractPlaylistGenerator
{
    public function doesHandle(array $criteria): bool
    {
        return !empty($criteria['max_duration']) && count($criteria) == 1;
    }

    public function generate(array $criteria): PlaylistInterface
    {
        // TODO: Implement generate() method.
    }

}
