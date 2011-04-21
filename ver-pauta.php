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
$query = "SELECT * FROM pautas WHERE id_pauta = $_GET[id];";
$res = mysql_query($query);
$pauta=mysql_fetch_assoc($res);

$inicio=data_brasil($pauta[data_validacao]);
$query="SELECT * FROM postagens WHERE `id_pauta`='$pauta[id_pauta]';";
$nn_posts=mysql_num_rows(mysql_query($query));
if(estado_pauta($pauta[data_validacao])=="postagens")
{ // CASO A PAUTA ESTEJA ABERTA PARA DISCUSSÃO:
    $fim=data_brasil_adiante($pauta[data_validacao],14);
?>

    <h1>Pauta em Discussão, fim <?php echo $fim; ?></h1>

    <div class="wrapper">
        <div class = "pauta-atual">
            <div class="pauta-atual-conteudo">
                <p class="pauta-atual-autor"><b>autor:</b> <?php echo autor($pauta[id_autor]); ?></p>
                <p class="pauta-atual-titulo"><b>Pauta:</b> <?php echo $pauta[titulo]; ?></p>
                <p><?php echo $pauta[pauta]; ?></p>
            </div>
        Início: <?php echo $inicio; ?>, Fim: <?php echo $fim;?>,  <?php echo $nn_posts; ?> posts
        </div>

<?php
    $query = "SELECT * FROM postagens WHERE `id_pauta`='$_GET[id]';";
    $res = mysql_query($query);
    while($postagem=mysql_fetch_assoc($res))
    { // expondo as postagens da pauta
        $n_coment=conta("comentarios","id_postagem",$postagem[id_postagem]);
?>

<!--  -->
        <div class = "postagem-atual">
            <div class="pauta-atual-conteudo">
                <p><?php echo $postagem[postagem];?> <b>autor:</b> <?php echo autor($postagem[id_autor]);?></p>
            </div>
        <?php echo tipo_post($postagem[tipo]);?>,
        postado: <?php echo data_brasil($postagem[data]); ?>,
        <a href="<?php echo "comentarios.php?id=$_GET[id]&post=$postagem[id_postagem]";?>"> <?php echo $n_coment; ?> comentários</a>
        </div>
<!--  -->
<?php
    }

    if($_SESSION[nivel] == "1") // admin ou tem passe.
    {
    ?>
    <p>
        <input type="button" onclick="window.open('adicionar-postagem.php?id=<?php echo $_GET[id];?>','NOVA POSTAGEM','width=450,height=450')" value="Adicionar Postagem"  />
    </p>
    <?php
    }
?>
<?php
}


///////////////////////////////////////////
// CASO A PAUTA ESTEJA EM ESTADO DE VOTAÇÃO:

elseif(estado_pauta($pauta[data_validacao])=="votacao" OR estado_pauta($pauta[data_validacao])=="finalizada")
{
    $fim=data_brasil_adiante($pauta[data_validacao],28);
?>
<h1>Em regime de votação, fim <?php echo $fim; ?></h1>

    <div class="wrapper">
        <div class = "pauta-atual">
            <div class="pauta-atual-conteudo">
                <p class="pauta-atual-autor"><b>autor:</b> <?php echo autor($pauta[id_autor]); ?></p>
                <p class="pauta-atual-titulo"><b>Pauta:</b> <?php echo $pauta[titulo]; ?></p>
                <p><?php echo $pauta[pauta]; ?></p>
            </div>
        Início: <?php echo $inicio; ?>, Fim: <?php echo $fim;?>,  <?php echo $nn_posts; ?> posts
        </div>

<?php
    $query = "SELECT * FROM postagens WHERE `id_pauta`='$_GET[id]';";
    $res = mysql_query($query);
    while($postagem=mysql_fetch_assoc($res))
    { // expondo as postagens da pauta
        $n_coment=conta("comentarios","id_postagem",$postagem[id_postagem]);
?>
        <div class = "postagem-atual">
            <div class="pauta-atual-conteudo">
                <p><?php echo $postagem[postagem];?> <b>autor:</b> <?php echo autor($postagem[id_autor]);?></p>
            </div>
<?php
    if($postagem[tipo] == 1)
    { // Deliberação/Encaminhamento
        $link = "votar.php?id=$_GET[id]&post=$postagem[id_postagem]";
        $linka = $link . "&opt=1";
        $linkc = $link . "&opt=0";

        $querya = "SELECT * FROM votos WHERE `id_postagem`='$postagem[id_postagem]' AND `voto` = 1";
        $queryc = "SELECT * FROM votos WHERE `id_postagem`='$postagem[id_postagem]' AND `voto` = 0";
        $resa=mysql_query($querya);
        $resc=mysql_query($queryc);
        $numa=mysql_num_rows($resa);
        $numc=mysql_num_rows($resc);
?>
        DELIBERAÇÃO: <?php echo $numa ?> <input type="button" onclick="window.open('<?php echo $linka;?>','NOVA POSTAGEM','width=450,height=450')" value="A Favor"  /> e
        <?php echo $numc; ?> <input type="button" onclick="window.open('<?php echo $linkc;?>','NOVA POSTAGEM','width=450,height=450')" value="Contra"  />
        postado: <?php echo data_brasil($postagem[data]); ?>,
        <a href="<?php echo "comentarios.php?id=$_GET[id]&post=$postagem[id_postagem]";?>"> <?php echo $n_coment; ?> comentários</a>
<?php
    }
    else
    {
?>
        <?php echo tipo_post($postagem[tipo]);?>,
        postado: <?php echo data_brasil($postagem[data]); ?>,
        <a href="<?php echo "comentarios.php?id=$_GET[id]&post=$postagem[id_postagem]";?>"> <?php echo $n_coment; ?> comentários</a>
<?php
    }
?>
    </div>
    <br />
<?php
    }
}
?>
    
<?php
require("rodape.php");
?>
</body>
</html>
