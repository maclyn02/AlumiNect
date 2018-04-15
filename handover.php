<?php session_start(); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once('dbConnect.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>        
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">
    </head>
    <body>
    <?php
    
    if($_SESSION['who']=="superadmin")
    { 
        $user=$_SESSION['uID'];
        ?>
         <br><br><br><br>
        
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <br><br><br>
            <table align="center" class="logtbl" height="400">
                <tr>
                    <td colspan="4" align="center">
                        <p id="error" style="color:red"></p>
                        <label style="font-family:fantasy;font-size:30px">Handover SuperAdmin Rights</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><label style="font-family:fantasy;font-size:20px">New SuperAdmin</label></td>                    
                    <td colspan="2"><select name="uid" style="height:30px;width:300px">
                            <option>--SELECT NEW SUPERADMIN--</option>
                            <?php
                            $query="select logid from admin where status='approved' AND logid!='$user'";
                            $result=mysqli_query($conn,$query);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                    echo "<option>".$row['logid']."</option>";
                            ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="center"><input type="Submit" name="save" value="SAVE" class="btn" style="height:30px;width:150px"><br>
                </tr>
            </table>
        </form>
        
        <?php
        if(isset($_POST['save']))
        {
            $uid=htmlentities($_POST['uid'],ENT_QUOTES);
            ?>
             <script>
                 if(confirm("Are you sure to handover your rights??"))
                 {
                    <?php
                    $query="update superadmin set logid='$uid' where logid='$user' ";                
                    $result=mysqli_query($conn,$query); 
                    $_SESSION['who']="";
                    echo "(window.parent || window).location='adminHome.php'";
                    ?>                            
                 }
             </script>
             <?php       
        }
    } 
    else
    {
       header("location:mainScreen.php"); 
    }
    ?>  
    </body>
</html>
