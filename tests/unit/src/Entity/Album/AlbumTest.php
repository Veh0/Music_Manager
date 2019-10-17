<?php


namespace App\Tests\unit\src\Entity\Album;


use App\Entity\Album\Album;
use App\Entity\Media\AbstractMedium;
use App\Entity\Track\Track;
use Codeception\PHPUnit\TestCase;

class AlbumTest extends TestCase
{
    public function testArtistAccessors()
    {
        // PREPARE
        $album = new Album();
        // RUN
        $album -> setArtist("a");
        // ASSERT
        $this -> assertEquals("a", $album->getArtist());
    }

    public function testTitleAccessors()
    {
        // PREPARE
        $album = new Album();
        // RUN
        $album -> setTitle("a");
        // ASSERT
        $this -> assertEquals("a", $album->getTitle());
    }

    public function testMediumAccessors()
    {
        // PREPARE
        $album = new Album();
        $medium = $this->getMockForAbstractClass(AbstractMedium::class);
        // RUN
        $album -> setMedium(new $medium);
        // ASSERT
        $this -> assertEquals(new $medium, $album->getMedium());
    }

    public function testDurationAccessors() {
        // PREPARE
        $album = new Album();
        // RUN
        $album -> setDuration(1);
        // ASSERT
        $this -> assertEquals(1, $album->getDuration());
    }

    public function testTracksAccessors() {
        // PREPARE
        $album = new Album();
        // RUN
        $tracks = array(new Track(), new Track());
        $album -> setTracks($tracks);
        // ASSERT
        $this -> assertEquals($tracks, $album->getTracks());
    }
}