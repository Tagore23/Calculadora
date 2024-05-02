<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    Calculadora PHP
    
    <form>
        Número 1:
        <input type="number" name="nro1">
        
         <select name="calcular">
            <option value="Soma">Soma</option>
            <option value="Subtração">Subtração</option>
            <option value="Divisão">Divisão</option>
            <option value="Multiplicação">Multiplicação</option>
            <option value="Fatorial">Fatorial</option>
            <option value="Potência">Potencia</option>
        </select>
        Número 2:
        <input type="number" name="nro2">
        <br>
        <input type="submit" value="Calcular"/>
    </form>
    <?php

    $nro1 = 0;
    $nro2 = 0;
    $resultado = 0;
    $calcular = 'Soma';
    if (isset($_GET['nro1'], $_GET['nro2'])) {
        $nro1  = $_GET['nro1'];
        $nro2  = $_GET['nro2'];
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
                }else{
                    echo "Erro: Divisão por zero.";
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
                echo "Opção invalida";
                break;
        }
        echo "<p>O resultado da operação $calcular é: $resultado</p>";
    }

    ?>
</body>
</html>