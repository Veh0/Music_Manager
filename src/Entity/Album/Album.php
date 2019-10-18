<?php

namespace App\Entity\Album;

use App\Entity\Artist\ArtistInterface;
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
     * @ORM\Column(type="array")
     * @var MediumInterface[]
     */
    protected $media;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Track", mappedBy="album")
     */
    protected $tracks;

    /**
     * @ORM\Column(type="int")
     */
    protected $duration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="albums")
     */
    protected $artist;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedia(): array
    {
        return $this->media;
    }

    public function addMedium(MediumInterface $medium): self
    {
        $this->media[] = $medium;

        return $this;
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

    /**
     * @return Collection|TrackInterface[]
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(TrackInterface $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->setAlbum($this);
            $this->duration += $track->getDuration();
        }

        return $this;
    }

    public function removeTrack(TrackInterface $track): self
    {
        if ($this->tracks->contains($track)) {
            $this->tracks->removeElement($track);
            $this->duration -= $track->getDuration();
            // set the owning side to null (unless already changed)
            if ($track->getAlbum() === $this) {
                $track->setAlbum(null);
            }
        }

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

    public function getArtist(): ?ArtistInterface
    {
        return $this->artist;
    }

    public function setArtist(?ArtistInterface $artist): self
    {
        $this->artist = $artist;

        return $this;
    }
}
