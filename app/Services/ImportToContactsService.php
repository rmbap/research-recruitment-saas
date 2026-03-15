<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Import;
use App\Models\ImportRow;

class ImportToContactsService
{
    public function importValidRows(Import $import): int
    {
        $rows = ImportRow::where('import_id', $import->id)
            ->where('status', 'valid')
            ->get();

        $created = 0;

        foreach ($rows as $row) {
            $data = $row->raw_data ?? [];

            $name = $this->extract($data, ['nome', 'name', 'nome completo']);
            $email = $this->extract($data, ['email', 'e-mail']);
            $phone = $this->extract($data, ['telefone', 'phone', 'celular', 'whatsapp']);
            $city = $this->extract($data, ['cidade', 'city']);

            Contact::create([
                'company_id' => $import->company_id,
                'organization_id' => $import->organization_id,
                'full_name' => $name,
                'email' => $email,
                'phone' => $phone,
                'city' => $city,
                'status' => 'active',
            ]);

            $created++;
        }

        return $created;
    }

    private function extract(array $data, array $keys): ?string
    {
        foreach ($data as $column => $value) {
            $normalized = strtolower(trim((string) $column));

            foreach ($keys as $key) {
                if ($normalized === $key) {
                    $value = trim((string) $value);

                    return $value !== '' ? $value : null;
                }
            }
        }

        return null;
    }
}
