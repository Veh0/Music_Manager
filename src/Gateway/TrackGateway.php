<?php


namespace App\Gateway;


use App\Entity\Media\MediumInterface;
use App\Entity\Track\TrackInterface;
use App\Repository\TrackRepository;

class TrackGateway
{
    /** @var TrackRepository */
    protected $trackRepository;

    public function __construct($trackRepository)
    {
        $this->trackRepository = $trackRepository;
    }

    /**
     * @return TrackInterface[]
     */
    public function fetchAll() {
        return $this->trackRepository->findAll();
    }

    /**
     * @param string $title
     * @return MediumInterface[]
     */
    public function fetchMediaByTrackTitle($title)
    {
        return $this->trackRepository->findMediaByTitle($title);
    }


}