<?php


namespace App\Gateway;

use App\Entity\Album\AlbumInterface;
use App\Entity\Media\MediumInterface;
use App\Entity\Track\TrackInterface;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Repository\TrackRepository;


class TrackGateway
{
    /** @var TrackRepository */
    protected $trackRepository;

    /** @var AlbumRepository */
    protected $albumRepository;

    /** @var ArtistRepository */
    protected $artistRepository;

    public function __construct(TrackRepository $trackRepository, AlbumRepository $albumRepository, ArtistRepository $artistRepository)
    {
        $this->trackRepository = $trackRepository;
        $this->albumRepository = $albumRepository;
        $this->artistRepository = $artistRepository;
    }

    /** @return TrackInterface[] */
    public function fetchAllTracks(): ?array
    {
        return $this->trackRepository->findAll();
    }

    public function fetchOrder(string $orderBy, string $entity): ?array
    {
        $repository = strtolower($entity)."Repository";

        return $this->$repository->findOrder($orderBy);
    }


    public function fetchWhere(string $where, string $entity): ?array
    {
        $repository = strtolower($entity)."Repository";

        if (empty($where)) return $this->$repository->findAll();

        return $this->$repository->findWhere($where);


    }



    /**
     * @param string $style
     * @return array|null
     */
    public function fetchTracksByStyle(string $style): ?array
    {
        return $this->trackRepository->findByArtistStyle($style);
    }

    /** @return AlbumInterface[] */
    public function fetchAllAlbums(): ?array
    {
        return $this->albumRepository->findAll();
    }

    /**
     * @param MediumInterface[] $media
     * @return AlbumInterface[]
     */
    public function fetchAlbumsByMedium(array $media): ?array
    {
        return $this->albumRepository->findByMedia($media);
    }

    public function fetchAllArtist(): ?array
    {
        return $this->artistRepository->findAll();
    }
}