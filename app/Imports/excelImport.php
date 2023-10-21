<?php

namespace App\Imports;

use App\Models\Productos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class excelImport implements ToModel, WithHeadingRow
{
    private $firstRow = true; // Flag para identificar la primera fila

    public function model(array $row)
    {
        if ($this->firstRow) {
            // Verificar si los nombres de los atributos coinciden con la primera fila
            $sampleRecord = Productos::first();

            if ($sampleRecord) {
                $expectedHeaders = array_keys($sampleRecord->toArray());
                $actualHeaders = array_keys($row);

                if ($expectedHeaders === $actualHeaders) {
                    $this->firstRow = false; // Omitir la primera fila
                    return null;
                }
            }
        }

        return new Productos([
            'cse_prod' => $row['cse_prod'],
            'cve_prod' => $row['cve_prod'],
            'sub_cse' => $row['sub_cse'],
            'sub_subcse' => $row['sub_subcse'],
            'desc_prod' => $row['desc_prod'],
            'uni_med' => $row['uni_med'],
            'cve_tial' => $row['cve_tial'],
            'costo_prod' => $row['costo_prod'],
            'codbar' => $row['codbar'],
            'factor' => $row['factor'],
            'conver' => $row['conver'],


        ]);
    }

    // Método para restablecer el valor de $firstRow a true antes de importar otro archivo
    public function setFirstRow($value)
    {
        $this->firstRow = $value;
    }
}
