<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<!-- COLOCAR FUNCIONALIDADE PARA INSERIR NOVO COMENTÁRIO AQUI NESTA PÁGINA -->
<?php
$pressed=1;
require("cabecalho.php");
?>


    <div id="coluna-comentarios">
        <h3 id="titulo-comentarios">Comentários aleatórios da postagens com mais comentários:</h3>
        <div id="corpo-comentarios">
<?php
$query="SELECT count(id_postagem) as count, id_postagem FROM comentarios WHERE (`id_pauta`='$_GET[id]' AND `id_postagem`>'0') GROUP BY id_postagem ORDER BY count(id_postagem) DESC LIMIT 1;";
$res=mysql_query($query);
$postagem_maxima=mysql_fetch_assoc($res);
$id_postagem=$postagem_maxima[id_postagem];
// $count=$pauta_maxima['count'];

$query="select comentario from comentarios where `id_postagem`='$id_postagem' AND `id_pauta`='$_GET[id]' ORDER BY id_comentario DESC;";
$res=mysql_query($query);

$i=1;
while(($comentario=mysql_fetch_assoc($res)) AND ($i<=10))
{
?>
            <div class="corpo-comentario">
                <p><?php echo $comentario[comentario];?> </p>
            </div>
<?php
    $i++;
}
?>
        </div>
    </div>

<?php
$query = "SELECT * FROM postagens WHERE `id_postagem`='$_GET[post]';";
$res = mysql_query($query);
$postagem=mysql_fetch_assoc($res);
$n_coment=conta("comentarios","id_postagem",$_GET[post]);
?>

<h1>Comentários sobre a postagem</h1>

    <div class="wrapper">
        <div class = "pauta-atual">
            <div class="pauta-atual-conteudo">
                <a href="ver-pauta.php?id=<?php echo $_GET[id];?>"><h2>Postagem:</h2></a>
            <p><?php echo $postagem[postagem]; ?> <b>autor:</b> <?php echo autor($postagem[id_autor]); ?></p>
            </div>
            postado: <?php echo data_brasil($postagem[data]); ?>, <?php echo $n_coment; ?> comentários
        </div>

<?php
$query = "SELECT * FROM comentarios WHERE `id_postagem`='$_GET[post]';";
$res = mysql_query($query);
while($comentario=mysql_fetch_assoc($res))
{ // expondo os comentários da postagem
?>

        <div class = "postagem-atual">
            <div class="pauta-atual-conteudo">
                <p><?php echo $comentario[comentario];?> <b>autor:</b> <?php echo autor($comentario[id_autor]);?></p>
            </div>
            postado: <?php echo data_brasil($comentario[data]); ?>
<?php
    if($comentario[id_autor] == $_SESSION[id_usuario])
    {
?>
        <input type="button" onclick="window.open('remover-comentario.php?id=<?php echo $comentario[id_comentario];?>','REMOVER COMENTÁRIO','width=450,height=450')" value="REMOVER Comentário"  />
<?php
    }
?>
        </div>
    <br />

<?php
}

?>
        <p>
            <input type="button" onclick="window.open('adicionar-comentario.php?id=<?php echo $_GET[id];?>&post=<?php echo $_GET[post];?>','NOVO COMENTÁRIO','width=450,height=450')" value="Adicionar Comentário"  />
        </p>
<?php
require("rodape.php");
?>
</body>
</html>
