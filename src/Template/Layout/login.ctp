<?php
$cakeDescription = 'Acesso Restrito';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $cakeDescription ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('font-awesome.min.css') ?>

        <?= $this->Html->css('signin.css') ?>

        <?= $this->Html->script('jquery.min.js') ?>
        <?= $this->Html->script('jquery-ui.min.js') ?>
        <?= $this->Html->script('modernizr.min.js') ?>
        <?= $this->Html->script('application-985b892b.js') ?>    


        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <div class="container">
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='brand text-center'>
                        <h1>
                            <i class='fa fa-user-secret fa-2x'></i>
                            <br>
                            Acesso Restrito
                        </h1>
                         <?= $this->fetch('content') ?>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12'>
                    <fieldset class='container'>
                       

                </div>
                </fieldset>


            </div>
        </div>
    </div>
    <!-- Footer -->
</body>
</html>

