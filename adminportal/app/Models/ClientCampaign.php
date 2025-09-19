<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCampaign extends Model
{
    use HasFactory;

    protected $table = 'client_campaign';

    protected $fillable = [
        'client_id',
        'camp_code',
        'title',
        'objective',
        'description',
        'start_date',
        'end_date',
        'age_group',
        'gender',
        'region',
        'country',
        'state',
        'city',
        'ads_place_type',
        'ads_position',
        'budget_type',
        'amount',
        'status',
        'camp_status',
        'reason',
        'step',
        'ads_file',
        'action_url',
    ];
}

