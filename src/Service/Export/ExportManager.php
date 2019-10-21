<?php


namespace App\Service\Export;


use App\Service\Export\Generator\ExportGeneratorInterface;
use App\Service\Export\ExportManagerException;

class ExportManager
{
    /**
     * @var array
     */
    protected $exportGenerators = [];

    /**
     * ExportManager constructor.
     * @param ExportGeneratorInterface[] $generators
     */
    public function __construct(ExportGeneratorInterface ...$generators)
    {
        foreach($generators as $generator) $this->registerGenerator($generator);
    }

    /**
     * @param array $criteria
     * @return mixed
     * @throws \App\Service\Export\ExportManagerException
     */
    public function generateExport(array $criteria)
    {
        foreach ($this->exportGenerators as $generator)
        {
            if ($generator->doesHandle($criteria))
            {
                return $generator->generate($criteria);
            }
        }

       throw new ExportManagerException("nope");

    }

    public function registerGenerator(ExportGeneratorInterface $generator)
    {
        $this->exportGenerators[] = $generator;
    }
}