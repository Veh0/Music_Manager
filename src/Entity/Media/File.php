<?php


namespace App\Entity\Media;


class File extends Medium
{
    public function __construct()
    {
        parent::__construct();
        $this->setType('File');
        $this->setId(4);
    }
}