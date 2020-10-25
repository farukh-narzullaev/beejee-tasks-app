<?php
/**
 * @var array                $tasks
 * @var int                  $page
 * @var \Framework\Paginator $paginator
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Tasks</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <?php include realpath(__DIR__.'/../partials/_navbar.php'); ?>

        <div class="row">
            <div class="col-md-12">

                <div class="mt-2 mb-2">
                    <a href="/tasks/create" class="btn btn-sm btn-outline-primary">Add Task</a>
                </div>

                <?php if (isFlash('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo flash('success'); ?>
                    </div>
                <?php endif; ?>

                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">
                            <a href="<?php echo $paginator->sortableFieldLink('/', 'name'); ?>">Name</a>
                        </th>

                        <th scope="col">
                            <a href="<?php echo $paginator->sortableFieldLink('/', 'email'); ?>">Email</a>
                        </th>

                        <th scope="col">Text</th>

                        <th scope="col">
                            <a href="<?php echo $paginator->sortableFieldLink('/', 'status'); ?>">Status</a>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($paginator->getItems() as $task): ?>
                        <tr>
                            <td>
                                <?php if (user()): ?>
                                    <a href="/tasks/<?php echo $task['id']; ?>"><?php echo $task['name']; ?></a>
                                <?php else: ?>
                                    <?php echo $task['name']; ?>
                                <?php endif ?>
                            </td>
                            <td><?php echo $task['email']; ?></td>
                            <td>
                                <?php echo $task['text']; ?>
                            </td>
                            <td>
                                <?php if ($task['status']): ?>
                                    <span class="text-success">Completed</span>
                                <?php else: ?>
                                    <span class="text-danger">In progress</span>
                                <?php endif; ?>

                                <?php if ($task['is_edited_by_admin']): ?>
                                    <br>
                                    <span class="text-warning"><small>Edited by administrator</small></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation example mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($paginator->getCurrentPage() <= 1): ?>disabled<?php endif; ?>">
                            <a class="page-link"
                               href="<?php echo $paginator->getPreviousUri('/'); ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $paginator->getTotalPages(); $i++ ): ?>

                            <li class="page-item <?php if ($paginator->getCurrentPage() == $i): ?>active<?php endif; ?>">
                                <a class="page-link" href="<?php echo $paginator->getPageUri('/', $i); ?>"> <?php echo $i; ?> </a>
                            </li>

                        <?php endfor; ?>

                        <li class="page-item <?php if ($paginator->getCurrentPage() >= $paginator->getTotalPages()) { echo 'disabled'; } ?>">
                            <a class="page-link"
                               href="<?php echo $paginator->getNextUri('/'); ?>">Next</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>

</body>
</html>