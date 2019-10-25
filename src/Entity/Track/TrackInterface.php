<?php


namespace App\Entity\Track;


use App\Entity\Media\MediumInterface;

interface TrackInterface
{

    // get Track title
    public function getTitle(): ?string;

    // get Track duration
    public function getDuration(): ?int;

}