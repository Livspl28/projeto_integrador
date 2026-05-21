<?php
// Quando a pessoa logar ela vai ser direcionada para esse arquivo levando GET=1

$clientes = readAll($pdo, 'clientes');

// Aqui vai pegar os dados do formulário de login
    $verificarUsuario = [
    'email' => $_POST['email-login'],
    'senha' => $_POST['senha-login']
    ];




// Aqui vai verificar todo o banco de dados e procurar se tem alguém com o mesmo email e senha que acabou de ser digitado no form
    foreach($clientes as $mostrarCliente){
        if($mostrarCliente['email'] == $verificarUsuario['email'] && $mostrarCliente['senha'] == $verificarUsuario['senha']){
            // Agora que achou tem que abrir o session
            $_SESSION['clienteLogado'] = [];
            $_SESSION['clienteLogado'] =  $mostrarCliente;
            header('Location: select.php');
            exit;
        }
    }

// Se ele chegar nessa parte é por que o foreach rodou inteiro e não achou a pessoa certa
header('Location: form_login.php?erro=erro_login');

?>