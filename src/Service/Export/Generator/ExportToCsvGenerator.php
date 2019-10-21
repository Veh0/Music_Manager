<?php


namespace App\Service\Export\Generator;


use App\Service\Export\ExportManagerException;

class ExportToCsvGenerator extends AbstractExportGenerator
{
    /**
     * @param array $criteria
     * @return bool
     */
    public function doesHandle(array $criteria): bool
    {
        return !empty($criteria["csv"]);
    }

    /**
     * @param array $criteria
     * @return mixed|void
     */
    public function generate(array $criteria)
    {
        $fetchTracks = $this->trackGateway->fetchAllTracks();

        $data = $this->formatData($fetchTracks);

        $fp = fopen("tracks.csv", "w");

        foreach ($data as $datum)
        {
            fputcsv($fp, $datum);
        }

        fclose($fp);
    }

}