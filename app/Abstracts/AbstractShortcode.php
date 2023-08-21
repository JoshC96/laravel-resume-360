<?php

namespace App\Abstracts;

use App\Interfaces\ShortcodeInterface;
use Illuminate\Support\Str;

abstract class AbstractShortcode implements ShortcodeInterface
{

    /**
     * @param string $data 
     * @param string $value 
     * @return string 
     */
    public function replace(string $data, string $value): string
    {
        return Str::replace("{{$this->getKey()}}", $value, $data);
    }
    
}
