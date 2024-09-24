<?php

namespace Elcomware\LocaleMaster\Actions;

use Elcomware\LocaleMaster\Contracts\LocaleCreater;
use Elcomware\LocaleMaster\Contracts\LocaleUser;
use Elcomware\LocaleMaster\Events\LocaleCreated;
use Elcomware\LocaleMaster\Events\LocaleCreating;
use Elcomware\LocaleMaster\Exceptions\ExceptionCodes;
use Elcomware\LocaleMaster\LocaleMaster;
use Elcomware\LocaleMaster\Models;
use Elcomware\LocaleMaster\Validation\ValidString;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Mix;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



class CreateLocale implements LocaleCreater
{

    /**
     * Validate and create a new team for the given user.
     *
     * @param array<string, string> $input
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function create(LocaleUser $user, array $input): Models\Locale |Exception
    {

        //valide inputs
       if (!ValidString::checkArray($input))
            return new Exception(code: ExceptionCodes::REQUEST_INPUT_NOTFOUND);


        //check if authorized to create
       $allow = Gate::forUser($user)->allows(
           'create',
           Models\Locale::class
       );


        if ( $allow){

          // dispatch creating event to listeners
          LocaleCreating::dispatch($user);

          try {
              //create locale
              $locale = Models\Locale::create($input);
          }catch (Exception $e)
          {
              return $e;
          }

          //dispatch locale created event
          LocaleCreated::dispatch($locale);

          return $locale;

      }

      return new Exception(code: ExceptionCodes::ACTION_NOT_AUTHORIZED);
    }





}
