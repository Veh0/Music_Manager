<?php


namespace App\Entity\Track;


use App\Entity\Media\MediumInterface;

interface TrackInterface
{

    // get Track title
    public function getTitle(): ?string;

    // get Track Media
    public function getMedia(): ?array;

    // add Album media to Track media
    public function addMedium();

    // get Track duration
    public function getDuration(): ?int;

}