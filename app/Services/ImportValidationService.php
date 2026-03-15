<?php

namespace App\Services;

use App\Models\Import;
use App\Models\ImportRow;

class ImportValidationService
{
    public function validate(Import $import): void
    {
        $rows = ImportRow::where('import_id', $import->id)->get();

        $valid = 0;
        $invalid = 0;
        $suspicious = 0;

        foreach ($rows as $row) {

            $data = $row->raw_data ?? [];

            $name = $this->extract($data, ['nome', 'name', 'nome completo']);
            $email = $this->extract($data, ['email', 'e-mail']);
            $phone = $this->extract($data, ['telefone', 'phone', 'celular', 'whatsapp']);

            $status = 'valid';
            $errors = [];

            if (!$this->validName($name)) {
                $status = 'invalid';
                $errors[] = 'Nome inválido';
            }

            if ($email && !$this->validEmail($email)) {
                $status = 'invalid';
                $errors[] = 'Email inválido';
            }

            if ($phone && !$this->validPhone($phone)) {
                $status = 'suspicious';
                $errors[] = 'Telefone suspeito';
            }

            $row->update([
                'status' => $status,
                'validation_errors' => $errors ? json_encode($errors) : null
            ]);

            if ($status === 'valid') $valid++;
            if ($status === 'invalid') $invalid++;
            if ($status === 'suspicious') $suspicious++;
        }

        $import->update([
            'valid_rows' => $valid,
            'invalid_rows' => $invalid,
            'suspicious_rows' => $suspicious,
            'status' => 'processed',
            'processed_at' => now(),
        ]);
    }

    private function extract(array $data, array $keys)
    {
        foreach ($data as $column => $value) {

            $normalized = strtolower(trim($column));

            foreach ($keys as $key) {
                if ($normalized === $key) {
                    return trim((string)$value);
                }
            }
        }

        return null;
    }

    private function validName(?string $name): bool
    {
        if (!$name) return false;

        if (strlen($name) < 3) return false;

        if (preg_match('/^(aaa|teste|asdf)$/i', $name)) return false;

        return true;
    }

    private function validEmail(?string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function validPhone(?string $phone): bool
    {
        $digits = preg_replace('/\D/', '', $phone);

        if (strlen($digits) < 10) return false;

        if (preg_match('/^(.)\1+$/', $digits)) return false;

        return true;
    }
}
