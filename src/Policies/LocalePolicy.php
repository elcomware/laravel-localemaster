<?php

namespace Elcomware\LocaleMaster\Policies;

use Elcomware\LocaleMaster\Contracts\LocaleUser;
use Elcomware\LocaleMaster\LocaleMaster;
use Elcomware\LocaleMaster\Models\Locale;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocalePolicy implements \Elcomware\LocaleMaster\Contracts\LocalePolicy
{
    use HandlesAuthorization;


    public function create(LocaleUser $user, Locale $locale): bool
    {
        return $user->hasLocalePermission(LocaleMaster::permissions()['create']);
    }

    public function view(LocaleUser $user, Locale $locale): bool
    {
        return $user->hasLocalePermission(LocaleMaster::permissions()['view']);
    }

    public function viewAny(LocaleUser $user, Locale $locale): bool
    {
        return $user->hasLocalePermission(LocaleMaster::permissions()['viewAny']);
    }

    public function update(LocaleUser $user, Locale $locale): bool
    {
        return $user->hasLocalePermission(LocaleMaster::permissions()['update']);
    }

    public function delete(LocaleUser $user, Locale $locale): bool
    {
        return $user->hasLocalePermission(LocaleMaster::permissions()['delete']);
    }
}
