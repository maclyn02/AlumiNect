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
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">
        <title></title>
        <script>
            function bcast()
            {
                <?php
                if(isset($_POST['bc']))
                {
                    $cnt=$_POST['count']; 
                    $uchk=$_POST['logid'];
                    $bM=htmlentities($_POST['broadMessage'],ENT_QUOTES);
                    ?>
                        if(document.getElementById("broadMessage").value=="")
                        {
                            document.getElementById('emptyM').innerHTML='Cant send Empty message';
                            document.getElementById('broadMessage').focus();
                        }
                        else
                        {
                            <?php
                                $query="insert into broadcasts(content,logid) values ('$bM','$uchk')";
                                $result=mysqli_query($conn,$query);
                                $query="select max(b_id) as id from broadcasts";
                                $result=mysqli_query($conn,$query);
                                if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                    $id=$row['id'];
                                for($i=1; $i<=$cnt; $i++)
                                {                
                                    if(isset($_POST['checkStatus'.$i]) && $_POST['checkStatus'.$i]=="on")
                                    {
                                        $uid=$_POST['uid'.$i];  
                                        $query="insert into broadmessage values ('$id','$uid')";
                                        $result=mysqli_query($conn,$query);
                                    }
                                }
                            
                            ?>
                        } 
                    <?php
                }
                ?>
            }
        </script>
    </head>
    <body>
        <?php
        if(!empty($_SESSION['uID']))
        {
            $uchk=$_SESSION['uID'];
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table bgcolor="antiqueWhite" width="100%">
                <tr>
                    <td>Type Your Message Here>>><input type="hidden" name="logid" value="<?php echo $uchk;?>"></td>
                    <td><textarea name="broadMessage" id="broadMessage" style="height:200px;width:800px" onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"></textarea></td>
                </tr>
                <tr>
                    <td><p id="emptyM" style="color:red"></p></td>
                </tr>
            </table>
            <table bgcolor="wheat" align="center" height="100%" width="100%" style="border-width:0px" rules="none" frame="box">
                <tr>
                    <td width="200">                        
                    </td><td width="200">Name<br><input type="text" name="name"></td>
                    <td width="200">                        
                    </td><td width="200">Course<br>
                        <select name="course" style="width:200px;height:25px">
                            <?php
                                include ('dbConnect.php');
                                $query="select distinct course from coursemaster";

                                $result=mysqli_query($conn,$query);
                                ?>
                                <option>--select course--</option>
                                <?php
                                while ($row = mysqli_fetch_array($result,MYSQLI_NUM)) 
                                {   
                                    foreach($row as $item)
                                    {
                                        echo "<option>".$item."</option>";
                                    }
                                }

                            ?>
                        </select>
                    </td>
                    <td width="200"> 
                    <td width="200">Branch<br>
                        <select name="branch" style="width:200px;height:25px;">
                            <?php
                                $query="select branch from coursemaster";
								$result=mysqli_query($conn,$query);
                                ?>
                                <option>--select branch--</option>
                                <?php
                                while ($row = mysqli_fetch_array($result,MYSQLI_NUM)) 
                                {   
                                    foreach($row as $item)
                                    {
                                        echo "<option>".$item."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td width="200"> 
                    <td width="200">Year of Passing<br>
                        <select name="year" style="width:200px;height:25px;">
                            <?php
                                $query="select distinct y_o_g from alumnee where status='approved'";

                                $result=mysqli_query($conn,$query);
                                ?>
                                <option>--select year--</option>
                                <?php
                                while ($row = mysqli_fetch_array($result,MYSQLI_NUM)) 
                                {   
                                    foreach($row as $item)
                                    {
                                        echo "<option>".$item."</option>";
                                    }
                                }
                            ?>
                        </select>
                </tr>
                <tr>
                    <td><input type="submit" name="search" value="SEARCH" class="btn"></td>
                </tr>
            </table>
            <?php
                if(isset($_POST['search']))
                {
                    if(!empty($_POST['broadMessage']))
                    {
                        ?>
                        <script>
                            document.getElementById("broadMessage").value="<?php echo $_POST['broadMessage'];?>";
                        </script>                            
                        <?php
                    }
                    $n=$_POST['name'];
                    $b=$_POST['branch'];
                    $c=$_POST['course'];
                    $y=$_POST['year'];
                    
                    if(empty($n) && $y=='--select year--' && $c=='--select course--' && $b!='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND accept_messages='YES' AND branch='$b') order by al_lname";
                    }
                    else if(empty($n) && $y=='--select year--' && $c!='--select course--' && $b=='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND accept_messages='YES' AND course='$c') order by al_lname";
                    }
                    else if(empty($n) && $y=='--select year--' && $c!='--select course--' && $b!='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND accept_messages='YES' AND course='$c' AND branch='$b') order by al_lname";
                    }
                    else if(empty($n) && $y!='--select year--' && $c=='--select course--' && $b=='--select branch--')
                    {
                        $query="select a.al_uname,a.al_fname,m.al_mname,a.al_lname,a.course,a.branch,a.y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND accept_messages='YES' AND y_o_g=$y) order by al_lname";
                    }
                    else if(empty($n) && $y!='--select year--' && $c=='--select course--' && $b!='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND branch='$b' AND accept_messages='YES' AND y_o_g='$y') order by al_lname";
                    }
                    else if(empty($n) && $y!='--select year--' && $c!='--select course--' && $b=='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND y_o_g='$y' AND accept_messages='YES' AND course='$c') order by al_lname";
                    }
                    else if(empty($n) && $y!='--select year--' && $c!='--select course--' && $b!='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND course='$c' AND accept_messages='YES' AND y_o_g='$y' AND branch='$b') order by al_lname";
                    }
                    else if(!empty($n) && $y=='--select year--' && $c=='--select course--' && $b!='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                    }
                    else if(!empty($n) && $y=='--select year--' && $c=='--select course--' && $b!='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND branch='$b' AND accept_messages='YES' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                    }
                    else if(!empty($n) && $y=='--select year--' && $c!='--select course--' && $b=='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND course='$c' AND accept_messages='YES' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                    }
                    else if(!empty($n) && $y=='--select year--' && $c!='--select course--' && $b!='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND course='$c' AND accept_messages='YES' AND branch='$b' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                    }
                    else if(!empty($n) && $y!='--select year--' && $c=='--select course--' && $b=='--select branch--')
                    {
                        $query="select a.al_uname,a.al_fname,m.al_mname,a.al_lname,a.course,a.branch,a.y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND accept_messages='YES' AND y_o_g=$y AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                    }
                    else if(!empty($n) && $y!='--select year--' && $c=='--select course--' && $b!='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND accept_messages='YES' AND branch='$b' AND y_o_g='$y' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                    }
                    else if(!empty($n) && $y!='--select year--' && $c!='--select course--' && $b=='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND accept_messages='YES' AND y_o_g='$y' AND course='$c' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                    }
                    else if(!empty($n) && $y!='--select year--' && $c!='--select course--' && $b!='--select branch--')
                    {
                        $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND accept_messages='YES' AND course='$c' AND y_o_g='$y' AND branch='$b' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                    }
                    else
                    {
                        $query="select a.al_uname,a.al_fname,m.al_mname,a.al_lname,a.course,a.branch,a.y_o_g from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (a.status='approved' AND a.accept_messages='YES') order by a.al_lname";
                    }
					$result=mysqli_query($conn,$query);
                        $count=1;
                        ?>
                        <table bgcolor="wheat" width="100%" cellpadding="5" cellspacing="0">
                        <tr>
                            <td></td>
                            <td width="400">Name</td>
                            <td width="200">Course</td>
                            <td width="200"></td>
                            <td width="200">Branch</td>
                            <td width="200"></td>
                            <td width="200">Year of Passing</td>
                        </tr>
                    <?php
                    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                    {   
                        if($count%2==0)
                            $color="antiqueWhite";
                        else
                            $color="whitesmoke";

                        ?>
                        <tr bgcolor="<?php echo $color;?>">
                            <td><input type="checkbox" id="<?php echo "checkStatus".$count; ?>" name="<?php echo "checkStatus".$count; ?>"><input type="hidden" name="<?php echo "uid".$count; ?>" value="<?php echo $row['al_uname'];?>"></td>
                            <td width="400"><?php echo $row['al_fname']." ".$row['al_mname']." ".$row['al_lname'];?></td>        
                            <td width="200"><?php echo $row['course'];?></td>        
                            <td width="200"></td>   
                            <td width="200"><?php echo $row['branch'];?></td>        
                            <td width="200"></td>
                            <td width="200"><?php echo $row['y_o_g'];?></td>  
                            <td width="200"></td>
                        </tr>
                        <?php
                        $count++;
                    }
                    ?>
                        <tr>
                            <td colspan="4">
                                <input type="hidden" name="count" value="<?php echo $count?>">                                            
                                <input type="submit" name="bc" value="Broadcast" class="btn" onclick="bcast()"> 
                                <input type="button" name="check" value="Select All" class="btn" onclick="checkAll()">
                                <input type="button" name="uncheck" value="Desselect All" class="btn" onclick="unCheckAll()">
                                <input type="button" name="toggle" value="Toggle" class="btn" onclick="toggleBox()">
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
            mysqli_close($conn);                   
        }
        else
        {
            header("location:mainScreen.php");
        }
        ?>
    </body>
</html>
