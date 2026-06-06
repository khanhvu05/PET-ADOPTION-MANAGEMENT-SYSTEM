<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignActivity extends Model
{
    use HasFactory;
    
    protected $table = 'campaign_activities';

    protected $fillable = [
        'campaign_id',
        'user_id',
        'action',
        'description'
    ];

    public function campaign()
    {
        return $this->belongsTo(DonationCampaign::class, 'campaign_id', 'Ma_chien_dich');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'Ma_nguoi_dung');
    }
}
