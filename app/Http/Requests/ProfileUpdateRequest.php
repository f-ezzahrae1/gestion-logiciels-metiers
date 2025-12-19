<?php

namespace App\Http\Requests;

use App\Models\Utilisateur; // Assuming your User model is named 'Utilisateur'
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['string', 'max:255'],
            'prenom' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(Utilisateur::class)->ignore($this->user()->id_utilisateur)],
                        Rule::unique(Utilisateur::class)->ignore($this->user()->id_utilisateur, 'id_utilisateur'),

        ];
    }
}