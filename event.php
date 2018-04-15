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
    </head>
    <body bgcolor="seashell">
        <?php
        if(!empty($_SESSION['uID']))
        {
        
        ?>  
        <a href="createEvent.php"><h2>Create New Event</h2></a>
        <hr>
        <?php
            include('dbConnect.php');
            $query="select e.event_id,e.event_name,e.venue,e.edate,e.etime,a.fname,a.lname from event e , admin a where e.manager=a.logid order by e.edate";
            
			$result=mysqli_query($conn,$query);

            ?>
                <table align="center" bgcolor="wheat" height="100%" width="100%" cellspacing="0" cellpadding="5">
                    <tr>  
                        <td align="center"><b>#</b></td>
                        <td align="center"><b>NAME</b></td>
                        <td align="center"><b>VENUE</b></td>
                        <td align="center"><b>DATE</b></td>
                        <td align="center"><b>TIME</b></td>
                        <td align="center"><b>MANAGER</b></td>
                       
                    </tr>
                    <?php
                    $count=1;
                    while ($row=mysqli_fetch_array($result,MYSQLI_NUM))
                    {   
                        if($count%2==0)
                                $color="antiqueWhite";
                            else
                                $color="whitesmoke";
                        ?>
                        <tr bgcolor="<?php echo $color;?>">
                            <td align="center"><a href="invitations.php?eid=<?php echo $row[0];?>">send invites</a></td>
                            <td align="center"><?php echo $row[1];?></td>    
                            <td align="center"><?php echo $row[2];?></td>        
                            <td align="center"><?php echo $row[3];?></td>        
                            <td align="center"><?php echo $row[4];?></td>   
                            <td align="center"><?php echo $row[5]." ".$row[6];?></td>  
                        </tr>
                        <?php
                        $count++;
                    }
                    ?>
                </table>
            <?php
        }
        else
        {
            echo '<script>window.location.href="mainScreen.php";</script>';
        }
        ?>
    </body>
</html>
