<?php

namespace App\Form;

use Framework\Form\Form;
use Framework\Form\Text;
use Framework\Form\Email;
use Framework\Form\Checkbox;
use Framework\Form\Textarea;
use Framework\Http\RequestInterface;

class EditTaskForm extends Form
{
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request);

        $this
            ->add('name', Text::class, [
                'label' => 'Task Name',
                'value' => $request->postParam('name') ?? $data['name'],
                'attr'  => [
                    'class'       => 'form-control',
                    'placeholder' => 'Mark Smith',
                ]
            ], ['NotBlank'])

            ->add('email', Email::class, [
                'label' => 'Email Address',
                'value' => $request->postParam('email') ?? $data['email'],
                'attr'  => [
                    'class'       => 'form-control',
                    'placeholder' => 'mark.smith@gmail.com',
                ]
            ], ['NotBlank', 'Email'])

            ->add('text', Textarea::class, [
                'label' => 'Task Text',
                'value' => $request->postParam('text') ?? $data['text'],
                'attr'  => [
                    'rows'        => 3,
                    'class'       => 'form-control',
                    'placeholder' => 'Task text goes here...'
                ]
            ], ['NotBlank'])

            ->add('status', Checkbox::class, [
                'label' => 'Is completed',
                'value' => $request->postParam('status') ?? $data['status'],
                'attr'  => [
                    'class' => 'form-check-input',
                ],
            ])
        ;
    }
}
