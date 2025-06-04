<?php

namespace Amy\Numbersequence\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number_seq_MapLog extends Model
{
    use HasFactory;

    protected $table = 'number_seq_log';

    protected $guarded =[];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sequence()
    {
        return $this->belongsTo(NumberSequenceV2::class, 'sequence_id');
    }
}


