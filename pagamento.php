<?php
require_once 'carrinho.php';
?>

<html>
    <head>Finalize sua compra!</head>

    <body>
<section class="formcard"></section>


    <label class="que" value="E-mail">
        <input type="text">
    </label>
 
<label class="radio-text">
    <input type="radio" name="debito" value="Debito">
    Débito
</label>

<label class="radio-text">
    <input type="radio" name="credito" value="Credito">
   Crédito
</label>

<label class="radio-text">
    <input type="radio" name="pix" value="Pix">
    Pix
</label>

<label class="radio-text">
    <input type="radio" name="boleto" value="boleto">
    Boleto
</label>

<label class="que">
    <input type="number" Value="1234 1234 1234 1234">
</label>

<label class="que">
    <input type="number" value="DD/MM">
</label>

<label class="que">
    <input type="number" value="000">
</label>

<label class="que">
    <input type="text" value="Nome do Titular do cartão">
</label>

    </body>
</html>
