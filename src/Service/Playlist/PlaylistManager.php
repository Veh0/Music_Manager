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
    /** @var PlaylistGeneratorInterface[] */
    protected $playlistGenerators = [];

    public function __construct(PlaylistGeneratorInterface ...$generators)
    {
        foreach ($generators as $generator) $this->registerGenerator($generator);
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

    public function registerGenerator(PlaylistGeneratorInterface $generator)
    {
        $this->playlistGenerators[] = $generator;
    }
}
