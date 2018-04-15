<?php session_start();  ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Approve Registrations</title>
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">  
    </head>
    <body>        
        <?php
        if($_SESSION['who']=="superadmin")
        {   
            if(isset($_POST['approve']))
            {                
                $cnt=$_POST['count'];        
                for($i=1; $i<=$cnt; $i++)
                {                
                    if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                    {
                        $uid=$_POST['uid'.$i];  
                        include 'dbConnect.php';  
                        $query="UPDATE admin SET status='approved' WHERE (logid='$uid')";        
                        $result=mysqli_query($conn,$query);
                    }
                }
                ?>
                <script>window.location.href="approveAdmin.php";</script>
                <?php
            }  
            if(isset($_POST['check']))
            {
                $cnt=$_POST['count'];
                for($i=0; $i<$cnt; $i++)
                {           
                    echo "<script>document.getElementById('checkStatus'+".$i.").checked=true</script>";                               
                }
            }
            if(isset($_POST['toggle']))
            {
                $cnt=$_POST['count'];
                for($i=0; $i<$cnt; $i++)
                {           
                    if(isset($_POST['checkStatus'.$i]))
                        echo "<script>document.getElementById('checkStatus'+".$i.").checked=false;</script>"; 
                    else if(!isset($_POST['checkStatus'.$i]))
                        echo "<script>document.getElementById('checkStatus'+".$i.").checked=true;</script>";

                }
            }
            if(isset($_POST['uncheck']))
            {
                $cnt=$_POST['count'];
                for($i=0; $i<$cnt; $i++)
                {           
                    echo "<script>document.getElementById('checkStatus'+".$i.").checked=false</script>";             
                }
            }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <table align="center" width="75%" cellspacing="0" cellpadding="5">
                <tr>
                    <td colspan="7">
                        <center><h3>Approve Admin Users</h3></center>
                    </td>
                </tr>
                <tr bgcolor="wheat">
                    <td align="center">#</td>
                    <td>LOGIN ID</td>
                    <td align="center">NAME</td>
                    <td align="center">DESIGNATION</td>
                    <td align="center">DEPARTMENT</td>
                </tr>
                <?php
                include 'dbConnect.php';       
                $query="select * from admin where status='unapproved'";        
                $result=mysqli_query($conn,$query);
                $count=1;
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    if($count%2==0)
                                $color="antiqueWhite";
                            else
                                $color="whitesmoke";
                    ?>
                    <tr bgcolor="<?php echo $color;?>">                    
                        <td><input type="checkbox" id="<?php echo "checkStatus".$count; ?>" name="<?php echo "checkStatus".$count; ?>"></td>
                        <td align="center" width="200"><input type="text" name="<?php echo "uid".$count; ?>" style="background:<?php echo $color;?>;border-width:0px" value="<?php echo $row['logid'];?>" readonly></td>
                        <td align="center" width="200"><?php echo $row['fname']." ".$row['lname'];?></td>
                        <td align="center" width="200"><?php echo $row['desg'];?></td>
                        <td align="center" width="200"><?php echo $row['dept_name'];?></td>                    
                    </tr>                
                    <?php
                    $count++;
                }
                ?>                
                <tr>
                    <td colspan="4">
                        <input type="hidden" name="count" value="<?php echo $count?>">                                            
                        <input type="Submit" name="approve" value="APPROVE" class="btn">  
                        <input type="Submit" name="check" value="Select All" class="btn">
                        <input type="Submit" name="uncheck" value="Desselect All" class="btn">
                        <input type="Submit" name="toggle" value="Toggle" class="btn">
                    </td>
                </tr>
            </table>
        </form>  
        <?php
        }
        else
        {
            header("location:mainScreen.php");
        }
        ?>
    </body>
</html>
