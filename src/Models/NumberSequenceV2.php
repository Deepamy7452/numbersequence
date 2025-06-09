<?php
namespace Amy\Numbersequence\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NumberSequenceV2 extends Model {
    use HasFactory;
    protected $table = 'number_sequence';
    protected $guarded =[];


 public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
}
