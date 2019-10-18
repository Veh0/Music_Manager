<?php

namespace App\Entity\Track;

use App\Entity\Album\AlbumInterface;
use App\Entity\Artist\Artist;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrackRepository")
 */
class Track implements TrackInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="int")
     */
    protected $duration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="tracks")
     */
    protected $artist;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Album", inversedBy="tracks")
     */
    protected $album;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getArtist(): Artist
    {
        return $this->artist;
    }

    public function setArtist(Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getAlbum(): AlbumInterface
    {
        return $this->album;
    }

    public function setAlbum(AlbumInterface $album): self
    {
        $this->album = $album;

        return $this;
    }
}
