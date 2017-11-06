<?php
    session_start();
    include '../phpComCanvas.php';
    include '../usuario/validacoes.php';
    $login = $_SESSION["login"];
    $dao = carregarHabitosPeloLogin($login);
    $quantHabitos = count($dao->getListaHabitos());
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset='UTF-8'>
        <link rel="stylesheet" type="text/css" href="../estiloForm.css"/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title> Atualizar Hábito </title>
    </head>

    <body>
        <section>
            <?php 
                if(isset($_SESSION['login']) and isset($_SESSION['senha'])){
                    $dao2 = new DAOHabito();
                    if($quantHabitos == 0){
                        echo "<a> Você não possui hábitos para deletar </a>";
                    
                    } else {
                        for ($i = 0; $i < $quantHabitos; $i++) {
                            $dao2 = lerhabitoPeloIndice($dao,$i);
                            $nome = $dao2->getNomeHabito();
                            $categoria = $dao2->getCategoriaHabito();
                            echo "<fieldset><h3 class='titulo'> Habito ".($i+1)."</h3>
                            <form action='apagar.php' method='POST'>
                                <input type='hidden' name='nome' value='$nome'>
                                <a>$nome : </a><input type='submit' value='Apagar'>
                            </form>
                            </fieldset><br>";
                        }
                        echo "<a href='../canvas/painelCanvas.php'> Voltar </a><hr>";
                    }
                } else {
                    header("Location: ../home.php");
                }
            ?>
        </section>
    </body>

    </html>