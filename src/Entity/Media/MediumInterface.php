<?php


namespace App\Entity\Media;


use App\Entity\Album\AlbumInterface;

interface MediumInterface
{
    // get Medium Albums
    //public function getAlbums(): AlbumInterface;

    // get Medium Type
    public function getType(): string;
}