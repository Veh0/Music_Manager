<?php


namespace App\Tests\unit\src\Service;


use App\Entity\Album\Album;
use App\Service\Export\ExportManagerException;
use App\Entity\Artist\Artist;
use App\Entity\Media\CD;
use App\Entity\Media\Digital;
use App\Entity\Media\Vinyle;
use App\Entity\Track\Track;
use App\Gateway\TrackGateway;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Repository\TrackRepository;
use App\Service\Export\ExportManager;
use App\Service\Export\Generator\CsvGenerator;
use App\Service\Export\Generator\XlsGenerator;
use Codeception\PHPUnit\TestCase;

class ExportManagerTest extends TestCase
{
    /**
     * @var TrackGateway
     */
    protected $trackGateway;

    /**
     * @var TrackRepository
     */
    protected $trackRepository;

    /** @var AlbumRepository */
    protected $albumRepository;

    /** @var ArtistRepository */
    protected $artistRepository;

    protected function setUp() : void
    {
        $this->albumRepository = $this->createMock(AlbumRepository::class);
        $this->trackRepository = $this->createMock(TrackRepository::class);
        $this->artistRepository = $this->createMock(ArtistRepository::class);
        $this->trackGateway = new TrackGateway($this->trackRepository,$this->albumRepository,$this->artistRepository);
    }


    /**
     * @dataProvider csvProvider
     * @param array $data
     * @throws ExportManagerException
     */
    public function testExportToCsvGenerator(array $data)
    {
        // PREPARE
        $this->trackRepository->method('findAll')
            ->willReturn($data);
        // RUN
        $criteria['format'] = "csv";
        $exportManager = new ExportManager(new CsvGenerator($this->trackGateway));
        $exportManager->generateExport($criteria);
        // ASSERT
        //$this->assertFileEquals('public/file.csv', 'tracks.csv');
    }


    public function testGenerateFailsIfNoMatchingGeneratorDoesHandleTheRequest()
    {
        $manager = new ExportManager();

        $this->expectException(ExportManagerException::class);

        $manager->generateExport([]);

    }

    /**
     * @dataProvider xlsProvider
     * @param array $data
     * @throws ExportManagerException
     */
    public function testExportToXlsGenerator(array $data)
    {
        // PREPARE
        $this->trackRepository->method('findAll')
            ->willReturn($data);
        // RUN
        $criteria['format'] = 'xls';
        $exportManager = new ExportManager(new XlsGenerator($this->trackGateway));
        $exportManager->generateExport($criteria);

        // ASSERT
       // $this->assertFileEquals('public/tracks.xls', 'tracks.xls');
    }


    public function csvProvider()
    {
        $artist1 = new Artist();
        $artist1->setName('artist');
        $album1 = new Album();
        $album1->setTitle('testAlbum');
        $track1 = new Track();
        $track1->setTitle('test')
            ->setDuration(110)
            ->setArtist($artist1)
            ->setAlbum($album1);
        $track1->addMedium(new CD());
        $track1->addMedium(new Vinyle());

        $artist2 = new Artist();
        $artist2->setName('artist2');
        $track2 = new Track();
        $track2->setTitle('test2')
            ->setDuration(210)
            ->setArtist($artist2)
            ->setAlbum($album1);
        $track2->addMedium(new Digital());
        $track2->addMedium(new CD());

        return [
            [
                [$track1,$track2]
            ]
        ];
    }

    public function xlsProvider()
    {
        $artist = new Artist();
        $artist->setName('artist');
        $album = new Album();
        $album->setTitle('testAlbum');
        $track1 = new Track();
        $track1->setTitle('test1')
            ->setDuration(220)
            ->setArtist($artist)
            ->setAlbum($album);
        $track1->addMedium(new CD());
        $track1->addMedium(new Vinyle());

        $track2 = new Track();
        $track2->setTitle('test2')
            ->setDuration(120)
            ->setArtist($artist)
            ->setAlbum($album);
        $track2->addMedium(new Digital());
        $track2->addMedium(new Vinyle());

        $track3 = new Track();
        $track3->setTitle('test3')
            ->setDuration(200)
            ->setArtist($artist)
            ->setAlbum($album);
        $track3->addMedium(new Digital());
        $track3->addMedium(new CD());

        return [
            [
                [$track1,$track2,$track3]
            ]
        ];
    }
}