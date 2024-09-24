<?php

namespace Elcomware\LocaleMaster\Traits;

use Elcomware\LocaleMaster\LocaleMaster;

trait HasPermissions
{
    // Assuming you have a roles and permissions setup

    public function hasPermission($permission): bool
    {
        // Implement your permission logic, e.g., checking against roles
        return in_array($permission, $this->permissions()->pluck('name')->toArray());
    }

    // Add the relationship for permissions
    public function permissions()
    {
        return $this->belongsToMany(LocaleMaster::newPermissionModel()::class);
    }

}
