<?php


namespace App\Service\Export\Generator;


use App\Service\Export\ExportManagerException;

interface ExportGeneratorInterface
{
    /**
     * @param array $criteria
     * @return bool
     */
    public function doesHandle(array $criteria) : bool;

    /**
     * @param array $criteria
     * @return mixed
     * @throws ExportManagerException
     */
    public function generate(array $criteria);
}