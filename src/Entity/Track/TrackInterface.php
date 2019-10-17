<?php


namespace App\Entity\Track;


interface TrackInterface
{

    // get Track title
    public function getTitle(): string;

    // get Track duration
    public function getDuration(): int;

}