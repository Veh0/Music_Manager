<?php


namespace App\Entity\Playlist;


use App\Entity\Track\TrackInterface;

interface PlaylistInterface
{

    // Add Track to Playlist
    public function addTrack(TrackInterface $track): void;

    // get Playlist duration
    public function getDuration(): int;

    // get Playlist tracks
    public function getTracks(): array;
}