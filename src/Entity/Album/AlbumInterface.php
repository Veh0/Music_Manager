<?php


namespace App\Entity\Tracklist;


use App\Entity\Media\MediumInterface;
use App\Entity\Track\TrackInterface;

interface TracklistInterface
{
    // get Tracklist Medium
    public function getMedium(): MediumInterface;

    // get Tracklist title
    public function getTitle(): string;

    // get Tracklist Tracks
    public function getTracks(): array;

    // get Tracklist duration
    public function getDuration(): int;

    // get Tracklist artist
    public function getArtist(): string;

}