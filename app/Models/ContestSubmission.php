<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContestSubmission extends Model
{
    protected $fillable = [
        'nom_prenom',
        'email',
        'telephone',
        'statut',
        'activite',
        'besoins',
        'budget',
        'deadline',
        'message',
        'consent_rgpd',
        'opt_in_marketing',
        'utm_source',
        'utm_medium',
        'utm_campaign',
    ];

    protected $casts = [
        'consent_rgpd' => 'boolean',
        'opt_in_marketing' => 'boolean',
    ];
}
