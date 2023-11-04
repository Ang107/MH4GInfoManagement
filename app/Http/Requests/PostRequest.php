<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'post.default_level' => 'integer|nullable',
            'post.left_monster_id' => 'integer|between:2,25',
            'post.weapon_id' => 'integer|between:1,6',
            'post.armor_id' => 'integer|between:1,15',
            'post.armor_port_id' => 'integer|between:1,5',
            
        ];
    }
}
