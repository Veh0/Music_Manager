<?php


namespace App\Entity\Media;


class CD extends AbstractMedium
{
    public function __construct()
    {
        $this->type = 'CD';
    }
}