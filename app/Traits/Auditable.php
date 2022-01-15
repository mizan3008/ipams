<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function (Model $model) {
            self::audit('created', $model);
        });

        static::updated(function (Model $model) {
            self::audit('updated', $model);
        });

        static::deleted(function (Model $model) {
            self::audit('deleted', $model);
        });
    }

    protected static function audit($event, $model)
    {
        if (config("app.env") === "testing") {
            return false;
        }

        $original = $model->getOriginal();
        $changes = $model->toArray();

        $original = $model->getOriginal();
        $changes = $model->toArray();

        $data = [
            "original" => $original,
            "changes" => $changes,
            "user_agent" => request()->Header('User-Agent'),
            "network_ip" => getClientIp(),
        ];

        AuditLog::create([
            "auditable_type" => get_class($model),
            "auditable_id" => $model->id,
            "event" => strtoupper($event),
            "data" => json_encode($data),
            "created_by" => isset(auth()->user()->id) ? auth()->user()->id : 0
        ]);
    }
}
