<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<?php
$pressed=1;
require("cabecalho.php");
?>
    <div id="coluna-comentarios">
        <h3 id="titulo-comentarios">Últimas postagens da pauta atual com mais posts:</h3>
        <div id="corpo-comentarios">
<?php
$query="SELECT count(id_pauta) as count, id_pauta FROM postagens GROUP BY id_pauta ORDER BY count(id_pauta) DESC LIMIT 1;";
$res=mysql_query($query);
$pauta_maxima=mysql_fetch_assoc($res);
$id_pauta=$pauta_maxima[id_pauta];
// $count=$pauta_maxima['count'];

$query="select postagem from postagens where `id_pauta`='$id_pauta' ORDER BY id_postagem DESC;";
$res=mysql_query($query);

$i=1;
while(($postagem=mysql_fetch_assoc($res)) AND ($i<=10))
{
?>
            <div class="corpo-comentario">
                <p><?php echo $postagem[postagem];?> </p>
            </div>
<?php
    $i++;
}
?>
        </div>
    </div>

<h1>Pautas Atuais</h1>
    <div class="wrapper">

<?php
$query = "SELECT * FROM pautas WHERE `estado` = '-1';";
$res = mysql_query($query);
while($pauta=mysql_fetch_assoc($res))
{
    if(estado_pauta($pauta[data_validacao]) != "finalizada")
    {
?>

        <div class = "pauta-atual">
            <div class="pauta-atual-conteudo">
                <p class="pauta-atual-autor"><b>autor:</b> <?php echo autor($pauta[id_autor]); ?></p>
                <p class="pauta-atual-titulo"><b>Pauta:</b> <?php echo $pauta[titulo]; ?></p>
                <p><?php echo $pauta[pauta]; ?></p>
            </div>

<?php
        if(estado_pauta($pauta[data_validacao]) == "votacao")
        {
        $fim=data_brasil_adiante($pauta[data_validacao],28);
?>

            Em regime de votação, fim: <?php echo $fim; ?>,<a href=<?php echo "ver-pauta.php?id=$pauta[id_pauta]";?> >Ver</a>

<?php
        }
        else
        {
            $inicio=data_brasil($pauta[data_validacao]);
            $fim=data_brasil_adiante($pauta[data_validacao],14);
            $query="SELECT * FROM postagens WHERE `id_pauta`='$pauta[id_pauta]';";
            $nn_posts=mysql_num_rows(mysql_query($query));
?>

            Início: <?php echo $inicio; ?>, Fim: <?php echo $fim;?>,  <?php echo $nn_posts; ?> posts, <a href=<?php echo "ver-pauta.php?id=$pauta[id_pauta]";?> >Ver</a>

<?php
        }
?>
        </div>
<?php
    }
}
?>
<?php
require("rodape.php");
?>
    </div></div>

</body>
</html>
