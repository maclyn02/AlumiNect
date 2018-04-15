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
            function delAdmin()
            {                
                <?php
                    $cnt=$_POST['count']; 
                    if(isset($_POST['bc']))
                    {
                        for($i=1; $i<=$cnt; $i++)
                        {                
                            if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                            {
                                $lid=htmlentities($_POST['lid'.$i],ENT_QUOTES);  
                                $query="delete from ad_mid_names where (logid='$lid')";        
                                $result=mysqli_query($conn,$query);
                                $query="delete from admin where (logid='$lid')";        
                                $result=mysqli_query($conn,$query);
                            }
                        }
                    }
                ?>               
            }
            function delAlumni()
            {                
                <?php
                    $cnt=$_POST['count']; 
                    if(isset($_POST['bc']))
                    {
                        for($i=1; $i<=$cnt; $i++)
                        {                
                            if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                            {
                                try                               
                                {
                                    $alid=htmlentities($_POST['alid'.$i],ENT_QUOTES);  
                                    $query="delete from mid_names where (al_uname='$alid')";        
                                    $result=mysqli_query($conn,$query);
                                    $query="delete from imgtdb where (al_uname='$alid')";        
                                    $result=mysqli_query($conn,$query);
                                    $query="delete from broadmessages where (al_uname='$alid')";        
                                    $result=mysqli_query($conn,$query);
                                    $query="delete from alumnee where (al_uname='$alid')";        
                                    $result=mysqli_query($conn,$query);
                                    $query="delete from fields where (al_uname='$alid')";        
                                    $result=mysqli_query($conn,$query);
                                    $query="delete from guided where (al_uname='$alid')";        
                                    $result=mysqli_query($conn,$query);
                                    $query="delete from qualification where (al_uname='$alid')";        
                                    $result=mysqli_query($conn,$query);
                                    $query="delete from works_for where (al_uname='$alid')";        
                                    $result=mysqli_query($conn,$query);
                                } 
                                catch (Exception $ex) 
                                {
                                    echo $ex->getMessage();
                                }
                            }
                        }
                    }
                ?>               
            }
            function unApproveAdmin()
            {                
                <?php
                    $cnt=$_POST['count']; 
                    if(isset($_POST['unApproveAd']))
                    {
                        for($i=1; $i<=$cnt; $i++)
                        {                
                            if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                            {
                                $lid=$_POST['lid'.$i];  
                                $query="update admin set status='unapproved' where (logid='$lid')";        
                                $result=mysqli_query($conn,$query);
                            }
                        }
                    }
                ?>               
            }
            function unApproveAlumni()
            {                
                <?php
                    $cnt=$_POST['count']; 
                    if(isset($_POST['unApprove']))
                    {
                        for($i=1; $i<=$cnt; $i++)
                        {                
                            if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                            {
                                $alid=$_POST['alid'.$i];  
                                $query="update alumnee set status='unapproved' where (al_uname='$alid')";        
                                $result=mysqli_query($conn,$query);
                            }
                        }
                    }
                ?>               
            }
        </script>
    </head>
    <body>
        <?php
        if($_SESSION['who']=="superadmin")
        { 
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table width="100%" cellspacing="0" cellpadding="10">
                    <tr bgcolor="wheat" cellspacing="0">
                        <td><label style="font-size:25px">Search  : </label></td>
                        <td>
                            <select name="searchBox" style="height:30px;width:400px;font-size:20px">
                                <option>--SELECT OPTION--</option>
                                <option>Admins</option>
                                <option>Alumni</option>
                            </select>
                            <input type="submit" name="go" value="GO" class="btn">
                        </td>
                        <td><p id="invalid" style="color:red"></p></td>
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
            if(isset($_POST['go']))
            {
                if($_POST['searchBox']=="Admins")
                {
                    $query="select a.logid,fname,mname,lname,desg,dept_name,status from admin a left outer join ad_mid_names m on a.logid=m.logid where a.logid not in (select logid from superadmin)";
                    $result=mysqli_query($conn,$query);
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                    <table align="center" bgcolor="wheat" height="100%" width="100%" cellspacing="0" cellpadding="5">
                    <tr>  
                        <td align="center"><b>#</b></td>
                        <td align="center"><b>FULL NAME</b></td>
                        <td align="center"><b>DESIGNATION</b></td>
                        <td align="center"><b>DEPARTMENT</b></td>
                        <td align="center"><b>STATUS</b></td>                       
                    </tr>
                    <?php
                    $count=1;
                    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                    {   
                        if($count%2==0)
                                $color="antiqueWhite";
                            else
                                $color="whitesmoke";
                        ?>
                        <tr bgcolor="<?php echo $color;?>">
                            <td align="center" width="200"><input type="checkbox" id="<?php echo "checkStatus".$count; ?>" name="<?php echo "checkStatus".$count; ?>"><input type="hidden" style="border-width:0px;background:<?php echo $color;?>" name="<?php echo "lid".$count; ?>" value="<?php echo $row['logid'];?>" readonly></td>
                            <td align="center"><?php echo $row['fname']." ".$row['mname']." ".$row['lname'];?></td>    
                            <td align="center"><?php echo $row['desg'];?></td>        
                            <td align="center"><?php echo $row['dept_name'];?></td>        
                            <td align="center"><?php echo $row['status'];?></td>   
                        </tr>                       
                        <?php
                        $count++;
                    }
                    ?>
                    <tr>
                    <td colspan="4">
                    <input type="hidden" name="count" value="<?php echo $count?>">                                            
                    <input type="submit" name="bc" value="Delete" class="btn" onclick="delAdmin()"> 
                    <input type="submit" name="unApproveAd" value="UnApprove" class="btn" onclick="unApproveAdmin()">
                    <?php
                }
                else if($_POST['searchBox']=="Alumni")
                {
                    $query="select a.al_uname,al_fname,al_mname,al_lname,course,branch,y_o_g,status from alumnee a left outer join mid_names m on a.al_uname=m.al_uname";
                    $result=mysqli_query($conn,$query);
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                    <table align="center" bgcolor="wheat" height="100%" width="100%" cellspacing="0" cellpadding="5">
                    <tr>  
                        <td align="center"><b>#</b></td>
                        <td align="center"><b>FULL NAME</b></td>
                        <td align="center"><b>COURSE</b></td>
                        <td align="center"><b>BRANCH</b></td>
                        <td align="center"><b>YEAR OF PASSING</b></td>       
                        <td align="center"><b>STATUS</b></td>  
                    </tr>
                    <?php
                    $count=1;
                    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                    {   
                        if($count%2==0)
                                $color="antiqueWhite";
                            else
                                $color="whitesmoke";
                        ?>
                        <tr bgcolor="<?php echo $color;?>">
                            <td align="center" width="200"><input type="checkbox" id="<?php echo "checkStatus".$count; ?>" name="<?php echo "checkStatus".$count; ?>"><input type="hidden" style="border-width:0px;background:<?php echo $color;?>" name="<?php echo "alid".$count; ?>" value="<?php echo $row['al_uname'];?>" readonly></td>
                            <td align="center"><?php echo $row['al_fname']." ".$row['al_mname']." ".$row['al_lname'];?></td>    
                            <td align="center"><?php echo $row['course'];?></td>        
                            <td align="center"><?php echo $row['branch'];?></td>        
                            <td align="center"><?php echo $row['y_o_g'];?></td>    
                            <td align="center"><?php echo $row['status'];?></td>    
                        </tr>                        
                        <?php
                        $count++;
                    }
                    ?>
                    <tr>
                    <td colspan="4">
                    <input type="hidden" name="count" value="<?php echo $count?>">                                            
                    <input type="submit" name="bc" value="Delete" class="btn" onclick="delAlumni()"> 
                    <input type="submit" name="unApprove" value="UnApprove" class="btn" onclick="unApproveAlumni()">
                    <?php
                }
                else
                {
                    echo "<script>document.getElementById('invalid').innerHTML='Please select an option';</script>";
                }
                
                ?>                    
                            <input type="button" name="check" value="Select All" class="btn" onclick="checkAll()">
                            <input type="button" name="uncheck" value="Desselect All" class="btn" onclick="unCheckAll()">
                            <input type="button" name="toggle" value="Toggle" class="btn" onclick="toggleBox()">
                        </td>
                    </tr>
                </table>
            </form>
            <?php    
            echo "<script>function checkAll(){var cnt=document.forms[1].count.value;"
            . "for(i=1; i<cnt; i++){"
                    . "document.getElementById('checkStatus'+i).checked=true;}}"
                        ."function unCheckAll(){var cnt=document.forms[1].count.value;"
            . "for(i=1; i<cnt; i++){"
                    . "document.getElementById('checkStatus'+i).checked=false;}}"
                        ."function toggleBox(){var cnt=document.forms[1].count.value;"
            . "for(i=1; i<cnt; i++){"
                    ."if(document.getElementById('checkStatus'+i).checked==true){"
                    . "document.getElementById('checkStatus'+i).checked=false;}"
                    ."else if(document.getElementById('checkStatus'+i).checked==false){"
                    ."document.getElementById('checkStatus'+i).checked=true;}}}</script>";     
            }            
        } 
        else
        {
           header("location:mainScreen.php"); 
        }
        ?>         
    </body>
</html>
