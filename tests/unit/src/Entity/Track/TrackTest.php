<?php


namespace App\Tests\unit\src\Entity\Track;


use App\Entity\Album\Album;
use App\Entity\Track\Track;
use Codeception\PHPUnit\TestCase;

class TrackTest extends TestCase
{
    public function testDurationAccessors()
    {
        // PREPARE
        $track = new Track();
        // RUN
        $track->setDuration(5);
        //ASSERT
        $this->assertEquals(5, $track->getDuration());
    }

    public function testArtistAccessors()
    {
        // PREPARE
        $track = new Track();
        // RUN
        $track->setArtist('test');
        //ASSERT
        $this->assertEquals('test', $track->getArtist());
    }

    public function testAlbumAccessors()
    {
        // PREPARE
        $track = new Track();
        // RUN
        $track->setAlbum($this->getMockForAbstractClass(Album::class));
        //ASSERT
        $this->assertEquals($this->getMockForAbstractClass(Album::class), $track->getAlbum());
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