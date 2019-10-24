<?php


namespace App\Entity\Media;


class Vinyle extends Medium
{
    public function __construct()
    {
        parent::__construct();
        $this->setType('Vinyle');
        $this->setId(2);
    }
}