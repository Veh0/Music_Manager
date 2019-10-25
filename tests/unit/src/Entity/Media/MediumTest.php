<?php


namespace App\Tests\unit\src\Entity\Media;


use App\Entity\Album\Album;
use App\Entity\Media\Medium;
use Codeception\PHPUnit\TestCase;

class MediumTest extends TestCase
{
    public function testAlbumAccessors() {
        // PREPARE
        $medium = new Medium();
        $medium->setId($medium::VINYLE)->setType();

        $album = new Album();
        // RUN
        $album->addMedium($medium);
        // ASSERT
        $this->assertEquals(array($album), $medium->getAlbums()->toArray());
    }

    public function testTypeAccessors() {
        // PREPARE
        $medium = new Medium();
        // RUN
        $medium->setId($medium::FILE)->setType();
        // ASSERT
        $this->assertEquals('File', $medium->getType());
    }
}