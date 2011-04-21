<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<!-- FALTA INCLUIR AQUI DADOS DAS PAUTAS, POSTAGENS E COMENTÁRIOS DO USUÁRIO -->
<?php
require("cabecalho.php");
?>

    <h1>Dados do usuário</h1>
    <div style="color:white">
<?php
// print_r($_SESSION);
echo "id_usuario: $_SESSION[id_usuario]<br />";
echo "nome: $_SESSION[nome]<br />";
echo "email: $_SESSION[email]<br />";
echo "instituição: $_SESSION[instituicao]<br />";
echo "usuário: $_SESSION[usuario]<br />";
echo "data do cadastro: $_SESSION[data_cadastro]<br />";
$nivel=($_SESSION[nivel])?"membro credenciado":"usuário";
echo "nível: $nivel<br />";
echo "comentário: $_SESSION[comentario]<br />";
echo "<br />";
require("rodape.php");
?>
    </div>
</body>
</html>
