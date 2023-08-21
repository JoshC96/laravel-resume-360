<?php

namespace App\Pipelines\Prompts;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Support\Collection;
use Prompt;

class PromptPayload implements Jsonable
{

    /**
     * @param Prompt $prompt 
     * @param Collection $data 
     * @return void 
     */
    public function __construct(public Prompt $prompt, public Collection $data) {}

    /**
     * @param int $options 
     * @return string 
     * @throws InvalidCastException 
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray());
    }

    /**
     * @return array 
     * @throws InvalidCastException 
     */
    public function toArray(): array
    {
        return [
            'prompt' => $this->prompt->toArray(),
            'data' => $this->data->toArray()
        ];
    }

    /**
     * @param string $json 
     * @return PromptPayload 
     */
    public static function fromJson(string $json): PromptPayload
    {
        $object = json_decode($json, true);

        return new PromptPayload(
            $object['Prompt'],
            collect($object['data'])
        );
    }

    /**
     * @param string $key 
     * @param mixed $value 
     * @return PromptPayload 
     */
    public function set(string $key, mixed $value): PromptPayload
    {
        $this->data->put($key, $value);

        return $this;
    }

    /**
     * @param string $key 
     * @return bool 
     */
    public function has(string $key): bool
    {
        return $this->data->has($key);
    }

    /**
     * @param string $key 
     * @param mixed $default 
     * @return mixed 
     */
    public function get(string $key, mixed $default = null): mixed 
    {
        return $this->data->get($key, $default);
    }
    
}
