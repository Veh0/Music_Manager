<?php


namespace App\Service;


use App\Entity\Media\MediumInterface;
use App\Entity\Playlist\Playlist;
use App\Entity\Playlist\PlaylistInterface;
use App\Gateway\PlaylistGateway;

class PlaylistManager
{
    /** @var PlaylistGateway */
    protected $playlistGateway;

    public function __construct(PlaylistGateway $playlistGateway)
    {
        $this->playlistGateway = $playlistGateway;
    }

    /**
     * @param int $limit
     * @return PlaylistInterface
     */
    public function limitedDurationPlaylist(int $limit): ?PlaylistInterface
    {
        $playlist = new Playlist();

        $fetchTracks = $this->playlistGateway->fetchAllTracks();
        $random = rand(0, count($fetchTracks)-1);

        dump($fetchTracks);

        while($playlist->getDuration() < $limit)
        {
            $track = $fetchTracks[$random];

            if (($playlist->getDuration() + $track->getDuration()) > $limit) {
                break;
            }

            $playlist->addTrack($track);
        }

        return $playlist;
    }

    /**
     * @param int $limit
     * @return PlaylistInterface
     */
    public function limitedCountPlaylist(int $limit): ?PlaylistInterface
    {
        $playlist = new Playlist();

        $fetchTracks = $this->playlistGateway->fetchAllTracks();
        $random = rand(0, count($fetchTracks)-1);

        while(count($playlist->getTracks()) < $limit)
        {
            $playlist->addTrack($fetchTracks[$random]);
        }

        return $playlist;
    }

    /**
     * @return PlaylistInterface
     */
    public function fullAlbumPlaylist(): ?PlaylistInterface
    {
        $playlist = new Playlist();

        $fetchAlbums = $this->playlistGateway->fetchAllAlbums();

        foreach ($fetchAlbums as $album)
        {
            $albums = $album->getTracks();

            foreach ($albums as $track)
            {
                $playlist->addTrack($track);
            }
        }

        return $playlist;
    }

    /**
     * @param mediumInterface $medium
     * @return PlaylistInterface
     */
    public function limitedMediumPlaylist(MediumInterface $medium): PlaylistInterface
    {
        $playlist = new Playlist();

        $fetchAlbums = $this->playlistGateway->fetchAlbumsByMedium($medium);

        foreach ($fetchAlbums as $album)
        {
            $albums = $album->getTracks();

            foreach ($albums as $track)
            {
                $playlist->addTrack($track);
            }
        }

        return $playlist;
    }
}