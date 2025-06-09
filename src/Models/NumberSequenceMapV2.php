<?php
namespace Amy\Numbersequence\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NumberSequenceMapV2 extends Model {
 use HasFactory;

 protected $table = 'number_sequence_map';
 protected $guarded =[];
  public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function number_sequence()
    {
        return $this->belongsTo(NumberSequenceV2::class, 'number_sequence_id');
    }
}
