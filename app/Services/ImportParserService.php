<?php

namespace App\Services;

use App\Models\Import;
use App\Models\ImportRow;

class ImportParserService
{
    public function parse(Import $import): void
    {
        $filePath = storage_path('app/' . $import->stored_filename);

        if (!file_exists($filePath)) {
            return;
        }

        $handle = fopen($filePath, 'r');

        if (!$handle) {
            return;
        }

        $header = fgetcsv($handle);

        $rowNumber = 1;
        $totalRows = 0;

        while (($row = fgetcsv($handle)) !== false) {

            $data = [];

            foreach ($header as $index => $column) {
                $data[$column] = $row[$index] ?? null;
            }

            ImportRow::create([
                'import_id' => $import->id,
                'row_number' => $rowNumber,
                'raw_data' => $data,
                'status' => 'pending',
            ]);

            $rowNumber++;
            $totalRows++;
        }

        fclose($handle);

        $import->update([
            'total_rows' => $totalRows,
            'status' => 'processing',
        ]);
    }
}
