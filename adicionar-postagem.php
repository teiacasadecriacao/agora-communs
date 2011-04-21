<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<?php
require("minit.php");
require("mhtmlspec.php");

if(isset($_POST[adicionar]))
{
    $query="INSERT INTO `postagens` (`id_pauta`, `id_autor`, `data`, `tipo`, `postagem`)
                VALUES ('$_GET[id]','$_SESSION[id_usuario]',CURDATE(),'$_POST[tipo]', '$_POST[postagem]');";
    mysql_query($query);
}
?>

<body onunload="opener.location.reload();">
<?php
if(isset($_POST[adicionar]))
{
?>
    <p style="color:white">Operação Realizada com Sucesso</p>
    <p><a href="javascript:window.close()">Fechar Janela</a></p>
<?php
}
else
{
?>
    <form action="" method="post" enctype="multipart/form-data" >
        <fieldset style="border: 0;">
            <legend style="color:white">ADICIONAR POSTAGEM</legend>
                <div style="color:white">Postagem</div>
                <div><textarea name="postagem" rows="10" maxlength="1000" ></textarea></div>
        </fieldset>

        <div style="color:white">Tipo da postagem:<br />
        <input type="radio" name="tipo" value="0" checked="True"/> discussão/debate <br />
        <input type="radio" name="tipo" value="1" /> deliberação/encaminhamento <br /></div>
        <input name="adicionar" type="submit" value="Adicionar" />
    </form>
<?php
}
?>

</body>
</html>
