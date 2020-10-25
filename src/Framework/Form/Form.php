<?php

namespace Framework\Form;

use Exception;
use Framework\Http\RequestInterface;

abstract class Form implements FormInterface
{
    private $request;
    private $elements = [];

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function add($name, $element, $attributes = [], $rules = [])
    {
        $this->elements[$name] = new $element($name, $attributes, $rules);

        return $this;
    }

    public function renderField($name)
    {
        if (!array_key_exists($name, $this->elements)) {
            throw new Exception('Unknown form field');
        }

        $this->elements[$name]->render();
    }

    public function renderErrors($name)
    {
        if (!array_key_exists($name, $this->elements)) {
            throw new Exception('Unknown form field');
        }

        $this->elements[$name]->errors();
    }

    public function isSubmitted()
    {
        return $this->request->getMethod() === 'POST';
    }

    public function isValid()
    {
        $isValid = true;
        foreach ($this->elements as $name => $element) {
            $errors = FormValidator::validate($element);

            if (!empty($errors)) {
                $isValid = false;
            }

            $element->addErrors($errors);
        }

        return $isValid;
    }
}
