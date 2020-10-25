<?php

namespace Framework\Form;

abstract class Element implements ElementInterface
{
    protected $name;
    protected $attributes;
    protected $errors;
    protected $rules;

    public function __construct($name, $attributes, $rules = [])
    {
        $this->name       = $name;
        $this->attributes = $attributes;
        $this->rules      = $rules;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->attributes['value'];
    }

    public function getRules()
    {
        return $this->rules;
    }

    protected function getLabelName()
    {
        return array_key_exists('label', $this->attributes)
            ? $this->attributes['label']
            : ucfirst($this->name);
    }

    protected function transformAttributes()
    {
        if (null !== $this->errors) {
            $class = $this->attributes['attr']['class'];

            $this->attributes['attr']['class'] = (!empty($this->errors))
                ? $class . ' is-invalid'
                : $class . ' is-valid';
        }

        return join(' ', array_map(function ($key) {
            return "{$key}=\"{$this->attributes['attr'][$key]}\"";
        }, array_keys($this->attributes['attr'])));
    }

    public function addErrors($errors)
    {
        $this->errors = $errors;
    }

    public function errors()
    {
        $messages = '';

        if (null === $this->errors or empty($this->errors)) {
            echo $messages;
        }

        foreach ($this->errors as $error) {
            $messages .= "<li>{$error}</li>";
        }

        echo <<<ERRORS
            <ul class="invalid-feedback">{$messages}</ul>
ERRORS;
    }
}
