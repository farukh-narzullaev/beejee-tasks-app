<?php

namespace Framework\Form;

class FormValidator
{
    public static function validate(ElementInterface $element)
    {
        $value  = $element->getValue();
        $errors = [];

        foreach ($element->getRules() as $rule) {
            switch ($rule) {
                case 'NotBlank':
                    $value = filter_var($value, FILTER_SANITIZE_STRING);

                    if ('' === $value) {
                        $errors[] = "This field cannot be blank.";
                    }
                    break;
                case 'Email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "The email is invalid.";
                    }
                    break;
            }
        }

        return $errors;
    }
}
