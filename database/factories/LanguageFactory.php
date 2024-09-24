<?php

namespace Elcomware\LocaleMaster\Database\Factories;

use Elcomware\LocaleMaster\Models\Locale;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    protected $model = Locale::class;

    public function definition(): array
    {
        return [

            'code' => $this->faker->locale,
            'name' => $this->faker->languageCode,
            //'native_name'=>$this->faker->word,
            //'direction'=>$this->faker(),
            //'flag'=>$this->faker(),
            //'identifier'=>$this->faker->locale,

            //'number_separator'=>$this->faker,
            //'number_precision'=>$this->faker,
            //'number_max_precision'=>$this->faker,

            //'currency_symbol'=>$this->faker,
            //'currency_name'=>$this->faker,
            //'currency_precision'=>$this->faker,
            //'currency_seperator'=>$this->faker,
            //'currency_max_precision'=>$this->faker,
            //'currency_first'=>$this->faker,

            //'is_active'=>$this->faker,
            //'is_default'=>$this->faker
        ];
    }
}
