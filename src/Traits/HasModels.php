<?php

namespace Elcomware\LocaleMaster\Traits;

use Elcomware\LocaleMaster\Exceptions\ModelNotFoundException;
use Elcomware\LocaleMaster\LocaleMaster;
use Illuminate\Support\Facades\Log;

trait HasModels
{
    /**
     * Get a new instance of the user model.
     */
    public static function newUserModel(): mixed
    {
        $model = self::userModel();

        try {
            $newModel = getModel($model);
        } catch (\Exception $e) {
            // Handle the exception (e.g., log the error, display a message)
            Log::error($e->getMessage());

            return $e;
        }

        return $newModel;
    }

    /**
     * Get a new instance of the permission model.
     */
    public static function newPermissionModel(): mixed
    {
        $model = LocaleMaster::permissionModel();

        try {
            $newModel = getModel($model);
        } catch (\Exception $e) {
            // Handle the exception (e.g., log the error, display a message)
            Log::error($e->getMessage());

            return $e;
        }

        return $newModel;
    }
}

/**
 * @throws ModelNotFoundException
 */
function getModel(string $model)
{
    // Check if the class exists
    if (class_exists($model)) {
        // The model exists
        return new $model; // or return the class name if needed
    } else {
        // The model does not exist
        throw new ModelNotFoundException($model);
    }
}
