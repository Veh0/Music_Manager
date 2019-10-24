<?php


namespace App\Entity\Media;


class CD extends Medium
{
    public function __construct()
    {
        parent::__construct();
        $this->setType('CD');
        $this->setId(1);
    }
}