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
        $this->assertEquals(0, $artist->getId());
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
        $album = new Album();
        $delAlbum = new Album();
        $artist->addAlbum($album)
               ->addAlbum($delAlbum)
               ->removeAlbum($delAlbum);
        //ASSERT
        $this->assertEquals(array($album), $artist->getAlbums()->toArray());
    }

    public function testTracksAccessors()
    {
        // PREPARE
        $artist = new Artist();
        // RUN
        $track = new Track();
        $delTrack = new Track();
        $artist->addTrack($track)
               ->addTrack($delTrack)
               ->removeTrack($delTrack);
        //ASSERT
        $this->assertSame(array($track), $artist->getTracks()->toArray());
    }

}
