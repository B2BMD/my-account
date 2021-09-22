<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tracking extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'case_number' => $this->case_number,
            'shipment_provider' => $this->shipment_provider,
            'shipment_tracking_number' => $this->shipment_tracking_number,
            'tracking_history' => $this->tracking_history,
            'geolocation_id' => $this->geolocation_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
