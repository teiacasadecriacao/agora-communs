<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<?php
    // Funções utilizadas
    function data_brasil($adata)
    {
        $adata2 = explode("-",$adata);
        $adata3 = implode("/",array_reverse($adata2));
        return $adata3;
    }

    function data_brasil_adiante($adata, $ndias)
    { // utilizado em ver-pauta e em pautas-atuais
        $adata2 = explode("-",$adata);
        $adata3=date("d/m/Y",mktime(0,0,0,$adata2[1],$adata2[2]+$ndias, (int)$adata2[0]));
        return $adata3;
    }

    function estado_pauta($data1)
    {
        $dateArr  = explode("-",$data1);
        $data2=time();

        // testando para ver se está aberta para postagens
        $date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2]+14,(int)$dateArr[0]);
        $res=$date1Int -$data2;
        if($res>0)
            return "postagens";
        // testando para ver se está em votação
        $date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2]+28,(int)$dateArr[0]) ;
        $res=$date1Int -$data2;
        if($res>0)
            return "votacao";
        
        // no caso de não estar em nenhum dos dois casos anteriores, ela está finalizada
        return "finalizada";

    }

    function vencida($data1)
    {
        $dateArr  = explode("-",$data1);
        $data2=time();

        // testando para ver se está aberta para postagens
        $date1Int = mktime(0,0,0,$dateArr[1],$dateArr[2]+14,$dateArr[0]);
        $res=$date1Int - $data2;

        if($res > 0)
            return 0; // não vencida
        else
            return 1; // vencida
    }

    function autor($id_autor)
    {
        $query = "SELECT usuario FROM usuarios WHERE `id_usuario`='$id_autor';";
        $res = mysql_query($query);
        $assoc = mysql_fetch_assoc($res);
        return $assoc[usuario];
    }

    function conta($tabela,$campo,$valor)
    {// Conta quantas linhas da tabela possui o valor no campo especificado
        $query = "SELECT * FROM $tabela WHERE `$campo`='$valor';";
        $res = mysql_query($query);
        $n=mysql_num_rows($res);
        $num = ($n) ? $n:"0";
        return $num;
    }

    function tipo_post($tipo)
    {
        $texto= ($tipo == 1) ? "deliberação/encaminhamento" : "discussão/debate";
        return $texto;
    }

    // Conectando-se ao banco de dados
    $conecta = mysql_connect("mysql12.teia.org.br","teia12", "foobarman5" ) or die (mysql_error());
    $selectdb = mysql_select_db("teia12",$conecta) or die ("base de dados nao localizada");

    // Tranformar os dados recebidos pela conexao em UTF8
    mysql_query("SET NAMES 'UTF8'");
    mysql_query("SET CHARACTER set 'utf-8'");

    // Inicia sessão para lidar com usuários, permissões, etc
    session_start();
?>
