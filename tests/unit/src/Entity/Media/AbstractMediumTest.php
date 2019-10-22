<?php


namespace App\Tests\unit\src\Entity\Media;


use App\Entity\Album\Album;
use App\Entity\Media\AbstractMedium;
use App\Entity\Media\CD;
use App\Entity\Media\Digital;
use App\Entity\Media\Vinyle;
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
        $cd = new CD();
        $vinyle = new Vinyle();
        $file = new Digital();
        // ASSERT
        $this->assertEquals('type', $medium->getType());
        $this->assertEquals('CD', $cd->getType());
        $this->assertEquals('Vinyle', $vinyle->getType());
        $this->assertEquals('File', $file->getType());
    }
}