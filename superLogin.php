<?php session_start(); ?>
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
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">
        
    </head>
    <body>
        <br><br><br><br>
        
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <table align="center" class="logtbl" height="400">
                <tr>
                    <td colspan="4" align="center">
                        <p id="error" style="color:red"></p>
                        <label style="font-family:fantasy;font-size:40px">Login</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><label style="font-family:fantasy;font-size:30px">Username</label></td>                    
                    <td colspan="2"><input type="text" name="uid" style="height:30px;width:300px" required autofocus></h5></td>
                </tr>
                <tr>
                    <td colspan="2"><label style="font-family:fantasy;font-size:30px">SuperKey</label></td>
                    <td colspan="2"><input type="password" name="upass" style="height:30px;width:300px" required><h4></td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><input type="Submit" name="login" value="LOGIN" style="height:60px;width:200px;background-color:tan;border:solid;border-width:0px;font-size:20px;cursor:pointer"><br>
                    </td>
                </tr>
            </table>
        </form>
        
        <?php
        if(isset($_POST['login']))
        {
            include 'dbConnect.php';
        
            $uid=htmlentities($_POST['uid'],ENT_QUOTES);
            $upass=htmlentities($_POST['upass'],ENT_QUOTES);
            $flag=0;
        
            $query="select a.fname from superadmin s natural join admin a where ( logid='$uid' AND superpass='$upass')";
            $result=mysqli_query($conn,$query);
        
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
            {
                $flag=1;
                $uname=$row['fname'];
                break;   
            }
        
            if($flag==1)
            {            
                $_SESSION['username']=$uname;
                $_SESSION['who']="superadmin";
                $_SESSION['uID']=$uid;
                ?>
                <script>
                    (window.parent || window).location="superHome.php";
                </script>
                <?php
            }
            else
            {                                                                                 
                 echo "<script>document.getElementById('error').innerHTML='Invalid credentials!';</script>";
            }        
        }
        ?>
    </body>
</html>
