<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IpAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'ip_address' => $this->ip_address,
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at,
            'audit_logs' => AuditLogResource::collection($this->whenLoaded('auditLogs'))
        ];
    }
}
