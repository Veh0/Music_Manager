<?php


namespace App\Entity\Media;


use App\Entity\Album\AlbumInterface;

class AbstractMedium implements MediumInterface
{
    /** @var float */
    protected $price;

    /** @var AlbumInterface */
    protected $album;

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return AlbumInterface
     */
    public function getAlbum(): AlbumInterface
    {
        return $this->album;
    }

    /**
     * @param AlbumInterface $album
     */
    public function setAlbum(AlbumInterface $album): void
    {
        $this->album = $album;
    }


}