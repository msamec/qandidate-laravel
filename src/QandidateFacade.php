<?php namespace Msamec\QandidateLaravel;

use Illuminate\Support\Facades\Facade;

class QandidateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'qandidate';
    }
}
