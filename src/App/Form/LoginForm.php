<?php

namespace App\Form;

use Framework\Form\Form;
use Framework\Form\Text;
use Framework\Form\Password;
use Framework\Http\RequestInterface;

class LoginForm extends Form
{
    public function __construct(RequestInterface $request)
    {
        parent::__construct($request);

        $this
            ->add('username', Text::class, [
                'label' => 'Username',
                'value' => $request->postParam('username'),
                'attr'  => [
                    'class'       => 'form-control',
                    'placeholder' => 'admin',
                ]

            ], ['NotBlank'])

            ->add('password', Password::class, [
                'label' => 'Username',
                'value' => $request->postParam('password'),
                'attr'  => [
                    'class'       => 'form-control',
                    'placeholder' => '123',
                ]
            ], ['NotBlank'])
        ;
    }
}
