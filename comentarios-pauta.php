<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<!-- COLOCAR FUNCIONALIDADE PARA INSERIR NOVO COMENTÁRIO AQUI NESTA PÁGINA -->
<?php
$pressed=2;
require("cabecalho.php");
?>

    <div id="coluna-comentarios">
        <h3 id="titulo-comentarios">Últimos comentários da proposta de pauta com mais comentários:</h3>
        <div id="corpo-comentarios">
<?php
$query="SELECT count(id_pauta) as count, id_pauta FROM comentarios WHERE `id_postagem`='0' GROUP BY id_pauta ORDER BY count(id_pauta) DESC LIMIT 1;";
$res=mysql_query($query);
$pauta_maxima=mysql_fetch_assoc($res);
$id_pauta=$pauta_maxima[id_pauta];
// $count=$pauta_maxima['count'];

$query="select comentario from comentarios where `id_pauta`='$id_pauta' ORDER BY id_comentario DESC;";
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
$query = "SELECT * FROM pautas WHERE `id_pauta`='$_GET[id]';";
$res = mysql_query($query);
$pauta=mysql_fetch_assoc($res);
// print_r($pauta);

$query="SELECT * FROM comentarios WHERE `id_pauta`='$pauta[id_pauta]' AND `id_postagem`='0';";
$res=mysql_query($query);
$n_coment=mysql_num_rows($res);
?>

<h1>Comentários sobre a <a href="propostas-pautas.php">validação da pauta</a></h1>

<div class="wrapper">
        <div class = "pauta-atual">
            <div class="pauta-atual-conteudo">
                <p class="pauta-atual-autor"><b>autor:</b> <?php echo autor($pauta[id_autor]); ?></p>
                <p class="pauta-atual-titulo"><b>Pauta:</b> <?php echo $pauta[titulo]; ?></p>
                <p ><?php echo $pauta[pauta]; ?></p>
            </div>
            postado: <?php echo data_brasil($pauta[data_criacao]); ?>, <?php echo $n_coment; ?> comentários
        </div>

<?php
$query = "SELECT * FROM comentarios WHERE `id_pauta`='$_GET[id]' AND `id_postagem`='0';";
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

<?php
}
// if($_SESSION[nivel] == "1") // admin ou tem passe.
// {
?>
        <p>
            <input type="button" onclick="window.open('adicionar-comentario.php?id=<?php echo $_GET[id];?>&post=<?php echo $_GET[post];?>','NOVO COMENTÁRIO','width=450,height=450')" value="Adicionar Comentário"  />
        </p>
<?php
require("rodape.php");
?>
    </div>

</body>
</html>