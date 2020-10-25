<?php

namespace App\Controller;

use App\Model\Task;
use App\Form\TaskForm;
use Framework\Paginator;
use App\Form\EditTaskForm;
use Framework\Http\RequestInterface;

class TasksController extends AbstractController
{
    public function tasks(RequestInterface $request)
    {
        $page          = $request->getParam('page', 1);
        $sortableField = $request->getParam('sortableField');
        $direction     = $request->getParam('direction');

        $paginator = new Paginator(Task::class, $page, $sortableField, $direction);

        return $this->render('tasks.index', [
            'page'  => $page,
            'paginator' => $paginator,
        ]);
    }

    public function create(RequestInterface $request)
    {
        $form = new TaskForm($request);

        if ($form->isSubmitted() and $form->isValid()) {
            Task::create($request->all());

            $this->setFlash('success', 'Task has been successfully added.');

            return $this->redirect('/');
        }

        return $this->render('tasks.create', [
            'form' => $form,
        ]);
    }

    public function edit(RequestInterface $request)
    {
        if (!user()) {
            return $this->redirect('/login');
        }

        $id = $request->getAttribute('id');

        if (false === $task = Task::find($id)) {
            throw new \Exception('Task not found.');
        }

        $form = new EditTaskForm($request, $task);

        if ($form->isSubmitted() and $form->isValid()) {
            $params = [
                'id' => $id,
                'is_edited_by_admin' => $task['text'] === $request->postParam('text') ? 0 : 1
            ] + $request->all();

            Task::save($params);

            return $this->redirect('/');
        }

        return $this->render('tasks.edit', [
            'form' => $form,
        ]);
    }
}
