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
    $query="INSERT INTO `pautas` (`id_autor`, `data_criacao`, `data_validacao`, `estado`,`titulo`, `pauta`)
                VALUES ('$_SESSION[id_usuario]', CURDATE(), NULL, '0', '$_POST[titulo]', '$_POST[pauta]')";
    mysql_query($query);
}
?>

<body onunload="opener.location.reload();">
<?php
if(isset($_POST[adicionar]))
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
        <fieldset style="border: 0;">        
            <legend style="color:white;">ADICIONAR PAUTA</legend>
            <div>Titulo da Pauta:<input name="titulo"  type="text" size="50" maxlength="60" /></div>

                <div style="color:white">Pauta:</div>
                <div><textarea name="pauta" rows="10" maxlength="1000" ></textarea></div>
        </fieldset>
        <input name="adicionar" type="submit" value="Adicionar" />
    </form>
<?php
}
?>

</body>
</html>
