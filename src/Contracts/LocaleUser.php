<?php

namespace Elcomware\LocaleMaster\Contracts;

interface LocaleUser
{

    /**
     * Check if the user has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    public function hasLocalePermission(string $permission): bool;


}
