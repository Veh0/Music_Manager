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
    public function testIdAccessors()
    {
        // PREPARE
        $album = new Album();
        // RUN

        //ASSERT
        $this->assertEquals(0, $album->getId());
    }

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
        $album -> addMedium(new $medium);
        // ASSERT
        $this -> assertEquals(array(new $medium), $album->getMedia());
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

        $a = new Track();
        $a->setDuration(155);
        $b = new Track();
        $b->setDuration(205);
        // RUN
        $album->addTrack($a);
        $album->addTrack($b);
        $album->removeTrack($a);
        // ASSERT
        $this->assertEquals(array($b), $album->getTracks()->toArray());
        $this->assertEquals(205, $album->getDuration());
    }
}