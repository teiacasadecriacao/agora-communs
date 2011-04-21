<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<?php
require("cabecalho.php");
if(isset($_POST[adicionar]))
{
    $query = "SELECT * FROM usuarios WHERE `usuario`='$_POST[usuario]';";
    $result=mysql_query($query);
    $assoc=mysql_fetch_assoc($result);
    if (!$assoc)
    {
        $query="INSERT INTO `usuarios` (`nome` ,`email`, `instituicao`, `usuario` ,`senha` , `comentario` , `data_cadastro`)
                VALUES ('$_POST[nome]','$_POST[email]','$_POST[instituicao]','$_POST[usuario]', '$_POST[senha]', '$_POST[comentario]', CURDATE());";
        mysql_query($query);
        $ok = 1;
    }
    else
    {
        echo "<b style='color:white'>Usuário já utilizado, escolha outro</b>";
    }
}

if(isset($_POST[adicionar]) and $ok)
{
?>
    <p style="color:white">Cadastro Realizado com Sucesso</p>
    <p><a href="pautas-atuais.php">Volte para a página inicial e realize login quando necessário.</a></p>
<?php
}
else
{
?>
    <h1>Cadastro de novo usuário</h1>

    <form method="post" action="">
        <div style="color:white">Nome:</div>

        <div><input type="text" size="40" name="nome" maxlength="60" /></div>

        <div style="color:white">Email:</div>
        <div><input type="text" size="40" name="email" maxlength="60" /></div>

        <div style="color:white">Instituição:</div>
        <div><input type="text" size="40" name="instituicao" maxlength="50" /></div>

        <div style="color:white">Usuário:</div>
        <div><input type="text" size="40" name="usuario" maxlength="15" /></div>

        <div style="color:white">Senha</div>
        <div><input type="password" size="40" name="senha" maxlength="30" /></div>

        <div style="color:white">Comentário</div>
        <div><textarea name="comentario" rows="5" maxlength="300" ></textarea></div>                        

        <div><input name="adicionar" type="submit" value="ok" /></div>
    </form>
<?php
}
?>
</body>
</html>
