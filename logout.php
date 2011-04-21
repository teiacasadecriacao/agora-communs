<!--
_o_o_ oOo _o_o_, 2011
Domínio público
Public domain.
-->

<?php
    session_start();
    session_unset();
    session_destroy();

    header("location:index.php");
?>
