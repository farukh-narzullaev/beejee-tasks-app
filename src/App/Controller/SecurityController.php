<?php

namespace App\Controller;

use Exception;
use App\Form\LoginForm;
use Framework\Http\RequestInterface;
use Framework\Security\Authenticator;

class SecurityController extends AbstractController
{
    public function login(RequestInterface $request)
    {
        if (user()) {
            return $this->redirect('/');
        }

        $form = new LoginForm($request);

        if ($form->isSubmitted() and $form->isValid()) {
            try {
                Authenticator::auth($request->postParam('username'), $request->postParam('password'));
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());

                return $this->redirect('/login');
            }

            return $this->redirect('/');
        }

        return $this->render('users.login', [
            'form' => $form,
        ]);
    }

    public function logout()
    {
        unset($_SESSION['user']);

        return $this->redirect('/');
    }
}
