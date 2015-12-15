<?php namespace Msamec\QandidateLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model{

    protected $table 	= 'qandidate_conditions';
	public $fillable 	= ['toggle_id', 'name', 'key', 'operator', 'value'];

    public function toggle()
    {
        return $this->belongsTo('Msamec\QandidateLaravel\Models\Toggle');
    }
}
