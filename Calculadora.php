<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            margin: 20px 40px 20px 40px;
            background-color: black;
        }

        div{
            margin: 0;
        }

        #header{
            color: Black;
            border-color: black;
            border-radius: 10px;
            border-width: 5px;
            padding: 5px;
            background-color: white;
            font-size: 30px;
        }

        #numero1txt{
            background-color: lightgrey;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            padding: 4px;
            color:black;
            width: 100px;
            margin-right: 0;
            float: left;
        }

        #input1{
            background-color: white;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            padding: 2px;
            color: black;
            margin-left: 0;
            width: 281px;
            float: left;
        }

        #operacao{
            border-radius: 10px;
            background-color: white;
            padding: 4px;
            width: 150px;
            float: left;
            margin-left: 0;
            margin-right: 0;
        }

        #operacao option{
            background-color: white;
        }

        #numero2txt{
            padding: 4px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            background-color: lightgrey;
            width: 100px;
            float: left;
            margin-right: 0;
        }

        #input2{
            padding: 2px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            background-color: white;
            margin-left: 0;
            width: 281px;
            float: left;
        }

        .clearfix:after {
            content:"";
            display:block;
            clear:both;
        }

        #botaoCalculo{
            margin-right: 5px;
            margin-bottom: 0;
            margin-top: 0;
            padding: 8px;
            background-color: transparent;
            border: solid green 3px;
            border-radius: 10px;
            color: green;
        }

        #botaoM{
            margin-bottom: 0;
            margin-top: 0;
            margin-left: 5px;
            margin-right: 5px;
            padding: 8px;
            background-color: transparent;
            border: solid blue 3px;
            border-radius: 10px;
            color: blue;
        }

        #botaoApagar{
            margin-bottom: 0;
            margin-top: 0;
            margin-left: 5px;
            padding: 8px;
            background-color: transparent;
            border: solid blue 3px;
            border-radius: 10px;
            color: blue;
        }

        #historico {
            background-color: white;
            margin-top: 20px;
            border-radius: 10px;
            border-top: 2px solid black;
            padding: 10px;
        }

        #historico p {
            background-color: white;
            margin: 5px 0;
        }

        #resultado{
            background-color: white;
            border-radius: 10px;
            padding: 10px;
        }

        #resultado p{
            background-color: white;
        }

    </style>
</head>
<body>
    <div><p id="header">Calculadora PHP</p></div>
    
    <form method="GET" action="">

    <div class="clearfix">
        <div><p id="numero1txt">Número 1:</p></div>
        <div><input type="number" id="input1" name="nro1" value="<?php echo isset($_SESSION['nro1']) ? $_SESSION['nro1'] : ''; ?>"></div>
            
        <div><select id="operacao" name="calcular">
            <option value="Soma">Soma</option>
            <option value="Subtração">Subtração</option>
            <option value="Divisão">Divisão</option>
            <option value="Multiplicação">Multiplicação</option>
            <option value="Fatorial">Fatorial</option>
            <option value="Potência">Potência</option>
        </select></div>
    
        <div><p id="numero2txt">Número 2:</p></div>
        <div><input id="input2" type="number" name="nro2" value="<?php echo isset($_SESSION['nro2']) ? $_SESSION['nro2'] : ''; ?>"></div>
    </div>

        <input id="botaoCalculo" type="submit" value="Calcular"/>

        <input id="botaoM" type="submit" name="memoria" value="M"/>

        <input id="botaoApagar" type="submit" name="acao" value="Apagar Histórico"/>
    </form>

    <div id="resultado"><?php

    function adicionarOperacaoAoHistorico($nro1, $nro2, $calcular, $resultado) {
        if (!isset($_SESSION['historico'])) {
            $_SESSION['historico'] = array();
        }
        $_SESSION['historico'][] = array(
            'nro1' => $nro1,
            'nro2' => $nro2,
            'calcular' => $calcular,
            'resultado' => $resultado
        );
    }
    if (isset($_GET['acao'])) {
        if ($_GET['acao'] === 'Apagar Histórico') {
            unset($_SESSION['historico']);
            echo "<p>Histórico apagado.</p>";
        }
    }
    if (isset($_GET['memoria'])) {
        if ($_GET['memoria'] === 'M') {
            if (isset($_GET['nro1']) && isset($_GET['nro2'])) {
                $_SESSION['memoria'] = array(
                    'nro1' => $_GET['nro1'],
                    'nro2' => $_GET['nro2'],
                    'calcular' => $_GET['calcular']
                );
            }
        }
    }
    if (isset($_SESSION['memoria'])) {
        echo "<script>";
        echo "document.getElementById('input1').value = '{$_SESSION['memoria']['nro1']}';";
        echo "document.getElementById('input2').value = '{$_SESSION['memoria']['nro2']}';";
        echo "document.getElementById('operacao').value = '{$_SESSION['memoria']['calcular']}';";
        echo "</script>";
        unset($_SESSION['memoria']);
    }

    if (isset($_GET['nro1'], $_GET['nro2'], $_GET['calcular'])) {
        $nro1 = floatval($_GET['nro1']);
        $nro2 = floatval($_GET['nro2']);
        $calcular = $_GET['calcular'];

        switch ($calcular) {
            case 'Soma':
                $resultado = $nro1 + $nro2;
                break;
            case 'Subtração':
                $resultado = $nro1 - $nro2;
                break;
            case 'Multiplicação':
                $resultado = $nro1 * $nro2;
                break;     
            case 'Divisão':
                if ($nro2 != 0) {
                    $resultado = $nro1 / $nro2;
                } else {
                    echo "Erro: Divisão por zero.";
                    exit();
                }
                break;
            case 'Fatorial':
                $resultado = 1;
                for ($i = 1; $i <= $nro1; $i++) {
                    $resultado *= $i;
                }
                break;
            case 'Potência':
                $resultado = pow($nro1, $nro2);
                break;              
            default:
                echo "Opção inválida";
                break;
        }

        adicionarOperacaoAoHistorico($nro1, $nro2, $calcular, $resultado);
        echo "<p>O resultado da operação $calcular é: " . $resultado . "</p>";
    }
    ?></div>

    <div id="historico">
        <?php
        if (isset($_SESSION['historico'])) {
            echo "<p>Histórico:</p>";
            foreach ($_SESSION['historico'] as $op) {
                echo "<p>Operação: " . $op['nro1'] . " " . $op['calcular'] . " " . $op['nro2'] . " = " . $op['resultado'] . "</p>";
            }
        } else {
            echo "<p>Histórico vazio.</p>";
        }
        ?>
    </div>

</body>
</html>
