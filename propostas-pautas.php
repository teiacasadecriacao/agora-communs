<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

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

    <h1>Propostas em validação</h1>
    <div class="wrapper" >
<?php
$query = "SELECT * FROM pautas WHERE `estado` >= '0';";
$res = mysql_query($query);
// echo mysql_num_rows($res);
// $pauta=mysql_fetch_assoc($res);
// print_r($pauta);
// $pauta=mysql_fetch_assoc($res); echo "<br />";
// print_r($pauta);
while($pauta=mysql_fetch_assoc($res))
{
    if(!vencida($pauta[data_criacao]))
    {
        $query = "SELECT * FROM validacoes WHERE `id_pauta`='$pauta[id_pauta]';";
        $res2=mysql_query($query);
        $num=mysql_num_rows($res2);
        $link="validar.php?id=$pauta[id_pauta]";
        $fim=data_brasil_adiante($pauta[data_criacao],14);

        $query="SELECT * FROM comentarios WHERE `id_pauta`='$pauta[id_pauta]' AND `id_postagem`='0';";
        $res3=mysql_query($query);
        $n_coment=mysql_num_rows($res3);
?>
        <div class = "pauta-atual">
            <div class="proposta-pauta-conteudo">
                <p class="pauta-atual-autor"><b>autor:</b> <?php echo autor($pauta[id_autor]); ?></p>
                <p class="pauta-atual-titulo"><b>Pauta:</b> <?php echo $pauta[titulo]; ?></p>
                <p style="overflow:auto"><?php echo $pauta[pauta]; ?></p>
            </div>
        Validação: <?php echo $num; ?> <input type="button" onclick="window.open('<?php echo $link;?>','Verifica Validação','width=450,height=450')" value="Validar"  />
        fim: <?php echo $fim; ?>,
        <a href="<?php echo "comentarios-pauta.php?id=$pauta[id_pauta]";?>"> <?php echo $n_coment; ?> comentários</a>
        </div>

<?php
    }
}
if($_SESSION[nivel] == "1") // admin ou tem passe.
{
?>
        <p>
            <input type="button" onclick="window.open('adicionar-pauta.php','NOVA PAUTA','width=450,height=450')" value="Adicionar Pauta"  />
        </p>
<?php
}
require("rodape.php");
?>
    </div>
</body>
</html>
