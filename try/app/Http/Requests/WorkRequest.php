<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:100|min:3',
            'path_img' => 'image|max:5120',
            'subject' => 'required|max:100|min:3',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'post' => 'required|numeric|min:1',
            'collaborators' => 'required|min:1|max:10',
            'description' => 'max:100|min:10'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.max' => 'Il titolo non può superare i 100 caratteri.',
            'title.min' => 'Il titolo deve avere almeno 3 caratteri.',

            'path_img.image' => 'Il file caricato deve essere un\'immagine.',
            'path_img.max' => 'L\'immagine non deve superare i 5 MB.',

            'subject.required' => 'Il soggetto è obbligatorio.',
            'subject.max' => 'Il soggetto non può superare i 100 caratteri.',
            'subject.min' => 'Il soggetto deve avere almeno 3 caratteri.',

            'start_date.required' => 'La data di inizio è obbligatoria.',
            'start_date.date' => 'Inserisci una data valida per la data di inizio.',

            'end_date.date' => 'Inserisci una data valida per la data di fine.',

            'post.required' => 'Il numero di post è obbligatorio.',
            'post.numeric' => 'Il campo post deve essere un numero.',
            'post.min' => 'Il numero di post deve essere almeno 1.',

            'collaborators.required' => 'Il numero di collaboratori è obbligatorio.',
            'collaborators.min' => 'Deve esserci almeno 1 collaboratore.',
            'collaborators.max' => 'Non puoi avere più di 10 collaboratori.',

            'description.max' => 'La descrizione non può superare i 100 caratteri.',
            'description.min' => 'La descrizione deve avere almeno 10 caratteri.',
        ];
    }
}
