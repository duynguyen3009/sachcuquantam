<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class VideoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validate = [];
        foreach (config('constants.multilang') as $lang) {
            $validate[$lang.'.video_title'] = 'required|max:255';
            $validate[$lang.'.video_slug']  = ['nullable',Rule::unique('video_translation', 'video_slug')->ignore($this->video, 'video_id')];
            $validate[$lang.'.video_link'] = 'required|url';
        }
        $validate['video_position'] = 'required|numeric';

        return $validate;
    }
}
