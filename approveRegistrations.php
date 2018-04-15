<?php session_start();  ?>
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
        <title>Approve Registrations</title>        
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">  
    </head>
    <body bgcolor="antiquewhite">        
        <?php
        if(!empty($_SESSION['uID']))
        {            
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <table align="center" width="75%" cellspacing="0" cellpadding="5">
                    <tr>
                        <td colspan="7">
                            <center><h3>Approve Users</h3></center>
                        </td>
                    </tr>
                    <tr bgcolor="wheat">
                        <td align="center">#</td>
                        <td>USERNAME</td>
                        <td align="center">NAME</td>
                        <td align="center">Course</td>
                        <td align="center">Branch</td>
                        <td align="center">ROLL NUMBER</td>
                    </tr>
                    <?php   
                    $query="select * from alumnee where status='unapproved'";        
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
                            <td align="center" width="200"><input type="checkbox" id="<?php echo "checkStatus".$count; ?>" name="<?php echo "checkStatus".$count; ?>"></td>
                            <td align="center" width="200"><input type="text" style="border-width:0px;background:<?php echo $color;?>" name="<?php echo "uid".$count; ?>" value="<?php echo $row['al_uname'];?>" readonly></td>
                            <td align="center" width="200"><?php echo $row['al_fname']." ".$row['al_lname'];?></td>
                            <td align="center" width="200"><?php echo $row['course'];?></td>
                            <td align="center" width="200"><?php echo $row['branch'];?></td>                      
                            <td align="center" width="200"><?php echo $row['roll'];?></td>                    
                        </tr>                
                        <?php
                        $count++;
                    }
                    ?>                
                    <tr>
                        <td colspan="4">
                            <input type="hidden" name="count" value="<?php echo $count?>">                                            
                            <input type="Submit" name="approve" value="Approve" class="btn">  
                            <input type="submit" name="check" value="Select All" class="btn">
                            <input type="Submit" name="uncheck" value="Desselect All" class="btn">
                            <input type="Submit" name="toggle" value="Toggle" class="btn">
                        </td>
                    </tr>
                </table>
            </form>   
        <?php
        if(isset($_POST['approve']))
            {                
                $cnt=$_POST['count'];        
                for($i=1; $i<=$cnt; $i++)
                {                
                    if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                    {
                        $uid=htmlentities($_POST['uid'.$i],ENT_QUOTES);  
                        $query="UPDATE alumnee SET status='approved' WHERE (al_uname='$uid')";        
                        $result=mysqli_query($conn,$query);
                    }
                }
                echo '<script> window.location.href="approveRegistrations.php";</script>';
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
        }
        else
        {
            header("location:mainScreen.php");
        }
        ?>
    </body>
</html>
