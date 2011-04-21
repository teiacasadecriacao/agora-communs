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
    $query="INSERT INTO `comentarios` (`id_pauta`, `id_postagem`, `id_autor`, `data`,`comentario`)
                VALUES ('$_GET[id]','$_GET[post]','$_SESSION[id_usuario]',CURDATE(),'$_POST[comentario]')";
    mysql_query($query);
}
?>

<body onunload="opener.location.reload();" style="background:black">
<?php
if(isset($_POST[adicionar]))
{
?>
    <p style="color:white;">Operação Realizada com Sucesso</p>
    <p><a href="javascript:window.close()">Fechar Janela</a></p>
<?php
}
else
{
?>
    <form action="" method="post" enctype="multipart/form-data" >
        <fieldset style="border: 0;">
            <legend style="color:white;">ADICIONAR COMENTÁRIO</legend>
                <div style="color:white;">Comentário</div>
                <div><textarea name="comentario" rows="10" maxlength="1000" ></textarea></div>
        </fieldset>
        <input name="adicionar" type="submit" value="Adicionar" />
    </form>
<?php
}
?>

</body>
</html>