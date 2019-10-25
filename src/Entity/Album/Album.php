<?php

namespace App\Entity\Album;

use App\Entity\Artist\ArtistInterface;
use App\Entity\Media\Medium;
use App\Entity\Media\MediumInterface;
use App\Entity\Track\TrackInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album implements AlbumInterface
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
     * @ORM\OneToMany(targetEntity="App\Entity\Track\Track", mappedBy="album")
     */
    protected $tracks;

    /**
     * @ORM\Column(type="integer")
     */
    protected $duration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist\Artist", inversedBy="albums")
     */
    protected $artist;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Media\Medium", inversedBy="albums")
     */
    protected $media;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
        $this->media = new ArrayCollection();
    }

    /** @return int|null */
    public function getId(): ?int
    {
        return $this->id;
    }

    /** @return string */
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
     * @return Collection|TrackInterface[]
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    /**
     * @param TrackInterface $track
     * @return $this
     */
    public function addTrack(TrackInterface $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->setAlbum($this);
            $this->duration += $track->getDuration();
        }

        return $this;
    }

    /**
     * @param TrackInterface $track
     * @return $this
     */
    public function removeTrack(TrackInterface $track): self
    {
        if ($this->tracks->contains($track)) {
            $this->tracks->removeElement($track);
            $this->tracks = new ArrayCollection($this->tracks->getValues());
            $this->duration -= $track->getDuration();
            // set the owning side to null (unless already changed)
            if ($track->getAlbum() === $this) {
                $track->setAlbum(null);
            }
        }

        return $this;
    }

    /** @return int */
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

    /** @return ArtistInterface|null */
    public function getArtist(): ?ArtistInterface
    {
        return $this->artist;
    }

    /**
     * @param ArtistInterface|null $artist
     * @return $this
     */
    public function setArtist(?ArtistInterface $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * @return Collection|Medium[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Medium $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->addAlbum($this);
        }

        return $this;
    }

    public function removeMedium(Medium $medium): self
    {
        if ($this->media->contains($medium)) {
            $this->media->removeElement($medium);
        }

        return $this;
    }
}
