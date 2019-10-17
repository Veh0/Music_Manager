<?php


namespace App\Entity\Album;


use App\Entity\Media\MediumInterface;
use App\Entity\Track\TrackInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

interface AlbumInterface
{
    // get Tracklist Medium
    public function getMedium(): MediumInterface;

    // get Tracklist title
    public function getTitle(): string;

    // get Tracklist Tracks
    public function getTracks(): Collection;

    // get Tracklist duration
    public function getDuration(): \DateTimeInterface;

    // get Tracklist artist
    public function getArtist(): Collection;

}