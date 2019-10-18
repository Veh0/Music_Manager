<?php


namespace App\Entity\Media;


class Digital extends AbstractMedium
{
    public function __construct()
    {
        $this->type = 'File';
    }
}