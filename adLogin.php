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
        <title>Admin login</title>
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">        
    </head>
    <body>
        <br><br><br><br>
        
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <table align="center" class="logtbl" height="400">
                <tr>
                    <td colspan="4" align="center">
                        <p id="error" style="color:red"></p>
                        <label style="font-family:fantasy;font-size:40px">ADMIN LOGIN</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><label style="font-family:fantasy;font-size:30px">Username</label></td>
                    <td colspan="2"><input type="text" name="uid" style="height:30px;width:300px" required></h5></td>
                </tr>
                <tr>
                    <td colspan="2"><label style="font-family:fantasy;font-size:30px">Password</label></td>
                    <td colspan="2"><input type="password" name="upass" style="height:30px;width:300px" required><h4></td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><input type="Submit" name="login" value="LOGIN" style="height:60px;width:200px;background-color:tan;border:solid;border-width:0px;font-size:20px;cursor:pointer"><br>
                        <label style="font-family:fantasy;font-size:25px"><a href="adminRegistration.php">New Registration</a></label></td>
                </tr>
            </table>
        </form>
        
        <?php
        if(isset($_POST['login']) && $_POST['uid']!="" && $_POST['upass']!="")
        {
            include 'dbConnect.php';
        
            $uid=$_POST['uid'];
            $upass=$_POST['upass'];
            $flag=0;
        
            $query="select fname,status from admin where ( logid='$uid' AND upass='$upass')";
                
            $result=mysqli_query($conn,$query);
        
            if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
            {
                if($row['status']=="unapproved")
                {
                   $flag=1;
                }
                else
                {
                    $uname=$row['fname'];
                    $flag=2;                  
                }                
            }
        
            if($flag==1)
            {            
                echo "<script>document.getElementById('error').innerHTML='You Have not been approved yet!';</script>";
            }
            else if($flag==2)
            {
                $_SESSION['username']=$uname;
                $_SESSION['uID']=$uid; 
                ?>
                <script>
                    (window.parent || window).location="adminHome.php";
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
