<?php


namespace App\Entity\Media;


class Vinyle extends AbstractMedium
{
    public function __construct()
    {
        $this->type = 'Vinyle';
    }
}