<?php


namespace App\Tests\unit\src\Entity\Media;


use App\Entity\Album\Album;
use App\Entity\Media\AbstractMedium;
use Codeception\PHPUnit\TestCase;

class AbstractMediumTest extends TestCase
{
    public function testPriceAccessors() {
        // PREPARE
        $medium = $this->getMockForAbstractClass(AbstractMedium::class);
        // RUN
        $medium->setPrice(2.5);
        // ASSERT
        $this->assertEquals(2.5, $medium->getPrice());
    }

    public function testAlbumAccessors() {
        // PREPARE
        $medium = $this->getMockForAbstractClass(AbstractMedium::class);
        // RUN
        $tracklist = $this->getMockForAbstractClass(Album::class);
        $medium->setAlbum(new $tracklist());
        // ASSERT
        $this->assertEquals(new $tracklist(), $medium->getAlbum());
    }

    public function testTypeAccessors() {
        // PREPARE
        $medium = $this->getMockForAbstractClass(AbstractMedium::class);
        // RUN
        $medium->setType('type');
        // ASSERT
        $this->assertEquals('type', $medium->getType());
    }
}