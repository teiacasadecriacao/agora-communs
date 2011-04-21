<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<?php
require("minit.php");
require("mhtmlspec.php");

if(isset($_POST[confirmar]))
{ // votos (id_pauta, id_postagem, id_autor, data, voto)
    $query="INSERT INTO `votos` (`id_pauta`, `id_postagem`, `id_autor`, `data`,`voto`)
                VALUES ('$_GET[id]','$_GET[post]','$_SESSION[id_usuario]',CURDATE(),'$_GET[opt]')";
    mysql_query($query);
}
?>

<body onunload="opener.location.reload();">
<?php
if(isset($_POST[confirmar]))
{
?>
    <p style="color:white;">Operação Realizada com Sucesso</p>
    <p><a href="javascript:window.close()">Fechar Janela</a></p>
<?php
}
else
{
?>
    <div style="color:white;">
    <form action="" method="post" enctype="multipart/form-data" >
<?php

    if($_GET[opt]==1)
    {
        $querya = "SELECT * FROM votos WHERE `id_postagem`='$_GET[post]' AND `voto` = 1";
        $resa=mysql_query($querya);
        while($a=mysql_fetch_assoc($resa))
        {
            echo autor($a[id_autor])."<br />";
        }
        $posicao="*a favor*";
?>
        <br />
        Os usuários acima votam *a favor* desta deliberação/encaminhamento.<br />
<?php
    }
    else
    {
        $queryc = "SELECT * FROM votos WHERE `id_postagem`='$_GET[post]' AND `voto` = 0";
        $resc=mysql_query($queryc);
        while($a=mysql_fetch_assoc($resc))
        {
            echo autor($a[id_autor])."<br />";
        }
        $posicao="*contra*";
?>
        Os usuários acima votam *contra* esta deliberação/encaminhamento.<br />
<?php
    }

    $query = "SELECT * FROM votos WHERE `id_postagem`='$_GET[post]' AND `id_autor`='$_SESSION[id_usuario]';";
    $res=mysql_query($query);
    $num=mysql_num_rows($res);
    if(($num==0) AND ($_SESSION[logado]==1))
    {
?>
        Confirma o voto <?php echo $posicao; ?> da deliberação/encaminhamento?
        <input name="confirmar" type="submit" value="Confirmar" />
<?php
    }
    else
    {
?>
        Seu voto está registrado e seu usuário já consta como votante!
<?php
    }
?>
    </form>
<?php
}
?>
    </div>
</body>
</html>
