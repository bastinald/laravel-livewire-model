<?php

namespace Bastinald\LaravelLivewireModel\Traits;

use Illuminate\Support\Facades\Validator;

trait WithModel
{
    public $model = [];
    private $modelCollection;

    public function model()
    {
        if (!$this->modelCollection) {
            $this->modelCollection = collect($this->model);
        }

        return $this->modelCollection;
    }

    public function validateModel($rules = null)
    {
        $validator = Validator::make($this->model, $rules ?? $this->getRules());
        $validatedModel = $validator->validate();

        $this->resetErrorBag();

        return $validatedModel;
    }
}
