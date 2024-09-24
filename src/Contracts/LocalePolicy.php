<?php

namespace Elcomware\LocaleMaster\Contracts;

use Elcomware\LocaleMaster\Models\Locale;

interface LocalePolicy
{
    /**
     * Locale creating Policy .
     */
    public function create(LocaleUser $user, Locale $locale): bool;

    /**
     * Locale viewing Policy .
     */
    public function view(LocaleUser $user, Locale $locale): bool;

    /**
     * Locale viewAny Policy .
     */
    public function viewAny(LocaleUser $user, Locale $locale): bool;

    /**
     * Locale update Policy .
     */
    public function update(LocaleUser $user, Locale $locale): bool;

    /**
     * Locale delete Policy .
     */
    public function delete(LocaleUser $user, Locale $locale): bool;
}
