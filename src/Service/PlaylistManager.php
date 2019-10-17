<?php


namespace App\Service;


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
     * @param $limit
     * @return PlaylistInterface
     */
    public function limitedDurationPlaylist($limit)
    {
        $playlist = new Playlist();

        $fetchTracks = $this->playlistGateway->findTracks();
        $random = rand(0, count($fetchTracks));

        while($playlist->getDuration() < $limit)
        {
            $playlist->addTrack($fetchTracks[$random]);
        }

        return $playlist;
    }

    /**
     * @param $limit
     * @return PlaylistInterface
     */
    public function limitedCountPlaylist($limit)
    {
        $playlist = new Playlist();

        $fetchTracks = $this->playlistGateway->findAllTracks();
        $random = rand(0, count($fetchTracks)-1);

        while(count($playlist->getTracks()) < $limit)
        {
            $playlist->addTrack($fetchTracks[$random]);
        }

        return $playlist;
    }

    /**
     * @return Playlist
     */
    public function fullAlbumPlaylist()
    {
        $playlist = new Playlist();

        $fetchAlbums = $this->playlistGateway->findAllAlbums();

        foreach ($fetchAlbums as $album => $track)
        {
            $playlist->addTrack($track);
        }

        return $playlist;
    }

    /**
     * @param $medium
     * @return PlaylistInterface
     */
    public function limitedMediumPlaylist($medium)
    {
        $playlist = new Playlist();

        $fetchTracks = $this->playlistGateway->findTracksByMedium($medium);

        foreach ($fetchTracks as $track) {
            $playlist->addTrack($track);
        }

        return $playlist;
    }
}