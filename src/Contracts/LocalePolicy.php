<?php

namespace Elcomware\LocaleMaster\Contracts;

use Elcomware\LocaleMaster\Models\Locale;

interface LocalePolicy
{

    /**
     * Locale creating Policy .
     *
     * @param LocaleUser $user
     * @param Locale $locale
     * @return bool
     */
    public function create(LocaleUser $user, Locale $locale): bool;

    /**
     * Locale viewing Policy .
     *
     * @param LocaleUser $user
     * @param Locale $locale
     * @return bool
     */
    public function view(LocaleUser $user, Locale $locale): bool;

    /**
     * Locale viewAny Policy .
     *
     * @param LocaleUser $user
     * @param Locale $locale
     * @return bool
     */
    public function viewAny(LocaleUser $user, Locale $locale): bool;

     /**
     * Locale update Policy .
     *
     * @param LocaleUser $user
     * @param Locale $locale
     * @return bool
     */
    public function update(LocaleUser $user, Locale $locale): bool;



    /**
     * Locale delete Policy .
     *
     * @param LocaleUser $user
     * @param Locale $locale
     * @return bool
     */
    public function delete(LocaleUser $user, Locale $locale): bool;


}
