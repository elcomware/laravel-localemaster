<?php

namespace Elcomware\LocaleMaster\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LocaleMasterModel extends model
{
    /**
     * @var int|mixed|string|null
     */
    public mixed $creator;

    /**
     * @var int|mixed|string|null
     */
    public mixed $last_editor;

    /**
     * @var int|mixed
     */
    public mixed $version;

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (LocaleMasterModel $model) {

            if (Auth::check()) {
                $model->creator = Auth::id();
                $model->last_editor = Auth::id();
            }
            $model->version = 1;
        });

        static::updating(function (LocaleMasterModel $model) {
            if (Auth::check()) {
                $model->last_editor = Auth::id();
            }
            $model->version++;
        });
    }
}
