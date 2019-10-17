<?php


namespace App\Tests\unit\src\Entity\Artist;


use App\Entity\Artist\Artist;
use App\Entity\Album\Album;
use App\Entity\Album\Compile;
use Codeception\PHPUnit\TestCase;

class ArtistTest extends TestCase
{
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

    public function testTracklistsAccessors()
    {
        // PREPARE
        $artist = new Artist();
        // RUN
        $tracklist = new Album();
        $artist->setAlbums(array(new $tracklist()));
        //ASSERT
        $this->assertEquals(array(new $tracklist()), $artist->getAlbums());
    }

}
