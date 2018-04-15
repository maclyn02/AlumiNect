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
    <body> 
        <?php
        session_start();
        if(!empty($_SESSION['uID']))
        {
            $uid=$_SESSION['uID'];
            
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input type="submit" name="event" value="EVENT INVITES" class="btn">  <input type="submit" name="adbroadcasts" value="ADMIN BROADCASTS" class="btn">
            </form>
            <?php
                if(isset($_POST['event']))
                {
                    $query="select event_name,edate,etime,venue,manager from event where edate>sysdate() AND event_id in (select event_id from invite where al_uname='$uid') order by edate desc";
                    $result=mysqli_query($conn,$query);
                    ?>
                    <table align="center" height="100%" width="100%" cellspacing="0" cellpadding="5">
                        
                        <tr bgcolor="wheat">
                            <td width="200"><b>Name</b></td>
                            <td width="200"><b>DATE</b></td>
                            <td width="200"><b>TIME</b></td>
                            <td width="200"><b>VENUE</b></td>
                            <td width="200"><b>BY</b></td>
                        </tr>
                    <?php 
                    $count=1;
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                        if($count%2==0)
                                $color="antiqueWhite";
                        else
                            $color="whitesmoke";
                        ?>                         
                        <tr bgcolor="<?php echo $color;?>">
                            <td width="200"><?php echo $row['event_name'];?></td>
                            <td width="200"><?php echo $row['edate'];?></td>
                            <td width="200"><?php echo $row['etime'];?></td>
                            <td width="200"><?php echo $row['venue'];?></td>
                            <td width="200"><?php echo $row['manager'];?></td>
                        </tr>                      
                        <?php    
                        $count++;
                    }
                    ?>
                    </table>
                <?php
                }
                
                if(isset($_POST['adbroadcasts']))
                {
                    $query="select b.b_id,content,logid,d_n_t from broadcasts b natural join broadmessage bm where bm.al_uname='$uid'";
                    $result=mysqli_query($conn,$query);
                    ?>
                    <table align="center" height="100%" width="100%" cellspacing="0" cellpadding="5">
                        
                        <tr bgcolor="wheat">
                            <td width="600"><b>MESSAGE</b></td>
                            <td width="200"><b>DATE &TIME</b></td>
                            <td width="200"><b>BY</b></td>
                        </tr>
                    <?php 
                    $count=1;
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                        if($count%2==0)
                            $color="antiqueWhite";
                        else
                            $color="whitesmoke";
                        ?>                         
                        <tr bgcolor="<?php echo $color;?>">
                            <td width="600"><textarea style="width:600px;height:100px" readonly><?php echo $row['content'];?></textarea></td>
                            <td width="200"><?php echo $row['d_n_t'];?></td>
                            <td width="200"><?php echo $row['logid'];?></td>
                        </tr>                      
                        <?php    
                        $count++;
                    }
                    ?>
                    <tr>
                        <td colspan="4">
                            <input type="hidden" name="count" value="<?php echo $count?>">     
                        </td>
                    </tr>                                            
                    </table>
                <?php
                }
        }
        else
        {
            echo '<script> window.location.href="mainScreen.php";</script>';
        }
        ?>
    </body>
</html>
