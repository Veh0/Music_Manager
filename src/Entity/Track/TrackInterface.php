<?php


namespace App\Entity\Track;


use App\Entity\Media\MediumInterface;

interface TrackInterface
{

    // get Track title
    public function getTitle(): string;

    // get Track Media
    public function getMedia(): array;

    // add Medium to Track media
    public function addMedium(MediumInterface $medium);

    // get Track duration
    public function getDuration(): int;

}