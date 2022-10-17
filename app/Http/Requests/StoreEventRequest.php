<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:500',
            'start_date' => 'required|string',
            'start_time' => 'required|string',
            'end_date' => 'required|string|after_or_equal:start_date',
            'end_time' => 'required|string',
        ];

        if ($this->filled(['start_date']) == $this->filled(['end_date'])) {
            $rule['end_time'] = 'required|string|after_or_equal:start_time';
        }

        return $rule;
    }

    protected function prepareForValidation()
    {
        $start = ($this->filled(['start_date', 'start_time'])) ? $this->start_date . ' ' . $this->start_time : '';
        $end = ($this->filled(['end_date', 'end_time'])) ? $this->end_date . ' ' . $this->end_time : '';
        $this->merge([
            'start' => $start,
            'end' => $end,
        ]);
    }
}
