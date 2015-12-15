<?php namespace Msamec\QandidateLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Toggle extends Model{

    protected $table 	= 'qandidate_toggles';
	public $fillable 	= ['name', 'status'];

    public function conditions()
    {
        return $this->hasMany('Msamec\QandidateLaravel\Models\Condition');
    }
}
