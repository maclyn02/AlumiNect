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
        <title></title>        
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">
        <script>
            function delEvent()
            {
                <?php
                $cnt=$_POST['count']; 
                for($i=1; $i<=$cnt; $i++)
                {                
                    if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                    {
                        $eid=$_POST['eid'.$i];  
                        $query="delete from invite where (event_id='$eid')";        
                        $result=mysqli_query($conn,$query);
                        $query="delete from event where (event_id='$eid')";        
                        $result=mysqli_query($conn,$query);                       
                    }
                }
                ?>                       
            }
            function delBroadcast()
            {
                <?php
                $cnt=$_POST['count']; 
                for($i=1; $i<=$cnt; $i++)
                {                
                    if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                    {
                        $bid=$_POST['bid'.$i]; 
                        $query="delete from broadmessage where (b_id='$bid')";        
						$result=mysqli_query($conn,$query);
                        $query="delete from broadcasts where (b_id='$bid')";        
						$result=mysqli_query($conn,$query);                     
                    }
                }
                ?>                       
            }
            function delMessage()
            {
                <?php
                $cnt=$_POST['count']; 
                for($i=1; $i<=$cnt; $i++)
                {                
                    if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                    {
                        $mid=$_POST['mid'.$i];  
                        $query="delete from message where (mess_id='$mid')";        
                        $result=mysqli_query($conn,$query);                     
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
                <table width="100%" cellspacing="0">
                    <tr bgcolor="wheat">
                        <td><label style="font-size:25px">Search  : </label></td>
                        <td>
                            <select name="searchBox" style="height:30px;width:400px;font-size:20px">
                               <option>--SELECT OPTION--</option>
                               <option>Events</option>
                               <option>Broadcasts</option>
                               <option>Forum Messages</option>
                            </select>
                            <input type="submit" name="go" value="GO" class="btn">
                            
                        </td>
                        <td><p id="tem" style="color:red"></p><p id="invalid" style="color:red"></p></td>
                    </tr>
                </table>
            </form>
            <?php 
            $count=1;
            if(isset($_POST['go']))
            {
                if($_POST['searchBox']=="Events")
                {
                    $query="select * from event order by edate";
                    $result=mysqli_query($conn,$query);
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                    <table align="center" bgcolor="wheat" height="100%" width="100%" cellspacing="0" cellpadding="5">
                    <tr>  
                        <td align="center"><b>#</b></td>
                        <td align="center"><b>NAME</b></td>
                        <td align="center"><b>VENUE</b></td>
                        <td align="center"><b>DATE</b></td>
                        <td align="center"><b>TIME</b></td>
                        <td align="center"><b>MANAGER ID</b></td>
                       
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
                            <td align="center" width="200"><input type="checkbox" id="<?php echo "checkStatus".$count; ?>" name="<?php echo "checkStatus".$count; ?>"><input type="hidden" style="border-width:0px;background:<?php echo $color;?>" name="<?php echo "eid".$count; ?>" value="<?php echo $row['event_id'];?>" readonly></td>
                            <td align="center"><?php echo $row['event_name'];?></td>    
                            <td align="center"><?php echo $row['venue'];?></td>        
                            <td align="center"><?php echo $row['edate'];?></td>        
                            <td align="center"><?php echo $row['etime'];?></td>   
                            <td align="center"><?php echo $row['manager'];?></td>  
                        </tr>                        
                        <?php
                        $count++;
                    }
                    ?>
                    <tr>
                    <td colspan="4">
                    <input type="hidden" name="count" value="<?php echo $count?>">                                            
                    <input type="submit" name="bc" value="Delete" class="btn" onclick="delEvent()"> 
                    <?php
                }
                else if($_POST['searchBox']=="Broadcasts")
                {
                    $query="select * from broadcasts order by d_n_t desc";
                    $result=mysqli_query($conn,$query);
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                    <table align="center" bgcolor="wheat" height="100%" width="100%" cellspacing="0" cellpadding="5">
                    <tr>  
                        <td align="center"><b>#</b></td>
                        <td align="center"><b>MESSAGE</b></td>
                        <td align="center"><b>FROM</b></td>
                        <td align="center"><b>TIMESTAMP</b></td>
                       
                    </tr>
                    <?php
                    $count=1;
                    while ($row =mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                    {   
                        if($count%2==0)
                                $color="antiqueWhite";
                            else
                                $color="whitesmoke";
                        ?>
                        <tr bgcolor="<?php echo $color;?>">
                            <td align="center" width="200"><input type="checkbox" id="<?php echo "checkStatus".$count; ?>" name="<?php echo "checkStatus".$count; ?>"><input type="hidden" style="border-width:0px;background:<?php echo $color;?>" name="<?php echo "bid".$count; ?>" value="<?php echo $row['b_id'];?>" readonly></td>
                            <td align="center"><?php echo $row['content'];?></td>    
                            <td align="center"><?php echo $row['logid'];?></td>        
                            <td align="center"><?php echo $row['d_n_t'];?></td>        
                        </tr>    
                        <?php
                        $count++;
                    }
                    ?>
                    <tr>
                    <td colspan="4">
                    <input type="hidden" name="count" value="<?php echo $count?>">                                            
                    <input type="submit" name="bc" value="Delete" class="btn" onclick="delBroadcast()"> 
                    <?php
                }
                else if($_POST['searchBox']=="Forum Messages")
                {
                    $query="select * from message";
                    $result=mysqli_query($conn,$query);
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                    <table align="center" bgcolor="wheat" height="100%" width="100%" cellspacing="0" cellpadding="5">
                    <tr>  
                        <td align="center"><b>#</b></td>
                        <td align="center"><b>MESSAGE</b></td>
                        <td align="center"><b>BY</b></td>
                        <td align="center"><b>TIMESTAMP</b></td>
                       
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
                            <td align="center" width="200"><input type="checkbox" id="<?php echo "checkStatus".$count; ?>" name="<?php echo "checkStatus".$count; ?>"><input type="hidden" style="border-width:0px;background:<?php echo $color;?>" name="<?php echo "mid".$count; ?>" value="<?php echo $row['mess_id'];?>" readonly></td>
                            <td align="center"><?php echo $row['content'];?></td>    
                            <td align="center"><?php echo $row['user_id'];?></td>        
                            <td align="center"><?php echo $row['d_nt'];?></td>         
                        </tr>
                        <?php
                        $count++;
                    }
                    ?>
                    <tr>
                    <td colspan="4">
                    <input type="hidden" name="count" value="<?php echo $count?>">                                            
                    <input type="submit" name="bc" value="Delete" class="btn" onclick="delMessage()"> 
                    
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
