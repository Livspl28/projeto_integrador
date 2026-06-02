<?php
session_start();
$titulo = 'Carrinho de Compras';
$css = './css/pagamento.css';
require_once 'crud.php';

$erro = '';
$email = '';
$forma_pagamento = '';
$numero_cartao = '';
$data_validade = '';
$cvv = '';
$nome_titular = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $forma_pagamento = $_POST['forma_pagamento'] ?? '';
    $numero_cartao = trim($_POST['numero_cartao'] ?? '');
    $data_validade = trim($_POST['data_validade'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');
    $nome_titular = trim($_POST['nome_titular'] ?? '');

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido';
    } elseif(empty($forma_pagamento)) {
        $erro = 'Selecione uma forma de pagamento';
    } elseif(empty($numero_cartao) || strlen(preg_replace('/\D/', '', $numero_cartao)) < 13) {
        $erro = 'Número do cartão inválido';
    } elseif(empty($data_validade) || !preg_match('/^\d{2}\/\d{2}$/', $data_validade)) {
        $erro = 'Data de validade inválida (use MM/AA)';
    } elseif(empty($cvv) || strlen(preg_replace('/\D/', '', $cvv)) < 3) {
        $erro = 'CVV inválido';
    } elseif(empty($nome_titular)) {
        $erro = 'Nome do titular é obrigatório';
    } elseif(empty($_SESSION['produtos'])) {
        $erro = 'O carrinho está vazio. Adicione produtos antes de finalizar.';
    }

    if(empty($erro)) {
        $id_cliente = null;
        if(isset($_SESSION['clienteLogado']['id_cliente'])) {
            $id_cliente = $_SESSION['clienteLogado']['id_cliente'];
        } else {
            $emailSafe = addslashes($email);
            $cliente = read($pdo, 'clientes', "email = '$emailSafe'");
            if(!$cliente) {
                $erro = 'E-mail não cadastrado. Faça login ou cadastre-se antes de pagar.';
            } else {
                $id_cliente = $cliente['id_cliente'];
            }
        }
    }

    if(empty($erro)) {
        try {
            foreach($_SESSION['produtos'] as $id_produto => $produto) {
                $dados_compra = [
                    'id_cliente' => $id_cliente,
                    'id_produto' => $id_produto
                ];
                create($pdo, 'compra', $dados_compra);
            }

            unset($_SESSION['produtos']);
            header('Location: index.php?sucesso=pagamento_realizado');
            exit;
        } catch (Exception $e) {
            $erro = 'Erro ao processar compra: ' . $e->getMessage();
        }
    }
}

require_once 'partials/navbar.php';
?>

    <body>

<section class="formcard">
    <?php if(isset($_GET['sucesso']) && $_GET['sucesso'] == 'pagamento_realizado'): ?>
        <div class="mensagem sucesso">
            Pagamento realizado com sucesso!
        </div>
    <?php endif; ?>

    <?php if(!empty($erro)): ?>
        <div class="mensagem erro">
            <?php echo $erro; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="pagamento.php">
        <h4>E-mail de usuário: </h4>
        <label class="que">
            <input type="email" name="email" placeholder="seu@email.com" value="<?php echo htmlspecialchars($email); ?>" required>
        </label>

        <h4>Escolha a forma de pagamento: </h4>
        <label class="radio-text">
            <input type="radio" name="forma_pagamento" value="Debito" <?php echo $forma_pagamento === 'Debito' ? 'checked' : ''; ?> required>
            Débito
        </label>

        <label class="radio-text">
            <input type="radio" name="forma_pagamento" value="Credito" <?php echo $forma_pagamento === 'Credito' ? 'checked' : ''; ?>>
            Crédito
        </label>

        <label class="radio-text">
            <input type="radio" name="forma_pagamento" value="Pix" <?php echo $forma_pagamento === 'Pix' ? 'checked' : ''; ?>>
            Pix
        </label>

        <label class="radio-text">
            <input type="radio" name="forma_pagamento" value="Boleto" <?php echo $forma_pagamento === 'Boleto' ? 'checked' : ''; ?>>
            Boleto
        </label>

        <h4>Número do cartão: </h4>
        <label class="que">
            <input type="text" name="numero_cartao" placeholder="1234 1234 1234 1234" value="<?php echo htmlspecialchars($numero_cartao); ?>" required>
        </label>

        <h4>Data de validade: </h4>
        <label class="que"> 
            <input type="text" name="data_validade" placeholder="MM/AA" value="<?php echo htmlspecialchars($data_validade); ?>" required>
        </label>

        <h4>CVV: </h4>
        <label class="que">
            <input type="text" name="cvv" placeholder="000" value="<?php echo htmlspecialchars($cvv); ?>" required>
        </label>

        <h4>Nome do Titular do cartão: </h4>
        <label class="que">
            <input type="text" name="nome_titular" placeholder="Nome completo" value="<?php echo htmlspecialchars($nome_titular); ?>" required>
        </label>

        <button type="submit">Pagar</button>
    </form>
</section>

    </body>
</html>
