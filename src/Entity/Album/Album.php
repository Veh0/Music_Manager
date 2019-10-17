<?php


namespace App\Entity\Tracklist;


use App\Entity\Media\MediumInterface;
use App\Entity\Track\TrackInterface;

abstract class AbstractTracklist implements TracklistInterface
{
    /** @var MediumInterface */
    protected $medium;

    /** @var string */
    protected $title;

    /** @var TrackInterface[] */
    protected $tracks;

    /** @var int */
    protected $duration;

    /** @var string */
    protected $artist;

    /**
     * @return MediumInterface
     */
    public function getMedium(): MediumInterface
    {
        return $this->medium;
    }

    /**
     * @param MediumInterface $medium
     */
    public function setMedium(MediumInterface $medium): void
    {
        $this->medium = $medium;
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
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return TrackInterface[]
     */
    public function getTracks(): array
    {
        return $this->tracks;
    }

    /**
     * @param TrackInterface[] $tracks
     */
    public function setTracks(array $tracks): void
    {
        $this->tracks = $tracks;
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