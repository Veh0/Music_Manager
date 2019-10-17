<?php


namespace App\Entity\Track;


use App\Entity\Album\AlbumInterface;

class Track implements TrackInterface
{

    /** @var string */
    protected $title;

    /** @var int */
    protected $duration;

    /** @var AlbumInterface */
    protected $album;

    /** @var string */
    protected $artist;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
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

    /**
     * @return string
     */
    public function getArtist(): string
    {
        return $this->artist;
    }

    /**
     * @param string $artist
     */
    public function setArtist(string $artist): void
    {
        $this->artist = $artist;
    }


}