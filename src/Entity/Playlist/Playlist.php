<?php


namespace App\Entity\Playlist;


use App\Entity\Track\TrackInterface;

class Playlist implements PlaylistInterface
{

    /** @var int */
    protected $duration = 0;

    /** @var array */
    protected $tracks;

    /** @param TrackInterface $track */
    public function addTrack(TrackInterface $track): void
    {
        // TODO: Implement addTrack() method.
        $this->tracks[] = $track;
        $this->duration += $track->getDuration();
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
     * @return TrackInterface[]
     */
    public function getTracks(): array
    {
        return $this->tracks;
    }



}