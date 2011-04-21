<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<?php
require("minit.php");
require("mhtmlspec.php");

if(isset($_POST[remover]))
{
    $query="DELETE FROM comentarios WHERE `id_comentario`='$_GET[id]';";
    mysql_query($query);
}
?>

<body onunload="opener.location.reload();">
<?php
if(isset($_POST[remover]))
{
?>
    <p>Operação Realizada com Sucesso</p>
    <p><a href="javascript:window.close()">Fechar Janela</a></p>
<?php
}
else
{
?>
    <form action="" method="post" enctype="multipart/form-data" >
        <input name="remover" type="submit" value="REMOVER" />
    </form>
<?php
}
?>

</body>
</html>