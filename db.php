<?php
    //global connection for my dreamhost database
    $conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200355061', 'gc200355061', 'ej4^Yxm6');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>