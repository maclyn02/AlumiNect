
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        try
        {
            $host="HOSTNAME";
            $user="USERNAME";
            $password="PASSWORD";
            $dbname="DATABASENAME";
            
            $conn=  mysqli_connect($host,$user,$password,$dbname);
            
        }
        catch(Exception $e)
        {
            echo "Message: ".$e->getMessage();
        }
        ?>
    </body>
</html>
