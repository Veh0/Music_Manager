<?php


namespace App\Entity\Artist;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

interface ArtistInterface
{
    // get Artist name
    public function getName(): string;

    // get Artist style
    public function getStyle(): string;

    // get Artist Tracklist
    public function getAlbums(): Collection;
}