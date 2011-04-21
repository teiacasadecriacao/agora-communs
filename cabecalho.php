<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<?php
require("minit.php");
require("mhtmlspec.php");
?>

<body>
    <div style="height:120px">
        <img src="img/header1.png" height="100px">
<?php
if(!isset($_SESSION[logado]))
{
?>
<!--     <div style="width:85%;height:100px;float:left"></div> -->

        <div style="text-align:right;background:gray;width:18%;float:right">
            <form method="post" action="logar.php">
                <div style="margin:10px">
                    <div style="float:right"><input name="usuario"  type="text" size="10" /></div>
                    <div>Usuário:</div>
                </div>
                <div style="margin:10px">
                    <div style="float:right"><input name="senha" type="password" size="10" /></div>
                    <div>senha:</div>
                </div>

                <div><input name="logar" type="submit" value="ok" /></div>
            </form>
            <div style="background:white"><a href="cadastro.php">CADASTRE-SE</a></div>
        </div>
    
<?php
}
else
{
?>
    <div style="text-align:right;background:gray;float:right">
        <div>
            <a href="pagina-usuario.php">
                    <?php echo $_SESSION[usuario] ?> logado.
            </a>
        </div>
        <div>
            <a href="logout.php">
                SAIR
            </a>
        </div>        
    </div>
<?php
}

$bot1="img/botao_1.png";
$bot2="img/botao_2.png";
$bot3="img/botao_3.png";
$bot4="img/botao_4.png";

if($pressed==1)
    $bot1="img/botao_1-2.png";
if($pressed==2)
    $bot2="img/botao_2-2.png";
if($pressed==3)
    $bot3="img/botao_3-2.png";
if($pressed==4)
    $bot4="img/botao_4-2.png";
?>
    </div>
    <div style="float:left;margin-top:100px">
        <a href="index.php">
            <img border="0" width="150px" height="152px" alt="Pautas Atuais" src="<?php echo $bot1; ?>">
        </a><br />

        <a href="propostas-pautas.php" >
            <img border="0" width="150px" height="152px" alt="Propostas de Pautas" src="<?php echo $bot2; ?>" />
        </a><br />

        <a href="deliberacoes.php">
            <img border="0" width="150px" height="152px" alt="Deliberacoes" src="<?php echo $bot3; ?>">
        </a><br />

        <a href="pautas-finalizadas.php">
            <img border="0" width="150px" height="152px" alt="Pautas Finalizadas" src="<?php echo $bot4; ?>">
        </a><br />
    </div>
