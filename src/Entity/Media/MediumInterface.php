<?php


namespace App\Entity\Media;


use App\Entity\Album\AlbumInterface;

interface MediumInterface
{
    // get Medium price
    public function getPrice(): float;

    // get Medium Tracklist
    public function getAlbum(): AlbumInterface;

    // get Medium Type
    public function getType(): string;
}