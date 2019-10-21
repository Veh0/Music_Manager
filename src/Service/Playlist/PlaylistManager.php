<?php


namespace App\Service\Playlist;


use App\Entity\Media\MediumInterface;
use App\Entity\Playlist\Playlist;
use App\Entity\Playlist\PlaylistInterface;
use App\Gateway\TrackGateway;
use App\Service\Playlist\Generator\DurationLimitedPlaylistGenerator;
use App\Service\Playlist\Generator\PlaylistGeneratorInterface;
use App\Service\Playlist\Generator\StyleAndDurationLimitedPlaylistGenerator;

class PlaylistManager
{
    /** @var TrackGateway */
    protected $playlistGateway;

    /** @var PlaylistGeneratorInterface[] */
    protected $playlistGenerators = [];

    public function __construct(TrackGateway $playlistGateway)
    {
        $this->playlistGateway = $playlistGateway;

        $this->registerGenerator(new StyleAndDurationLimitedPlaylistGenerator());
        $this->registerGenerator(new DurationLimitedPlaylistGenerator());
    }

    /**
     * @param array $criteria
     * @return PlaylistInterface
     * @throws PlaylistManagerException
     */
    public function generatePlaylist(array $criteria) : PlaylistInterface
    {
        foreach ($this->playlistGenerators as $generator)
        {
            if($generator->doesHandle($criteria)) {
                return $generator->generate($criteria);
            }
        }

        throw new PlaylistManagerException('No playlist generator found to handle given criteria');
    }

    /**
     * @param int $limit
     * @return PlaylistInterface
     * Limit the Playlist duration
     */
    public function limitedDurationPlaylist(int $limit): ?PlaylistInterface
    {
        $playlist = new Playlist();

        $fetchTracks = $this->playlistGateway->fetchAllTracks();
        $random = rand(0, count($fetchTracks)-1);

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
     * Limit the number of Track in Playlist
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
     * Genrate Playlist with fully Album
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
     * @param MediumInterface[] $media
     * @return PlaylistInterface
     * Limit the Playlist to a certain Medium
     */
    public function limitedMediumPlaylist(array $media): PlaylistInterface
    {
        $playlist = new Playlist();

        $fetchAlbums = $this->playlistGateway->fetchAlbumsByMedium($media);

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

    public function registerGenerator(PlaylistGeneratorInterface $generator)
    {
        $this->playlistGenerators[] = $generator;
    }
}
