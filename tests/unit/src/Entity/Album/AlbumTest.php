<?php


namespace App\Tests\unit\src\Entity\Album;


use App\Entity\Album\Album;
use App\Entity\Artist\Artist;
use App\Entity\Media\AbstractMedium;
use App\Entity\Track\Track;
use Codeception\PHPUnit\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use mysql_xdevapi\Collection;

class AlbumTest extends TestCase
{
    public function testArtistAccessors()
    {
        // PREPARE
        $album = new Album;
        // RUN
        $album -> setArtist(new Artist());
        // ASSERT
        $this -> assertEquals(new Artist(), $album->getArtist());
    }

    public function testTitleAccessors()
    {
        // PREPARE
        $album = new Album;
        // RUN
        $album -> setTitle("a");
        // ASSERT
        $this -> assertEquals("a", $album->getTitle());
    }

    public function testMediumAccessors()
    {
        // PREPARE
        $album = new Album;
        $medium = $this->getMockForAbstractClass(AbstractMedium::class);
        // RUN
        $album -> setMedium(new $medium);
        // ASSERT
        $this -> assertEquals(new $medium, $album->getMedium());
    }

    public function testDurationAccessors() {
        // PREPARE
        $album = new Album;
        //
        $album -> setDuration(155);
        // ASSERT
        $this -> assertEquals(155, $album->getDuration());
    }

    public function testTracksAccessors() {
        // PREPARE
        $album = new Album;
        // RUN
        $album -> addTrack(new Track());
        $album ->removeTrack(new Track());
        // ASSERT
        $this -> assertEquals(array(), $album->getTracks());
    }
}