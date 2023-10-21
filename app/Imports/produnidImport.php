<?php

namespace App\Imports;

use App\Models\Produnid;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class produnidImport implements ToModel, WithHeadingRow
{
    private $firstRow = true; // Flag para identificar la primera fila

    public function model(array $row)
    {
        if ($this->firstRow) {
            // Verificar si los nombres de los atributos coinciden con la primera fila
            $sampleRecord = Produnid::first();

            if ($sampleRecord) {
                $expectedHeaders = array_keys($sampleRecord->toArray());
                $actualHeaders = array_keys($row);

                if ($expectedHeaders === $actualHeaders) {
                    $this->firstRow = false; // Omitir la primera fila
                    return null;
                }
            }
        }

       return new Produnid([
            'cve_prod' => $row['cve_prod'],
            'unidad' => $row['unidad'],
            'factor' => $row['factor'],
            'conver' => $row['conver'],
            'codbar' => $row['codbar1']
        ]);
    }
    
    // Método para restablecer el valor de $firstRow a true antes de importar otro archivo
    public function setFirstRow($value)
    {
        $this->firstRow = $value;
    }
}