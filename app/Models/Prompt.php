<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prompt extends Model {

    public const PREMIUM_MAKE_COVER_LETTER = 'Use the following JSON data to create a cover letter for a job role as {{role}}. The "name" key of the JSON is the applicants name, use this in the letter. The letter should be addressed to {{entity_contact}} {{data}}';
    public const STANDARD_MAKE_COVER_LETTER = 'Use the following JSON data to create a cover letter for a job role as {{role}}. The letter should be addressed to {{entity-contact}} {{data}}';
    public const STANDARD_TEST = 'What is a comedian name for someone with the name {{user-name}}';
}