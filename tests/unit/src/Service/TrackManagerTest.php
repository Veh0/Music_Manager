<?php


namespace App\Tests\unit\src\Service;


use App\Entity\Media\CD;
use App\Entity\Media\File;
use App\Entity\Media\Vinyle;
use App\Entity\Track\Track;
use App\Gateway\TrackGateway;
use App\Repository\TrackRepository;
use App\Service\TrackManager;
use Codeception\PHPUnit\TestCase;

class TrackManagerTest extends TestCase
{
    /** @var TrackRepository */
    protected $trackRepository;

    /** @var TrackGateway */
    protected $trackGateway;

    protected function setUp(): void
    {
//        $this->trackRepository = $this->createMock(TrackRepository::class);
//        $this->trackGateway = new TrackGateway($this->trackRepository);
    }

    public function testGetTrackMedia()
    {
       /* // PREPARE
        $cd = new CD();
        $digital = new File();

        $track = new Track();
        $track->setTitle('test');
        $track->addMedium($cd);
        $track->addMedium($digital);

        $trackManager = new TrackManager($this->trackGateway);
        // RUN
        $this->trackRepository->method('findMediaByTitle')
                              ->with($track->getTitle())
                              ->willReturn($track->getMedia());
        // ASSERT
        $this->assertEquals($track->getMedia(), $trackManager->getTrackMedia($track->getTitle()));*/
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function testExportToCsv()
    {
        // PREPARE
       /* $track = new Track();
        $track->setDuration(110);
        $track->addMedium(new CD());
        $track->addMedium(new Vinyle());
        // RUN
        $this->trackRepository->method('findAll')
            ->willReturn(array($track));

        // Obtains fgetcsv lookalike
        $array = (array) $track;
        foreach ($array as $v)
        {
            if(is_array($v)) {
                for ($i = 0; $i < count($v); $i++) {
                    $value += $v[i]->getType();
                    $v = $value;
                }
            }
            $newArray[] = strval($v);
        }

        $trackManager = new TrackManager($this->trackGateway);
        $trackManager->export('csv');
        // ASSERT
        $this->assertEquals($newArray, fgetcsv(fopen('tracks.csv', 'r')));*/
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    /*public function testExportToXls()
    {
        // PREPARE
        $track = new Track();
        $track->setDuration(110);
        $track->addMedium(new CD());
        $track->addMedium(new Vinyle());
        // RUN
        $this->trackRepository->method('findAll')
            ->willReturn(array($track));

        $trackManager = new TrackManager($this->trackGateway);
        $trackManager->export('xls');
        // ASSERT
        $this->assertFileExists('tracks.xls');*/

}