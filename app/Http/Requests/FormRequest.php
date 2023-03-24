<?php

namespace App\Http\Requests;

use App\Traits\Format;
use App\Traits\Helper;
use App\Traits\Response;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    use Helper, Response, Format;
}
