<?php


namespace App\Service\Playlist\Generator;


use App\Entity\Playlist\PlaylistInterface;

class StyleAndDurationLimitedPlaylistGenerator extends AbstractPlaylistGenerator
{
    public function doesHandle(array $criteria): bool
    {
        return (!empty($criteria['max_duration']) && !empty($criteria['style']));
    }

    public function generate(array $criteria): PlaylistInterface
    {
        // TODO: Implement generate() method.
    }

}
