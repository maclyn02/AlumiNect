<?php session_start(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include_once 'dbConnect.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>        
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">
        <script>
            function validate()
            {
                if(document.editF.uname.value=="")
                {
                    document.getElementById("iname").innerHTML="Username Required!";
                    document.editF.uname.focus();
                    return false;
                }
                else
                {
                    document.getElementById("iname").innerHTML="";
                }
                if(document.editF.upass.value=="")
                {
                    document.getElementById("ipass").innerHTML="Password Required!";
                    document.editF.upass.focus();
                    return false;
                }
                else
                {
                    document.getElementById("ipass").innerHTML="";
                }
                if(document.editF.uskey.value=="")
                {
                    document.getElementById("iskey").innerHTML="SuperKey Required!";
                    document.editF.uskey.focus();
                    return false;
                }
                else
                {
                    document.getElementById("iskey").innerHTML="";
                }
            }
        </script>
    </head>
    <body>
        <?php
        
        if(!empty($_SESSION['who']))
        {
            $uid=$_SESSION['uID'];
            ?>
        <br><br><br><br>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="editF">
            <table align="center" height="400" width="400" bgcolor="wheat" cellpadding="10" cellspacing="0" class="logtbl">
                <tr><td colspan="3" align="center"><h3>Authentication<h3></td></tr>
                <tr><td colspan="3" align="center"><p id="error" style="color:red"></p></td></tr>
                <tr><td>Enter Username</td><td><input type="text" name="uname"></td><td><p id="iname" style="color:red"></p></td></tr>
                <tr><td>Enter Password</td><td><input type="password" name="upass"></td><td><p id="ipass" style="color:red"></p></td></tr>
                <tr><td>Enter SuperKey</td><td><input type="password" name="uskey"></td><td><p id="iskey" style="color:red"></p></td></tr>
                <tr><td><input type="submit" name="next" value="NEXT" class="btn" onclick="return validate();"></td></tr>
            
                <?php
                if(isset($_POST['next']))
                {
                   $uid=htmlentities($_POST['uname'],ENT_QUOTES);
                   $upass=htmlentities($_POST['upass'],ENT_QUOTES);
                   $uskey=htmlentities($_POST['uskey'],ENT_QUOTES);

                   $query="select logid from admin a natural join superadmin s where (logid='$uid' AND upass='$upass' AND superpass='$uskey')";         
                   $result=mysqli_query($conn,$query);
                   if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                   {
                       ?>
                       <script>
                           document.editF.uname.value="<?php echo $_POST['uname'];?>";
                           document.editF.upass.value="<?php echo $_POST['upass'];?>";
                           document.editF.uskey.value="<?php echo $_POST['uskey'];?>";
                       </script>
                       <tr><td>Enter New SuperKey</td><td><input type="password" name="newkey"></td></tr>
                       <tr><td>Confirm SuperKey</td><td><input type="password" name="cnewkey"></td></tr>
                       <tr><td><input type="submit" name="save" value="SAVE" class="btn"></td></tr>
                       <?php
                   }
                   else
                   {
                       ?>
                       <script>
                           document.getElementById("error").innerHTML="Invalid credentials";
                       </script>
                       <?php
                   }
                }
                ?>
            </table>
        </form>
        <?php
        if(isset($_POST['save']))
        {
            if($_POST['newkey']==$_POST['cnewkey'])
            {
                $skey=htmlentities($_POST['newkey'],ENT_QUOTES);
                $query="update superadmin set superpass='$skey' where (logid='$uid')";
                $result=mysqli_query($conn,$query);
                echo '<script> window.location.href="search.php"; </script>';
            }
        }
        }
        else
        {
            header("location:mainScreen.php");
        }
        ?>
    </body>
</html>
