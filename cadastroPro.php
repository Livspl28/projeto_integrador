<?php
    $pagina = 'cadastro';
    $titulo = 'Byteware';
    $css = './css/cadastroPro.css';
    require_once 'crud.php';
    require_once 'partials/sidebar.php';
    $erro = null;
    $msg = null;  
    if(isset($_GET['erro2'])){
        $msg = $_GET['erro2'] ?? null;
        if($msg === '1'){
            $msg = '<h1 class="msg">Formato de arquivo não permítido! Os formatos permitidos são png e jpg/jpeg</h1>';
        }
        elseif($msg === '2'){
            $msg = '<h1 class="msg">Tamanho de arquivo muito grande!O tamanho máximo é 10MB</h1>';
        }
        else{
            $msg = '<h1 class="msg">Um erro desconhecido ocorreu. Código de erro: '.$_GET['erro2'].'</h1>';
        }
    }
    if(isset($_GET['criado'])){
        $msg = '<h1 class="msg">Produto criado com sucesso!</h1>';
    }
      
?>

<!--

lista de campos

id_produto INT PRIMARY KEY AUTO_INCREMENT, 
nome_produto VARCHAR(200) NOT NULL,
pn VARCHAR(255) NOT NULL UNIQUE,
estoque INT NOT NULL,
categoria VARCHAR(500) NOT NULL,
preco NUMERIC(14,2) NOT NULL,
descricao VARCHAR(1000) NOT NULL,
ficha_tecnica VARCHAR(1000) NOT NULL,
imagem VARCHAR (1000) NOT NULL,
status BOOLEAN NOT NULL,
id_administrador INT,

  -->

<body>
<?php
    if(isset($msg)){
        print $msg;
    }
?>
    <main>

        <form action="insertProdutos.php" method="POST" class="formulario" enctype="multipart/form-data">
            <h1 class="degrade">Cadastro de Produto</h1>
            <input type="text" id="produto" name="nome" maxlength="200" class="inp" placeholder="Nome do Produto" required>

            <input type="text" id="pn" name="pn" class="inp" maxlength="255" placeholder="Part Number" required>

            <input type="number" id="preco" name="preco" class="inp" min="0" max="99999999999999" step=".01"  placeholder="Preço" required>

            <input type="number" id="qtd" name="estoque" class="inp" min="0" placeholder="Estoque" required>

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="cat">
                <option value="" disabled selected>Selecione uma opção...</option>
                <option value="sensores" required>Sensores</option>
                <option value="clp">CLPs</option>
                <option value="ihm">IHMs</option>
                <option value="fonte">Fontes Industriais</option>
                <option value="reles">Relés</option>
                <option value="inv_freq">Inversores de Frequência</option>
            </select>
            <?php
            if($erro == 'categoria'){
                echo '<p>Selecione uma categoria válida!</p>';
            }
            ?>
            <input type="text" name="descricao" class="inp" placeholder ="Descrição" required> 
            <textarea name="mensagem" rows="4" cols="50" name="descricao2" maxlength="1000" placeholder="Insira a descrição do produto" required></textarea>

            <input type="text" class="inp" id="ficha_tecnica" name="ficha_tecnica" maxlength="1000" placeholder="Ficha Técnica do Produto" required>

            <label for="imagem" class="imagem">Selecione uma Imagem</label>
            <input type="file" id="imagem" name="imagem" class="inp" required>

            <input type="radio" id="ativo" name="status" value="ativo" required>
            <label for="ativo">Ativo</label>

            <input type="radio" id="inativo" name="status" value="inativo" required>
            <label for="inativo">Inativo</label>

            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </main>
</body>
</html>
