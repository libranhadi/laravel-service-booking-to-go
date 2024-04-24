<?php

namespace App\Http\Requests;

use App\Models\Nationality;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerValidationRequest extends FormRequest
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
        return [
            'cst_name' => 'required',
            'cst_dob' => 'required|date',
            'cst_phoneNum' => 'required',
            'cst_email' => 'required',
            'nationality_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        $fail('Kolom kewarganegaraan harus di isi.');
                    } else {
                        $exists = Nationality::where('nationality_id', $value)->exists();
                        if (!$exists) {
                            $fail('Kolom kewarganegaraan yang dipilih tidak valid.');
                        }
                    }
                },
            ],
            'family_lists' => 'required',
            'family_lists.*.fl_name' => 'required',
            'family_lists.*.fl_relation' => 'required',
            'family_lists.*.fl_dob' => 'required|date',
        ];
    }


    public function messages()
    {
        return [
            'cst_name.required' => "Kolom nama customer harus di isi.",
            'cst_phoneNum.required' => "Kolom nomor telepon harus di isi.",
            'cst_email.required' => "Kolom email harus di isi.",
            'cst_dob.required' => "Kolom tanggal lahir harus di isi.",
            'cst_dob.date' => "Kolom tanggal lahir harus beruba tanggal.",
            'nationality_id.required' => "Kolom kewarganegaraan harus di isi.",
            'nationality_id.exists' => "Kolom kewarganegaraan yang dipilih tidak valid",
            'family_lists.*.fl_name.required' => 'Nama dalam table list keluarga harus diisi.',
            'family_lists.*.fl_relation.required' => 'Hubungan dalam table list keluarga harus diisi.',
            'family_lists.*.fl_dob.required' => 'Tanggal lahir dalam table list keluarga harus diisi.',
            'family_lists.required' => "Table list keluarga harus di isi.",

        ];
    }
}
