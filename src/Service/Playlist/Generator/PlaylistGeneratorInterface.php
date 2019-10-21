<?php


namespace App\Service\Playlist\Generator;


use App\Entity\Playlist\PlaylistInterface;

/**
 * Interface PlaylistGeneratorInterface
 * @package App\Service\Playlist\Generator
 */
interface PlaylistGeneratorInterface
{

    /**
     * @param array $criteria
     * @return bool
     */
    public function doesHandle(array $criteria) : bool;

    /**
     * @param array $criteria
     * @return PlaylistInterface
     */
    public function generate(array $criteria) : PlaylistInterface;

    public function getPriority() : int;
}
