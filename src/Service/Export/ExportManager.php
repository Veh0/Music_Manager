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
     * @param ExportGeneratorInterface $generator
     */
    public function __construct(ExportGeneratorInterface $generator)
    {
        $this->registerGenerator($generator);
    }

    /**
     * @param array $criteria
     */
    public function generateExport(array $criteria)
    {
        foreach ($this->exportGenerators as $generator)
        {
            if ($generator->doesHandle($criteria))
            {
                $generator->generate($criteria);
            }
        }

        //throw new ExportManagerException("nope");

    }

    public function registerGenerator(ExportGeneratorInterface $generator)
    {
        $this->exportGenerators[] = $generator;
    }
}