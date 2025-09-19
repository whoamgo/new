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
        'action_url'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Step validation rules
    public static function getStepValidationRules($step)
    {
        switch ($step) {
            case 1:
                return [
                    'title' => 'required|string|max:255',
                    'objective' => 'required|string|max:50',
                    'description' => 'required|string',
                    'start_date' => 'required|date|after_or_equal:today',
                    'end_date' => 'required|date|after:start_date'
                ];
            case 2:
                return [
                    'age_group' => 'required|array|min:1',
                    'age_group.*' => 'required|string',
                    'gender' => 'required|array|min:1',
                    'gender.*' => 'required|string',
                    'region' => 'required|array|min:1',
                    'region.*' => 'required|string',
                    'country' => 'required|array|min:1',
                    'country.*' => 'required|string',
                    'state' => 'required|array|min:1',
                    'state.*' => 'required|string',
                    'city' => 'required|array|min:1',
                    'city.*' => 'required|string'
                ];
            case 3:
                return [
                    'ads_place_type' => 'required|string',
                    'ads_position' => 'required|string',
                    'budget_type' => 'required|string',
                    'amount' => 'required|numeric|min:0.01'
                ];
            case 4:
                return [
                    'ads_file' => 'required|file|mimes:jpg,jpeg,png,gif|max:5120', // 5MB max
                    'action_url' => 'required|url'
                ];
            default:
                return [];
        }
    }

    // Generate unique campaign code
    public static function generateCampaignCode()
    {
        do {
            $code = 'CAMP' . strtoupper(uniqid());
        } while (self::where('camp_code', $code)->exists());
        
        return $code;
    }
}