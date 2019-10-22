<?php

namespace App\Entity\Track;

use App\Entity\Album\AlbumInterface;
use App\Entity\Artist\Artist;
use App\Entity\Media\MediumInterface;
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
     * @ORM\Column(type="array")
     * @var MediumInterface[]
     */
    protected $media;

    /**
     * @ORM\Column(type="int")
     */
    protected $duration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist\Artist", inversedBy="tracks")
     */
    protected $artist;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Album\Album", inversedBy="tracks")
     */
    protected $album;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return MediumInterface[]
     */
    public function getMedia(): array
    {
        return $this->media;
    }

    /**
     * @param MediumInterface $medium
     */
    public function addMedium(MediumInterface $medium)
    {
        $this->media[] = $medium;
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
     * @return $this
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Artist
     */
    public function getArtist(): Artist
    {
        return $this->artist;
    }

    /**
     * @param Artist|null $artist
     * @return $this
     */
    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * @return AlbumInterface
     */
    public function getAlbum(): AlbumInterface
    {
        return $this->album;
    }

    /**
     * @param AlbumInterface|null $album
     * @return $this
     */
    public function setAlbum(?AlbumInterface $album): self
    {
        $this->album = $album;

        return $this;
    }
}
