<?php
/**
 * @var Framework\Form\FormInterface $form
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Edit Task</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <?php include realpath(__DIR__.'/../partials/_navbar.php'); ?>

        <div class="row">
            <div class="col-md-6">

                <form method="post" class="mt-3">

                    <div class="form-group">
                        <?php $form->renderField('name'); ?>
                        <?php $form->renderErrors('name'); ?>
                    </div>

                    <div class="form-group">
                        <?php $form->renderField('email'); ?>
                        <?php $form->renderErrors('email'); ?>
                    </div>

                    <div class="form-group">
                        <?php $form->renderField('text'); ?>
                        <?php $form->renderErrors('text'); ?>
                    </div>

                    <div class="form-group form-check">
                        <?php $form->renderField('status'); ?>
                        <?php $form->renderErrors('status'); ?>
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>