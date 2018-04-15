<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Discussion Forum</title>
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css"> 
    </head>
    <body>
        <?php
        session_start();
        if(!empty($_SESSION['uID']))
        {
            include('dbConnect.php');
                $uid=$_SESSION['uID'];
                $query="select user_id,content,d_n_t from message order by d_n_t desc";
				$result=mysqli_query($conn,$query);
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    >>><input type="text" name="mcontent" style="height:20px;width:300px" placeholder="Type your message here">
                    <input type="submit" name="send" value="SEND" class="btn">
                </form>
        
                <hr>
                
                <table bgcolor="wheat" align="center" style="border-style:dotted;border-width: 5px;border-color:seashell" frame="box">
                <td align="center" style="width:50px">BY</td>
                <td align="center" style="width:500px">MESSAGE</td>
                <td align="center" style="width:100px">TIMESTAMP</td>
                <?php
                while($row=mysqli_FETCH_ARRAY($result,MYSQLI_ASSOC))
                {
                    ?>
                    <tr>                        
                        <td style="width:50px" align="center"><?php echo $row['user_id'];?></td>  
                        <td align="center" style="width:500px"><input type="text" class="chat" value="<?php echo $row['content'];?>" readonly></td>
                        <td align="center" style="width:150px"><?php echo $row['d_n_t'];?></td>
                    </tr>
                    <?php
                }
                ?>                 
                </table>
            <?php
            if(isset($_POST['send']) && $_POST['mcontent']!="")
            {
                $mcontent=$_POST['mcontent'];                
                $query="insert into message(content,user_id) values('$mcontent','$uid')";                
                $result=mysqli_query($conn,$query);
                echo '<script> window.location.href="discussions.php"; </script>';                
            }
        }
        else
        {
            header("location:mainScreen.php");
        }
        ?>
    </body>
</html>
