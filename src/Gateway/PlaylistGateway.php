<?php


namespace App\Gateway;

use App\Entity\Media\MediumInterface;
use Doctrine\ORM\EntityManager;

class PlaylistGateway
{
    public function findAllTracks(): array
    {
        return [];
    }

    public function findAllAlbums(): array
    {
        return [];
    }

    public function findTracksByMedium(MediumInterface $medium): array
    {
        return [];
    }
}