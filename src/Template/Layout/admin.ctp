<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'BarberBlues - Área Administrativa';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('bootstrap.css') ?>
        <?= $this->Html->css('admin.css') ?>
        <?= $this->Html->css('cake.css') ?>
        <?= $this->Html->css('base.css') ?>
        <?= $this->Html->css('home.css') ?>
        <?= $this->Html->css('style.css') ?>
        <?= $this->Html->css('jquery.Jcrop.min.css') ?>
        <?= $this->Html->script('jquery-3.2.1.js') ?>
        <?= $this->Html->script('bootstrap.js') ?>
        <?= $this->Html->script('jquery.Jcrop.min.js') ?>
        <?= $this->Html->script('script.js') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>


        <?php $session = $this->request->session(); ?>

        <?php if ($username): ?> 
            <nav class="navbar navbar-default" >
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!--<a class="navbar-brand" href="#">Home</a>-->
                        <?= $this->Html->link(__('Home', true), array('controller' => 'HomeAdmin', 'action' => 'index'), array('class' => 'navbar-brand'), array('escape' => false)) ?>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Galerias de Imagens <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link("Banners", ['controller' => 'Banner', 'action' => 'index'], ['escape' => false]) ?></li>                        
                                    <li><?= $this->Html->link("Loja", ['controller' => 'Imgloja', 'action' => 'index'], ['escape' => false]) ?></li>                        
                                    <li><?= $this->Html->link("Serviços", ['controller' => 'imgservicos', 'action' => 'index'], ['escape' => false]) ?></li>                        
                                </ul>
                            </li>  
                            <li><?= $this->Html->link("Serviços", ['controller' => 'Servicos', 'action' => 'index'], ['escape' => false]) ?></li>                        
                        </ul>                   
                        <ul class="nav navbar-nav navbar-right"><li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Olá <?php echo $session->read('nomeUsuario'); ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">               
                                    <li><?= $this->Html->link("Controle de Usuários", ['controller' => 'Users', 'action' => 'index'], ['escape' => false]) ?></li>                        
                                    <li role="separator" class="divider"></li>
                                    <li><?= $this->Html->link("<i class='fa fa-user-times'></i> Sair", ['controller' => 'Users', 'action' => 'Logout'], ['escape' => false]) ?></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>  
        <?php endif; ?> 


        <?= $this->Flash->render() ?>
        <div class="container body-content">
            <?= $this->fetch('content') ?>
        </div>
        <footer>
        </footer>


    </body>
</html>
