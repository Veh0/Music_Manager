<?php


namespace App\Entity\Album;


use App\Entity\Media\MediumInterface;
use App\Entity\Track\TrackInterface;

interface AlbumInterface
{
    // get Album Medium
    public function getMedium(): MediumInterface;

    // get Album title
    public function getTitle(): string;

    // get Album Tracks
    public function getTracks(): array;

    // get Album duration
    public function getDuration(): int;

    // get Album artist
    public function getArtist(): string;

}