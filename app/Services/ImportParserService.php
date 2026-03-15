<?php

namespace App\Services;

use App\Models\Import;
use App\Models\ImportRow;
use Illuminate\Support\Facades\Storage;

class ImportParserService
{
    public function parse(Import $import): void
    {
        if (!Storage::disk('local')->exists($import->stored_filename)) {
            $import->update([
                'status' => 'failed',
            ]);

            return;
        }

        $filePath = Storage::disk('local')->path($import->stored_filename);

        $handle = fopen($filePath, 'r');

        if (!$handle) {
            $import->update([
                'status' => 'failed',
            ]);

            return;
        }

        $header = fgetcsv($handle, 0, ';');

        if (!$header || count($header) <= 1) {
            rewind($handle);
            $header = fgetcsv($handle, 0, ',');
        }

        if (!$header || count($header) === 0) {
            fclose($handle);

            $import->update([
                'status' => 'failed',
            ]);

            return;
        }

        $header = array_map(function ($column) {
            $column = (string) $column;
            $column = preg_replace('/^\xEF\xBB\xBF/', '', $column);

            return trim($column);
        }, $header);

        $rowNumber = 1;
        $totalRows = 0;

        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            if (count($row) <= 1) {
                $row = str_getcsv($row[0] ?? '', ',');
            }

            if ($this->isEmptyRow($row)) {
                continue;
            }

            $data = [];

            foreach ($header as $index => $column) {
                $data[$column] = isset($row[$index]) ? trim((string) $row[$index]) : null;
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

        app(ImportValidationService::class)->validate($import);
    }

    private function isEmptyRow(array $row): bool
    {
        foreach ($row as $value) {
            if (trim((string) $value) !== '') {
                return false;
            }
        }

        return true;
    }
}
