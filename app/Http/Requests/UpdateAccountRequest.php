<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class UpdateAccountRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize() {
            return \Auth::check();
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, array>
         */
        public function rules() {
            return [
                'name' => ['string'],
                'phone' => ['string', 'min:10'],
                'email' => [
                    'email',
                    Rule::unique('users')->ignore(\Auth::user()->id)
                ],
                'password' => ['min:8'],
            ];
        }
    }
