<?php


namespace App\Tests\unit\src\Entity\Track;


use App\Entity\Album\Album;
use App\Entity\Artist\Artist;
use App\Entity\Media\Medium;
use App\Entity\Track\Track;
use Codeception\PHPUnit\TestCase;

class TrackTest extends TestCase
{
    public function testIdAccessors()
    {
        // PREPARE
        $track = new Track();
        // RUN

        // ASSERT
        $this->assertEquals(0, $track->getId());
    }
    public function testDurationAccessors()
    {
        // PREPARE
        $track = new Track();
        // RUN
        $track->setDuration(155);
        //ASSERT
        $this->assertEquals(155, $track->getDuration());
    }

    public function testArtistAccessors()
    {
        // PREPARE
        $track = new Track();
        // RUN
        $track->setArtist(new Artist());
        //ASSERT
        $this->assertEquals(new Artist(), $track->getArtist());
    }

    public function testAlbumAccessors()
    {
        // PREPARE
        $track = new Track();
        $file = new Medium();
        $file->setId($file::FILE)->setType();
        $album = new Album();
        $album->addMedium($file);
        // RUN
        $track->setAlbum($album)->addMedium();
        //ASSERT
        $this->assertEquals($album, $track->getAlbum());
        $this->assertEquals(array($file), $track->getMedia()->toArray());
    }

    public function testTitleAccessors()
    {
        // PREPARE
        $track = new Track();
        // RUN
        $track->setTitle('test');
        //ASSERT
        $this->assertEquals('test', $track->getTitle());
    }

}