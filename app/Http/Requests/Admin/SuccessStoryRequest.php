<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SuccessStoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|unique:success_stories,title,'.$this->id,
            'description' => 'required',
            'video_file'     => 'nullable|file|mimes:mp4,mov,ogg,webm,mkv|max:102400',
            'video_media_id' => 'nullable',
            'video'          => 'nullable|string',
            'media_type'     => 'nullable|string|in:image,video',
        ];
    }
}
