<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<!-- Para onde vai este link de ver detalhes? Que conteúdo será disposto nele? -->
<?php
$pressed=3;
require("cabecalho.php");
?>

<h1>Deliberações Online</h1>
    <div class="wrapper" >
<?php
$query = "SELECT * FROM pautas WHERE `estado` = '-1';";
$res = mysql_query($query);
while($pauta=mysql_fetch_assoc($res))
{
    if(estado_pauta($pauta[data_validacao])=="finalizada")
    {
        $fim=data_brasil_adiante($pauta[data_validacao],28);
        $query="SELECT * FROM postagens WHERE `tipo`='1' AND `id_pauta`='$pauta[id_pauta]'";
        $res2=mysql_query($query);
?>
        <div class = "pauta-atual" style="background-color:Lavender;">
            <div class="proposta-pauta-conteudo" style="background-color:Lavender;">
                <p class="pauta-atual-autor"><b>autor:</b> <?php echo autor($pauta[id_autor]); ?></p>
                <p class="pauta-atual-titulo"><b>Pauta:</b> <?php echo $pauta[titulo]; ?></p>
                <p style="overflow:auto"><?php echo $pauta[pauta]; ?></p>
            </div>
            <div style="background-color:YellowGreen;">
                <h3 style="color:white;margin:25px;"><u>Deliberações:</u></h3>
                <ol style="color:white;">
<?php
        while($delib=mysql_fetch_assoc($res2))
        {
            $querya = "SELECT * FROM votos WHERE `id_postagem`='$delib[id_postagem]' AND `voto`='1';";
            $queryc = "SELECT * FROM votos WHERE `id_postagem`='$delib[id_postagem]' AND `voto`='0';";
            $resa=mysql_query($querya);
            $resc=mysql_query($queryc);
            $numa=mysql_num_rows($resa);
            $numc=mysql_num_rows($resc);
//             if($numa>$numc)
//             {
?>
                <li><?php echo $delib[postagem];?>
                -- <b><?php echo ($numa>$numc)?"A FAVOR":"CONTRA"; ?></b></li><br />
<?php                
//             }
        }
?>
            </div>
            <a href="ver-pauta.php?id=<?php echo $pauta[id_pauta]; ?>">Ver detalhes</a>
            Encerrada: <?php echo $fim; ?>
        </div>
<?php
    }

}
require("rodape.php");
?>
</body>
</html>
