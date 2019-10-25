<?php

namespace App\Entity\Artist;

use App\Entity\Album\AlbumInterface;
use App\Entity\Track\TrackInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist implements ArtistInterface
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
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $style;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Track\Track", mappedBy="artist")
     */
    protected $tracks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Album\Album", mappedBy="artist")
     */
    protected $albums;

    public function __construct()
    {
        $this->tracks = new ArrayCollection();
        $this->albums = new ArrayCollection();
    }

    /** @return int|null */
    public function getId(): ?int
    {
        return $this->id;
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @param string $style
     * @return $this
     */
    public function setStyle(string $style): self
    {
        $this->style = $style;

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
            $track->setArtist($this);
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
            // set the owning side to null (unless already changed)
            if ($track->getArtist() === $this) {
                $track->setArtist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AlbumInterface[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    /**
     * @param AlbumInterface $album
     * @return $this
     */
    public function addAlbum(AlbumInterface $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setArtist($this);
        }

        return $this;
    }

    /**
     * @param AlbumInterface $album
     * @return $this
     */
    public function removeAlbum(AlbumInterface $album): self
    {
        if ($this->albums->contains($album)) {
            $this->albums->removeElement($album);
            // set the owning side to null (unless already changed)
            if ($album->getArtist() === $this) {
                $album->setArtist(null);
            }
        }

        return $this;
    }
}
