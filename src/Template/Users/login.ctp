<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php
//$session = $this->request->session();
//
//print_r($session->read());
//
?>

<div class="form-signin">
    <?= $this->Form->create() ?>
    <fieldset>
        <?php
        echo $this->Form->control('username', array('class' => 'form-control', 'placeholder' => 'Login', 'label' => ''));
        echo $this->Form->control('password', array('class' => 'form-control', 'placeholder' => 'Senha', 'label' => ''));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Entrar'), array('class' => 'btn btn-primary')) ?>
    <?= $this->Form->end() ?>
    <div>
        <br/>
        <?= $this->Html->link(__('Esqueceu a senha?'), ['controller' => 'Users', 'action' => 'rememberPassword']) ?>
    </div>
</div>

