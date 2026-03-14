<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    protected $fillable = [
        'company_id',
        'full_name',
        'email',
        'phone',
        'birth_date',
        'age',
        'gender',
        'city',
        'state',
        'profession',
        'bank_name',
        'bank_segment',
        'notes',
        'validation_status',
        'validation_score',
        'validation_reasons_json',
        'first_seen_at',
        'last_seen_at',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'first_seen_at' => 'datetime',
            'last_seen_at' => 'datetime',
            'validation_reasons_json' => 'array',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(
            ContactList::class,
            'contact_list_items'
        )->withTimestamps();
    }

    public function events(): HasMany
    {
        return $this->hasMany(ContactEvent::class);
    }
}
