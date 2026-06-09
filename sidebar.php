<?php
session_start();
    $username = null;
if (isset($_SESSION['admLogado'])) {
    $showButtons = false;
    $username = $_SESSION['admLogado']['nome_administrador'] ?? 'Administrador';
} elseif (isset($_SESSION['clienteLogado'])) {
    $showButtons = false;
    $username = $_SESSION['clienteLogado']['nome'] ?? 'Cliente';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo ?></title>
        <link rel="stylesheet" href="./css/global.css">
        <link rel="stylesheet" href="<?php echo $css?>">
        <link rel="stylesheet" href="./css/global.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    </head>

        <header class="side">
            <div class="col">
                <a href="index.php"><img src="./imagens/logo.png" alt="" class="logo"/></a>
                <a href="estoque.php" class="nome">ByteWare</a>
            </div>

        <nav class="ancoras">
            <a href="estoque.php" class="<?= $pagina == 'estoque' ? 'active' : '' ?>"><i class="bi bi-table"></i>Painel de Estoque</a>
            <a href="cadastroPro.php" class="<?= $pagina == 'cadastro' ? 'active' : '' ?>"><i class="bi bi-clipboard-plus-fill"></i>Cadastrar Produto</a>
        </nav>

            
            <div class="prf">
                <img src="./imagens/usernulo.png" alt="Perfil" class="foto">
                <h3 class="name"><b><?php echo $username ?></b></h3>
            </div>

            <div class="logout">
                <a href="process/logout.php?logout=logout" title="Sair">
                    <i class="bi bi-box-arrow-left"></i>
                    <p>Deslogar</p>
                </a>
            </div>
        </div>
    </header>
