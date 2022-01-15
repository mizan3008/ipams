<?php

namespace App\Listeners;

use App\Models\UserAccessLog;
use Exception;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        try {
            UserAccessLog::create([
                'user_id' => auth()->user()->id,
                'login_method' => 'login',
                'ip_address' => getClientIp(),
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                'login_datetime' => now(),
            ]);
        } catch (Exception $ex) {
            Log::error($ex);
        }
    }
}
