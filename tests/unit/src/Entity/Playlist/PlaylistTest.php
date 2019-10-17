<?php


namespace App\Tests\unit\src\Entity\Playlist;


use App\Entity\Playlist\Playlist;
use App\Entity\Track\Track;
use Codeception\PHPUnit\TestCase;

class PlaylistTest extends TestCase
{

    public function testDurationAccessors() {
        // PREPARE
        $playlist = new Playlist();
        // RUN
        $playlist -> setDuration(5);
        //ASSERT
        $this->assertEquals(5, $playlist->getDuration());
    }

    public function testAddTrack() {
        // PREPARE
        $playlist = new Playlist();
        // RUN
        $track = new Track();
        $track->setDuration(5);
        $playlist -> addTrack($track);
        //ASSERT
        $this->assertEquals(array($track), $playlist->getTracks());
        $this->assertEquals(5, $playlist->getDuration());
    }

}