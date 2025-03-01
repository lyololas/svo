<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class CharityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'date_field_name' => '', 
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->date_field_name) {
            try {
                $transformedDate = Carbon::createFromFormat('m.d.Y', $this->date_field_name)->format('Y-m-d');
                $this->merge([
                    'date_field_name' => $transformedDate,
                ]);
            } catch (\Exception $e) {
                logger('Failed to parse date:', [$this->date_field_name, $e->getMessage()]);
            }
        }
    }
}
