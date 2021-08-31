# Laravel Livewire Model

This package contains a trait which makes Laravel Livewire form data model manipulation a breeze. No more having to create a Livewire component property for every single form input. All form data will be placed inside the `$model` property array.

## Documentation

- [Installation](#installation)
- [Usage](#usage)
    - [The WithModel Trait](#the-withmodel-trait)
    - [Getting Model Data](#getting-model-data)
    - [Setting Model Data](#setting-model-data)
    - [Binding Model Data](#binding-model-data)
    - [Validating Model Data](#validating-model-data)

## Installation

Require the package via composer:

```console
composer require bastinald/laravel-livewire-model
```

## Usage

### The WithModel Trait

Add the `WithModel` trait to your Livewire components:

```php
class Login extends Component
{
    use WithModel;
    
    //
}
```

### Getting Model Data

Get the model data as an array:

```php
$array = $this->model;
```

Get the model data as a collection:

```php
$collection = $this->model();
```

### Setting Model Data

Set a single value:

```php
$this->model['name'] = 'Kevin';
```

Set values using Eloquent model data:

```php
$this->model = User::first()->toArray();
```

Set values using an array:

```php
$this->model = [
    'name' => 'Kevin',
    'email' => 'kevin@example.com',
];
```

### Binding Model Data

Just prepend your `wire:model` attribute with `model.`:

```html
<input 
    type="email" 
    placeholder="{{ __('Email') }}"
    class="form-control" 
    wire:model.defer="model.email"
>
```

### Validating Model Data

Use the `validateModel` method to validate model data:

```php
$this->validateModel([
    'name' => ['required'],
    'email' => ['required', 'email'],
]);
```

This method works just like the Livewire `validate` method, so you can specify your rules in a separate `rules` method if you prefer.
