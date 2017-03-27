<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GameSettingsUpdateRequest extends FormRequest
{
    protected $redirect = "/admin/game-settings";

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'metal_rate' => 'required|max:100|numeric',
            'energy_rate' => 'required|max:100|numeric',
            'crystal_rate' => 'required|max:100|numeric',

            'ship_build_time_rate' => 'required|max:100|numeric',
            'ship_cost_rate' => 'required|max:100|numeric',

            'building_build_time_rate' => 'required|max:100|numeric',
            'building_cost_rate' => 'required|max:100|numeric',

            'research_rate' => 'required|max:100|numeric',
            'travel_rate' => 'required|max:100|numeric',
        ];
    }
}
