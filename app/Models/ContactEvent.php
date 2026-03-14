<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactEvent extends Model
{
    protected $fillable = [
        'company_id',
        'contact_id',
        'organization_id',
        'contact_list_id',
        'event_type',
        'event_date',
        'notes',
        'metadata_json',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'metadata_json' => 'array',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function contactList(): BelongsTo
    {
        return $this->belongsTo(ContactList::class);
    }
}
