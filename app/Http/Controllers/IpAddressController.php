<?php

namespace App\Http\Controllers;

use App\Http\Requests\IPAddress\StoreIpAddressRequest;
use App\Http\Requests\IPAddress\UpdateIpAddressRequest;
use App\Http\Resources\IpAddressResource;
use App\Models\AuditLog;
use App\Models\IpAddress;
use App\Services\IPAddressService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IpAddressController extends Controller
{
    private $ipAddressService;

    public function __construct(IPAddressService $ipAddressService)
    {
        $this->ipAddressService = $ipAddressService;
    }

    public function index(Request $request)
    {
        $this->authorize('index', IpAddress::class);

        $ipAddresses = $this->ipAddressService->lists($request->all());

        return Inertia::render('IPAddress/Index', [
            'ipAddresses' => $ipAddresses,
            'filters' => $request->all(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', IpAddress::class);

        return Inertia::render('IPAddress/Create');
    }

    public function store(StoreIpAddressRequest $request)
    {
        $this->authorize('create', IpAddress::class);

        $validated_data = $request->validated();

        $response = $this->ipAddressService->updateOrCreate($validated_data, null);

        if (is_null($response)) {
            $request->session()->flash('status', [
                'class' => 'danger',
                'message' => 'IP Address has not successfully created.'
            ]);
        } else {
            $request->session()->flash('status', [
                'class' => 'success',
                'message' => 'IP Address has been successfully created.'
            ]);
        }

        return redirect('ip-address');
    }

    public function show(IpAddress $ipAddress)
    {
        $this->authorize('view', $ipAddress);

        $ipAddress->load('auditLogs');

        return Inertia::render('IPAddress/View', [
            'ip_address' => new IpAddressResource($ipAddress)
        ]);
    }

    public function edit(IpAddress $ipAddress)
    {
        $this->authorize('update', $ipAddress);

        return Inertia::render('IPAddress/Edit', [
            'ip_address' => new IpAddressResource($ipAddress)
        ]);
    }

    public function update(UpdateIpAddressRequest $request, IpAddress $ipAddress)
    {
        $this->authorize('update', $ipAddress);

        $validated_data = $request->validated();

        $response = $this->ipAddressService->updateOrCreate($validated_data, $ipAddress);

        if (is_null($response)) {
            $request->session()->flash('status', [
                'class' => 'danger',
                'message' => 'IP Address has not successfully updated.'
            ]);
        } else {
            $request->session()->flash('status', [
                'class' => 'success',
                'message' => 'IP Address has been successfully updated.'
            ]);
        }

        return redirect('ip-address');
    }

    public function destroy(IpAddress $ipAddress)
    {
        //
    }
}
