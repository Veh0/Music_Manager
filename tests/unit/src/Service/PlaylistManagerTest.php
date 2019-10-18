<?php


namespace App\Tests\unit\src\Service;


use App\Entity\Album\Album;
use App\Entity\Media\CD;
use App\Entity\Media\Vinyle;
use App\Entity\Track\Track;
use App\Entity\Track\TrackInterface;
use App\Gateway\PlaylistGateway;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Repository\TrackRepository;
use App\Service\PlaylistManager;
use Codeception\PHPUnit\TestCase;

class PlaylistManagerTest extends TestCase
{
    /**
     * @var ArtistRepository
     */
    protected $artistRepository;

    /**
     * @var AlbumRepository
     */
    protected $albumRepository;

    /**
     * @var TrackRepository
     */
    protected $trackRepository;

    /**
     * @var PlaylistGateway
     */
    protected $playlistGateway;

    public function setUp(): void
    {
        $this->albumRepository = $this->createMock(AlbumRepository::class);
        $this->trackRepository = $this->createMock(TrackRepository::class);
        $this->artistRepository = $this->createMock(ArtistRepository::class);
        $this->playlistGateway = new PlaylistGateway($this->trackRepository, $this->albumRepository, $this->artistRepository);
    }

    public function testLimitedDurationPlaylist()
    {
        // PREPARE
        $a = new Track();
        $a->setDuration(110);
        $b = new Track();
        $b->setDuration(150);
        $c = new Track();
        $c->setDuration(220);

        $this->trackRepository->method("findAll")
                              ->willReturn(array($a,$b,$c));
        // RUN
        $playlistManager = new PlaylistManager($this->playlistGateway);
        $playlist = $playlistManager->limitedDurationPlaylist(180);
        // ASSERT
        $this->assertLessThanOrEqual(180, $playlist->getDuration());
    }

    public function testLimitedCountPlaylist()
    {
        // PREPARE
        $a = new Track();
        $a->setDuration(110);
        $b = new Track();
        $b->setDuration(150);
        $c = new Track();
        $c->setDuration(220);

        $this->trackRepository->method("findAll")
            ->willReturn(array($a,$b,$c));
        // RUN
        $playlistManager = new PlaylistManager($this->playlistGateway);
        $playlist = $playlistManager->limitedCountPlaylist(2);
        // ASSERT
        $this->assertEquals(2, count($playlist->getTracks()));
    }

    public function testFullAlbumPlaylist()
    {
        // PREPARE
        $a = new Track();
        $a->setDuration(110);
        $b = new Track();
        $b->setDuration(150);
        $c = new Track();
        $c->setDuration(220);
        $d = new Track();
        $d->setDuration(220);

        $firstAlbum = new Album();
        $firstAlbum->addTrack($a)
                   ->addTrack($b);
        $secondAlbum = new Album();
        $secondAlbum->addTrack($d);

        $this->albumRepository->method("findAll")
            ->willReturn(array($firstAlbum,$secondAlbum));
        // RUN
        $playlistManager = new PlaylistManager($this->playlistGateway);
        $playlist = $playlistManager->fullAlbumPlaylist();
        // ASSERT
        $this->assertEquals(array($a, $b, $d), $playlist->getTracks());
    }

    public function testLimitedMediumPlaylist()
    {
        // PREPARE
        $a = new Track();
        $a->setDuration(110);
        $b = new Track();
        $b->setDuration(150);
        $c = new Track();
        $c->setDuration(220);
        $d = new Track();
        $d->setDuration(220);

        $vinyle = new Vinyle();
        $cd = new CD();

        $firstAlbum = new Album();
        $firstAlbum->addTrack($a)
                   ->addTrack($b)
                   ->addMedium($vinyle);
        $secondAlbum = new Album();
        $secondAlbum->addTrack($d)
                    ->addMedium($cd);

        $this->albumRepository->method("findByMedia")
            ->with(array($vinyle))
            ->willReturn(array($firstAlbum));
        // RUN
        $playlistManager = new PlaylistManager($this->playlistGateway);
        $playlist = $playlistManager->limitedMediumPlaylist(array($vinyle));
        // ASSERT
        $this->assertEquals(array($a, $b), $playlist->getTracks());
    }

}