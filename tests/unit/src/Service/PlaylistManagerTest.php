<?php


namespace App\Tests\unit\src\Service;


use App\Entity\Album\Album;
use App\Entity\Artist\Artist;
use App\Entity\Media\Medium;
use App\Entity\Track\Track;
use App\Entity\Track\TrackInterface;
use App\Gateway\TrackGateway;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Repository\TrackRepository;
use App\Service\Playlist\Generator\AbstractPlaylistGenerator;
use App\Service\Playlist\Generator\CountLimitedPlaylistGenerator;
use App\Service\Playlist\Generator\DurationLimitedPlaylistGenerator;
use App\Service\Playlist\Generator\StyleAndDurationLimitedPlaylistGenerator;
use App\Service\Playlist\PlaylistManager;
use App\Service\Playlist\PlaylistManagerException;
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
     * @var TrackGateway
     */
    protected $trackGateway;

    public function setUp(): void
    {
        $this->albumRepository = $this->createMock(AlbumRepository::class);
        $this->trackRepository = $this->createMock(TrackRepository::class);
        $this->artistRepository = $this->createMock(ArtistRepository::class);
        $this->trackGateway = new TrackGateway($this->trackRepository, $this->albumRepository, $this->artistRepository);
    }

    /**
     * @dataProvider getData
     * @param array $tracks
     * @throws PlaylistManagerException
     */
    public function testLimitedCountPlaylistGenerator($trackCountryCd, $trackRapFile, $trackRapCd)
    {
        // PREPARE
        $this->trackRepository->method("findAll")
            ->willReturn(array($trackCountryCd, $trackRapFile, $trackRapCd));
        //RUN
        $playlistManager = new PlaylistManager(new CountLimitedPlaylistGenerator($this->trackGateway));
        $criteria['max_count'] = 2;
        $playlist = $playlistManager->generatePlaylist($criteria);
        // ASSERT
        $this->assertLessThanOrEqual(2, count($playlist->getTracks()));
    }

    /**
     * @dataProvider getData
     * @param array $tracks
     * @throws PlaylistManagerException
     */
    public function testLimitedStyleAndDurationPlaylistGenerator($trackCountryCd, $trackRapFile, $trackRapCd)
    {
        // PREPARE
        $this->trackRepository->method("findByArtistStyle")
            ->with("Rap")
            ->willReturn(array($trackRapFile, $trackRapCd));
        //RUN
        $playlistManager = new PlaylistManager(new StyleAndDurationLimitedPlaylistGenerator($this->trackGateway));
        $criteria['style'] = "Rap";
        $criteria['max_duration'] = 400;
        $playlist = $playlistManager->generatePlaylist($criteria);
        // ASSERT
        $this->assertLessThanOrEqual(1, count($playlist->getTracks()));
    }

    /**
     * @dataProvider getData
     * @param array $tracks
     * @throws PlaylistManagerException
     */
    public function testLimitedDurationPlaylistGenerator($trackCountryCd, $trackRapFile, $trackRapCd)
    {
        // PREPARE
        $this->trackRepository->method("findAll")
            ->willReturn(array($trackRapFile, $trackRapCd,$trackCountryCd));
        //RUN
        $playlistManager = new PlaylistManager(new DurationLimitedPlaylistGenerator($this->trackGateway));
        $criteria['max_duration'] = 400;
        $playlist = $playlistManager->generatePlaylist($criteria);
        // ASSERT
        $this->assertLessThanOrEqual(400, $playlist->getDuration());
    }

    public function testGatewayAccessors()
    {
        // PREPARE
        $abstractGenerator = $this->getMockForAbstractClass(AbstractPlaylistGenerator::class,[],'',false);
        // RUN
        $abstractGenerator->setPlaylistGateway($this->trackGateway);
        // ASSERT
        $this->assertEquals($this->trackGateway, $abstractGenerator->getPlaylistGateway());
    }

    /**
     * @return array
     */
    public function getData()
    {
        $cdAlbum = new Album();
        $cd = new Medium();
        $cd->setId($cd::CD)->setType();
        $file = new Medium();
        $file->setId($file::FILE)->setType();
        $cdAlbum->addMedium($cd);
        $fileAlbum = new Album();
        $fileAlbum->addMedium($file);

        $countryArtist = new Artist();
        $countryArtist->setStyle("Country")
                    ->setName('test');
        $rapArtist = new Artist();
        $rapArtist->setStyle("Rap")
                ->setName('test');

        $trackCountryCd = new Track();
        $trackCountryCd->setTitle("test")
            ->setDuration(120)
            ->setArtist($countryArtist)
            ->setAlbum($cdAlbum);

        $trackRapFile = new Track();
        $trackRapFile->setTitle("test2")
            ->setDuration(240)
            ->setArtist($rapArtist)
            ->setAlbum($fileAlbum);

        $trackRapCd = new Track();
        $trackRapCd->setTitle("test3")
            ->setDuration(310)
            ->setArtist($rapArtist)
            ->setAlbum($cdAlbum);

        return [
            [
                $trackCountryCd, $trackRapCd, $trackRapFile
            ]
        ];
    }

}