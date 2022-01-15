<?php

namespace App\Services;

use App\Http\Resources\IpAddressResource;
use App\Models\IpAddress;

class IPAddressService
{
    public function lists(array $data = null)
    {
        $query = IpAddress::query();

        if (isset($data['search'])) {
            $query->where(function ($q) use ($data) {
                $q->orWhere('label', 'like', "%{$data['search']}%");
                $q->orWhere('ip_address', 'like', "%{$data['search']}%");
            });
        }


        $ipAddresses = $query->with(['user'])
            ->paginate(10)
            ->withQueryString();

        return IpAddressResource::collection($ipAddresses);
    }

    /**
     * This function will handle create and update process
     * @param array $data
     * @param IpAddress $ipAddress (nullable)
     * @return IpAddress
     */
    public function updateOrCreate(array $data, ?IpAddress $ipAddress): IpAddress
    {
        if (is_null($ipAddress)) {
            $ipAddress = new IpAddress();
            $ipAddress->user_id = auth()->user()->id;
            $ipAddress->created_by = auth()->user()->id;
        } else {
            $ipAddress->updated_by = auth()->user()->id;
        }

        if (isset($data['label'])) {
            $ipAddress->label = $data['label'];
        }

        if (isset($data['ip_address'])) {
            $ipAddress->ip_address = $data['ip_address'];
        }

        $ipAddress->save();

        return $ipAddress;
    }
}
