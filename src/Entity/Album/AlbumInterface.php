<?php


namespace App\Entity\Album;


use App\Entity\Artist\ArtistInterface;
use App\Entity\Media\MediumInterface;
use App\Entity\Track\TrackInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

interface AlbumInterface
{
    // get Album Medium
    public function getMedia(): array;

    // add Medium to Album media
    public function addMedium(): self;

    // get Album title
    public function getTitle(): string;

    // get Album Tracks
    public function getTracks(): Collection;

    // get Album duration
    public function getDuration(): int;

    // get Album artist
    public function getArtist(): ArtistInterface;

}