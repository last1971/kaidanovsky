<?php

namespace App\Http\Requests;

use App\Models\PromoCode;
use Illuminate\Foundation\Http\FormRequest;

class PostcardRequest extends FormRequest
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
            'fromName' => 'regex:/\S+\s.+/u',
            'name' => 'regex:/\S+\s.+/u',
            'index' => 'required',
            'fromIndex' => 'required',
            'address' => 'required',
            'customText' => 'required',
            'fromAddress' => 'required',
            'email' => 'email',
            'phone' => 'regex:/[\d\-\+() ]{10,}/',
            'color' => 'in:dark,light',
            'promocode' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $promoCode = PromoCode::query()->doesntHave('order')->firstWhere('code', $value);
                        if (!$promoCode) {
                            $fail('Промокод не  действителен или устарел');
                        }
                    }
                }
             ]
        ];
    }

    protected function passedValidation()
    {
        $percent = 0;
        $promo_code_id = null;
        if ($this->promocode) {
            $promoCode = PromoCode::query()->firstWhere('code', $this->promocode);
            $percent = $promoCode->percent;
            $promo_code_id = $promoCode->id;
        }
        $amount = config('app.price') * (100 - $percent) / 100;
        $this->merge(compact('promo_code_id', 'amount'));
    }
}
