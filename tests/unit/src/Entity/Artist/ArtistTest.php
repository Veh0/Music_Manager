<?php


namespace App\Tests\unit\src\Entity\Artist;


use App\Entity\Artist\Artist;
use App\Entity\Track\Track;
use App\Entity\Album\Album;
use Doctrine\Common\Collections\Collection;
use Codeception\PHPUnit\TestCase;

class ArtistTest extends TestCase
{
    public function testIdAccessors()
    {
        // PREPARE
        $artist = new Artist();
        // RUN

        // ASSERT
        $this->assertEquals(null, $artist->getId());
    }

    public function testNameAccessors()
    {
        // PREPARE
        $artist = new Artist();
        // RUN
        $artist->setName('test');
        //ASSERT
        $this->assertEquals('test', $artist->getName());
    }

    public function testStyleAccessors()
    {
        // PREPARE
        $artist = new Artist();
        // RUN
        $artist->setStyle('test');
        //ASSERT
        $this->assertEquals('test', $artist->getStyle());
    }

    public function testAlbumsAccessors()
    {
        // PREPARE
        $artist = new Artist();
        // RUN
        $tracklist = new Album();
        $artist->addAlbum($tracklist);
        //ASSERT
        $this->assertEquals(array($tracklist), $artist->getAlbums());
    }

    public function testTracksAccessors()
    {
        // PREPARE
        $artist = new Artist();
        // RUN
        $track = new Track();
        $artist->addTrack($track);
        //ASSERT
        $this->assertEquals(array($track), $artist->getTracks());
    }

}
