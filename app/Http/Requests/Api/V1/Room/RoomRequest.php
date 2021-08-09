<?php

namespace App\Http\Requests\Api\V1\Room;

use App\Http\Requests\Request;

class RoomRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|min:4'
        ];
    }
}
