<?php

namespace Elcomware\LocaleMaster\Contracts;

interface LocaleUser
{
    /**
     * Check if the user has a specific permission.
     */
    public function hasLocalePermission(string $permission): bool;
}
