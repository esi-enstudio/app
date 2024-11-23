<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ItopReplaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'house'         => new DdHouseResource($this->ddHouse),
            'user'          => new UserResource($this->user),
            'rso'           => new RsoResource($this->rso),
            'retailer'      => new RetailerResource($this->retailer),
            'id'            => $this->id,
            'sim_serial'    => $this->sim_serial,
            'balance'       => $this->balance,
            'reason'        => $this->reason,
            'status'        => Str::title($this->status),
            'remarks'       => $this->remarks,
            'description'   => $this->description,
        ];
    }
}
