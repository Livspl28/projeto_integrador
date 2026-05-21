<?php
require_once 'crud.php';
?>

<?php
$login_invalido = $_GET['erro'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="init.php" method="post" class="form-login">

        <h1 class="titulo centralizado">Login</h1>

        <label class="label_form">E-mail</label>
        <input type="text" placeholder="Insira o seu e-mail" name="email-login">

        <label class="label_form">Senha</label>
        <input type="text" placeholder="Insira a sua senha" name="senha-login">

        <button type="submit">Login</button>
        <?php
        if($login_invalido == 'erro_login'){
            echo '<h3>E-mail ou senha inválidos</h3>';
        }
        elseif($login_invalido =='restrito');
        
        
        ?>
    </form>
    
</body>
</html>