<?php


namespace App\Tests\unit\src\Entity\Track;


use App\Entity\Album\Album;
use App\Entity\Artist\Artist;
use App\Entity\Media\Medium;
use App\Entity\Media\Vinyle;
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
        // RUN
        $track->setAlbum(new Album);
        //ASSERT
        $this->assertEquals(new Album, $track->getAlbum());
    }

    public function testMediumAccessors()
    {
        // PREPARE
        $track = new Track();
        // RUN
        $track -> addMedium(new Vinyle());
        // ASSERT
        $this -> assertEquals(array(new Vinyle()), $track->getMedia());
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