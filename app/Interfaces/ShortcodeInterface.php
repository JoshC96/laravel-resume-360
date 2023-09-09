<?php

namespace App\Interfaces;

interface ShortcodeInterface extends InteractsWithPipeline
{

    /**
     * Key for the shortcode, the needle in the haystack.
     * 
     * @return string 
     */
    public function getKey(): string;

    /**
     * @return string 
     */
    public function getLabel(): string;

    /**
     * Handles replacing the needle in the haystack with a given value. 
     * 
     * @param string $data 
     * @param string $value 
     * @return string 
     */
    public function replace(string $data, string $value): string;
}
