<?php

include_once('dbConnect.php');
if(isset($_POST['invite']))
    {                
    $cnt=$_POST['count'];   
    $eid=$_POST['eid'];
    
        for($i=1; $i<=$cnt; $i++)
        {                
            if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
            {
                $uid=htmlentities($_POST['uid'.$i],ENT_QUOTES);   
                $query="select al_uname as c from invite where (al_uname='$uid' AND event_id=$eid)";
                $result=mysqli_query($conn,$query);
                if(!mysqli_fetch_array($result,MYSQLI_NUM))
                {
                    $query="insert into invite values ('$uid',$eid)";  
                    $result=mysqli_query($conn,$query);
                }
            }
        } 
        echo '<script> window.location.href="invitations.php?eid=$eid"; </script>';
    }        
?>
