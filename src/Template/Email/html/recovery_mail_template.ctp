<h1>Site Canecas</h1>
<div>
    <p>
        Olá <?php echo $nome;?>!
    </p>
    <p>
        Para alterar sua senha clique no link abaixo!
        <br/>
        <?php 
        $root = pathinfo($_SERVER['HTTP_REFERER']);
        $link = $root['dirname'].DS.'change-password?h='.$hash.'&email='.$email;
        echo $this->Html->link('Redefinir Senha de usuário',$link);
        ?>
    </p>
</div>