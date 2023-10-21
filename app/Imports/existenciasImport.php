<?php

namespace App\Imports;

use App\Models\Existencias;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class existenciasImport implements ToModel, WithHeadingRow
{
    private $firstRow = true; // Flag para identificar la primera fila

    public function model(array $row)
    {

        if ($this->firstRow) {
            // Verificar si los nombres de los atributos coinciden con la primera fila
            $sampleRecord = existencias::first();

            if ($sampleRecord) {
                $expectedHeaders = array_keys($sampleRecord->toArray());
                $actualHeaders = array_keys($row);

                if ($expectedHeaders === $actualHeaders) {
                    $this->firstRow = false; // Omitir la primera fila
                    return null;
                }
            }
        }


        return new Existencias([
            'lugar' => $row['lugar'],
            'cve_prod' => $row['cve_prod'],
            'existencia' => $row['existencia'],
            'costo' => $row['costo'],
            'desc_prod' => $row['desc_prod'],
            'cse_prod' => $row['cse_prod'],
            'cve_tial' => $row['cve_tial'],
            'codbar' => $row['codbar'],
            'uni_med' => $row['uni_med'],
            'des_lug' => $row['des_lug'],
            'des_tial' => $row['des_tial'],
        ]);
    }
    // Método para restablecer el valor de $firstRow a true antes de importar otro archivo
    public function setFirstRow($value)
    {
        $this->firstRow = $value;
    }
}
