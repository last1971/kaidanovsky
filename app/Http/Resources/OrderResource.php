<?php

namespace App\Http\Resources;

use App\Services\ModulBankService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'merchant' => $this->merchant,
            'amount' => $this->amount,
            'order_id' => $this->id,
            'description' => $this->description,
            'success_url' => route('success'),
            'testing' => $this->testing,
            'callback_on_failure' => 1,
            'client_phone' => $this->phone,
            'client_name' => $this->name,
            'client_email' => $this->email,
            'unix_timestamp' => $this->unix_timestamp,
            'salt' => $this->salt,
        ];
    }

    /**
     * @param ModulBankService $service
     * @return string
     */
    public function getSignature(): string
    {
        $service = new ModulBankService();
        return $service->getSignature($this->toArray(request()));
    }
}
