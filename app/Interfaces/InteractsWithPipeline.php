<?php

namespace App\Interfaces;

use Closure;

interface InteractsWithPipeline
{

    /**
     * @param mixed $data 
     * @param Closure $next 
     * @return mixed 
     */
    public function handle(mixed $data, \Closure $next);
    
}
