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
    </head>
    <body bgcolor="antiqueWhite">        
        <?php
        
        if(!empty($_SESSION['uID']))
        {
            $eid=$_GET['eid'];
            ?>
            <form action="invite.php" method="post">
                <table align="center" width="75%">
                    <tr><td colspan="7" align="center"><h3>Select Whom to Invite</h3></td></tr>          
                    <?php    
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
                            <td align="center" width="200"><input type="checkbox" id="<?php echo "checkStatus".$count; ?>" name="<?php echo "checkStatus".$count; ?>"><input type="hidden" style="border-width:0px;background:<?php echo $color;?>" name="<?php echo "uid".$count; ?>" value="<?php echo $row['al_uname'];?>" readonly></td>
                            <td align="center"><?php echo $row['al_fname']." ".$row['al_mname']." ".$row['al_lname'];?></td>    
                            <td align="center"><?php echo $row['course'];?></td>        
                            <td align="center"><?php echo $row['branch'];?></td>        
                            <td align="center"><?php echo $row['y_o_g'];?></td>    
                        </tr>                        
                        <?php
                        $count++;
                    }
                    ?>            
                    <tr>
                        <td colspan="4">
                            <input type="hidden" name="count" value="<?php echo $count?>">  
                            <input type="hidden" name="eid" value="<?php echo $eid?>"> 
                            <input type="Submit" name="invite" value="Invite" class="btn">  
                            <input type="button" name="check" value="Select All" class="btn" onclick="checkAll();">
                            <input type="button" name="uncheck" value="Desselect All" class="btn" onclick="unCheckAll();">
                            <input type="button" name="toggle" value="Toggle Checks" class="btn" onclick="toggleBox()">
                        </td>
                    </tr>
                </table>
            </form>   
        <?php
        echo "<script>function checkAll(){var cnt=document.forms[0].count.value;"
                    . "for(i=1; i<cnt; i++){"
                            . "document.getElementById('checkStatus'+i).checked=true;}}"
                                ."function unCheckAll(){var cnt=document.forms[0].count.value;"
                    . "for(i=1; i<cnt; i++){"
                            . "document.getElementById('checkStatus'+i).checked=false;}}"
                                ."function toggleBox(){var cnt=document.forms[0].count.value;"
                    . "for(i=1; i<cnt; i++){"
                            ."if(document.getElementById('checkStatus'+i).checked==true){"
                            . "document.getElementById('checkStatus'+i).checked=false;}"
                            ."else if(document.getElementById('checkStatus'+i).checked==false){"
                            ."document.getElementById('checkStatus'+i).checked=true;}}}</script>";  
        }
        else
        {
            echo '<script> window.location.href="mainScreen.php"; </script>';
        }
        ?>
    </body>
</html>
