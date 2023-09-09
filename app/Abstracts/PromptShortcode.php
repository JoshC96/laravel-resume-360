<?php

namespace App\Abstracts;

use App\Pipelines\Prompts\PromptPayload;
use Illuminate\Support\Str;

abstract class PromptShortcode extends AbstractShortcode
{

    protected abstract function getValue(PromptPayload $payload): string;

    public function handle(mixed $data, \Closure $next)
    {
        $data['message'] = Str::contains($data['message'], "{{{$this->getKey()}}}")
            ? $this->replace($data['message'], $this->getValue($data['payload']))
            : $data['message'];

        $next($data);
    }
}
