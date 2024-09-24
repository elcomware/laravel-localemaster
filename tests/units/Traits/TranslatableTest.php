<?php

use Elcomware\LocaleMaster\Models\LocaleMasterModel;
use Elcomware\LocaleMaster\Models\User;
use Illuminate\Support\Facades\Auth;

beforeEach(function () {
    $this->user = User::factory()->create();
    Auth::login($this->user);
    $this->model = new class extends LocaleMasterModel
    {
        use \Elcomware\LocaleMaster\Traits\Translatable;

        protected $table = 'test_models';

        protected $casts = [
            'field1' => 'array', // Automatically cast JSON to array
            'field2' => 'array', // Automatically cast JSON to array
        ];

        /*public array $translationFields = [
            'field1','field2'
        ];*/

        public function __construct()
        {
            parent::__construct();
            $this->translationFields = ['field1', 'field2'];
        }
    };
    $this->model->name = 'John';
});

it('sets single translations correctly', function () {

    //arrange and act
    $this->model->setTranslation('field1', 'en', 'Hello');
    $this->model->save();

    //asset

    // Retrieve from database
    $dbModel = $this->model::find(1);
    expect($dbModel->name)->toBe('John') and
    expect($dbModel->field1['en'])->toBe('Hello');

});

it('sets multiple translations correctly', function () {

    //arrange and act
    $this->model->setTranslations('field1',
        [
            'fr' => 'Bonjour',
            'en' => 'Hello',
        ]);
    $this->model->setTranslations('field2',
        [
            'fr' => 'Au revoir',
            'en' => 'Goodbye',
        ]);

    $this->model->save();

    //asset

    // Retrieve from database
    $dbModel = $this->model::find(1);
    expect($dbModel->name)->toBe('John');
    expect($dbModel->field1['en'])->toBe('Hello') and
    expect($dbModel->field1['fr'])->toBe('Bonjour');

    expect($dbModel->field2['en'])->toBe('Goodbye') and
    expect($dbModel->field2['fr'])->toBe('Au revoir');

});

it('gets single translations correctly', function () {

    //arrange
    $this->model->setTranslation('field1', 'en', 'Hello');
    $this->model->save();
    // act
    $data = $this->model->getTranslation('field1', 'en');
    //asset
    expect($data)->toBe('Hello');

});

it('gets multiple translations correctly', function () {

    //arrange and act
    $this->model->setTranslations('field1',
        [
            'fr' => 'Bonjour',
            'en' => 'Hello',
        ]);
    $this->model->setTranslations('field2',
        [
            'fr' => 'Au revoir',
            'en' => 'Goodbye',
        ]);
    $this->model->save();

    // act
    $data1 = $this->model->getTranslations('field1');

    $data2 = $this->model->getTranslations('field2');

    //asset

    // Retrieve from database
    expect($data1['en'])->toBe('Hello') and
    expect($data1['fr'])->toBe('Bonjour');

    expect($data2['en'])->toBe('Goodbye') and
    expect($data2['fr'])->toBe('Au revoir');

});
