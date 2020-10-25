<?php

namespace App\Form;

use Framework\Form\Form;
use Framework\Form\Text;
use Framework\Form\Email;
use Framework\Form\Textarea;
use Framework\Http\RequestInterface;

class TaskForm extends Form
{
    public function __construct(RequestInterface $request)
    {
        parent::__construct($request);

        $this
            ->add('name', Text::class, [
                'label' => 'Task Name',
                'value' => $request->postParam('name'),
                'attr'  => [
                    'class'       => 'form-control',
                    'placeholder' => 'Mark Smith',
                ]
            ], ['NotBlank'])

            ->add('email', Email::class, [
                'label' => 'Email Address',
                'value' => $request->postParam('email'),
                'attr'  => [
                    'class'       => 'form-control',
                    'placeholder' => 'mark.smith@gmail.com',
                ]
            ], ['NotBlank', 'Email'])

            ->add('text', Textarea::class, [
                'label' => 'Task Text',
                'value' => $request->postParam('text'),
                'attr'  => [
                    'rows'        => 3,
                    'class'       => 'form-control',
                    'placeholder' => 'Task text goes here...'
                ]
            ], ['NotBlank'])
        ;
    }
}
