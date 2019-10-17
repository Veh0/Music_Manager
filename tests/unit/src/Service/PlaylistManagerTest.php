<?php


namespace App\Tests\unit\src\Service;


use App\Entity\Track\Track;
use App\Entity\Track\TrackInterface;
use Codeception\PHPUnit\TestCase;

class PlaylistManagerTest extends TestCase
{
    /**
     * @param TrackInterface[] $array
     * @param int $limit
     * @dataProvider getDataForTestPlaylistManager
     */
    public function testLimitedDurationPlaylist($array, $limit) {

    }

    public function getDataForTestPlaylistManager() {
        return [
            [array(new Track(), new Track(), new Track())]
        ];
    }
}