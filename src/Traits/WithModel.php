<?php

namespace Bastinald\LaravelLivewireModel\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

trait WithModel
{
    public $model = [];

    public function getModel($key = null, $default = null)
    {
        if (is_array($key)) {
            return Arr::only($this->model, $key);
        } else if ($key) {
            return Arr::get($this->model, $key, $default);
        } else {
            return collect($this->model);
        }
    }

    public function setModel($key, $value = null)
    {
        if ($key instanceof Model) {
            $key = $key->toArray();
        }

        if (is_array($key)) {
            foreach ($key as $arrayKey => $arrayValue) {
                Arr::set($this->model, $arrayKey, $arrayValue);
            }
        } else {
            Arr::set($this->model, $key, $value);
        }
    }

    public function validateModel($rules = null)
    {
        $validator = Validator::make($this->model, $rules ?? $this->getRules());
        $validatedModel = $validator->validate();

        $this->resetErrorBag();

        return $validatedModel;
    }
}
