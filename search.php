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
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">        
    </head>
    <body>
      
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <table bgcolor="wheat" align="center" height="100%" width="100%" cellpadding="5" cellspacing="0">
            <tr>
                <td style="width:300px">Name<br><input type="text" name="name"></td>
                <td style="width:300px">Course<br>
                    <select name="course" style="width:200px;height:25px">
                        <?php
                            include ('dbConnect.php');
                            $query="select distinct course from coursemaster";
							$result=mysqli_query($conn,$query);
                            ?>
                            <option>--select course--</option>
                            <?php
                            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                            {   
                                foreach($row as $item)
                                {
                                    echo "<option>".$item."</option>";
                                }
                            }

                        ?>
                    </select>
                </td>
                <td style="width:300px">Branch<br>
                    <select name="branch" style="width:200px;height:25px;">
                        <?php
                            $query="select branch from coursemaster";
							$result=mysqli_query($conn,$query);			
                            ?>
                            <option>--select branch--</option>
                            <?php
                            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                            {   
                                foreach($row as $item)
                                {
                                    echo "<option>".$item."</option>";
                                }
                            }
                        ?>
                    </select>
                </td>
                <td style="width:300px">Year of Passing<br>
                    <select name="year" style="width:200px;height:25px;">
                        <?php
                            $query="select distinct y_o_g from alumnee where status='approved'";
							$result=mysqli_query($conn,$query);
                            ?>
                            <option>--select year--</option>
                            <?php
                            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
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
        </form>
        <?php
            if(isset($_POST['search']))
            {
                $n=$_POST['name'];
                $b=$_POST['branch'];
                $c=$_POST['course'];
                $y=$_POST['year'];

                if(empty($n) && $y=='--select year--' && $c=='--select course--' && $b!='--select branch--')
                {
                    $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND branch='$b') order by al_lname";
                }
                else if(empty($n) && $y=='--select year--' && $c!='--select course--' && $b=='--select branch--')
                {
                    $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND course='$c') order by al_lname";
                }
                else if(empty($n) && $y=='--select year--' && $c!='--select course--' && $b!='--select branch--')
                {
                    $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND course='$c' AND branch='$b') order by al_lname";
                }
                else if(empty($n) && $y!='--select year--' && $c=='--select course--' && $b=='--select branch--')
                {
                    $query="select a.al_uname,a.al_fname,m.al_mname,a.al_lname,a.course,a.branch,a.y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND y_o_g=$y) order by al_lname";
                }
                else if(empty($n) && $y!='--select year--' && $c=='--select course--' && $b!='--select branch--')
                {
                    $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND branch='$b' AND y_o_g='$y') order by al_lname";
                }
                else if(empty($n) && $y!='--select year--' && $c!='--select course--' && $b=='--select branch--')
                {
                    $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND y_o_g='$y' AND course='$c') order by al_lname";
                }
                else if(empty($n) && $y!='--select year--' && $c!='--select course--' && $b!='--select branch--')
                {
                    $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND course='$c'  AND y_o_g='$y' AND branch='$b') order by al_lname";
                }
                else if(!empty($n) && $y=='--select year--' && $c=='--select course--' && $b=='--select branch--')
                {
                    $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                }
                else if(!empty($n) && $y=='--select year--' && $c=='--select course--' && $b!='--select branch--')
                {
                    $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND branch='$b' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                }
                else if(!empty($n) && $y=='--select year--' && $c!='--select course--' && $b=='--select branch--')
                {
                    $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND course='$c' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                }
                else if(!empty($n) && $y=='--select year--' && $c!='--select course--' && $b!='--select branch--')
                {
                    $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND course='$c' AND branch='$b' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                }
                else if(!empty($n) && $y!='--select year--' && $c=='--select course--' && $b=='--select branch--')
                {
                    $query="select a.al_uname,a.al_fname,m.al_mname,a.al_lname,a.course,a.branch,a.y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND y_o_g=$y AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                }
                else if(!empty($n) && $y!='--select year--' && $c=='--select course--' && $b!='--select branch--')
                {
                    $query="select a.al_uname,al_fname,al_lname,m.al_mname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname  where (status='approved' AND branch='$b' AND y_o_g='$y' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                }
                else if(!empty($n) && $y!='--select year--' && $c!='--select course--' && $b=='--select branch--')
                {
                    $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND y_o_g='$y' AND course='$c' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                }
                else if(!empty($n) && $y!='--select year--' && $c!='--select course--' && $b!='--select branch--')
                {
                    $query="select a.al_uname,al_fname,m.al_mname,al_lname,course,branch,y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (status='approved' AND course='$c' AND y_o_g='$y' AND branch='$b' AND (al_fname like '%$n%' OR al_mname like '%$n%' OR al_lname like '%$n%')) order by al_lname";
                }
                else
                {
                    $query="select a.al_uname,a.al_fname,m.al_mname,a.al_lname,a.course,a.branch,a.y_o_g,guide from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (a.status='approved') order by a.al_lname";
                }
                    $result=mysqli_query($conn,$query);

                    ?>
                    <table align="center" height="100%" width="100%" cellpadding="5" cellspacing="0">
                        <tr bgcolor="wheat">
                            <td width="200"><b>#</b></td>
                            <td width="500"><b>NAME</b></td>
                            <td width="200"><b>COURSE</b></td>
                            <td width="200"></td>
                            <td width="200"><b>BRANCH</b></td>
                            <td width="100"></td>
                            <td width="100"><b>YEAR OF PASSING</b></td>
                            <td width="100"></td>
                            <td width="100"><b>AVAILABLE AS GUIDE?</b></td>
                            <td width="100"></td>
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
                            <td><a href="userProfile.php?uid=<?php echo $row['al_uname'];?>">view</a></td>
                            <td width="500"><?php echo $row['al_fname']." ".$row['al_mname']." ".$row['al_lname'];?></td>        
                            <td width="200"><?php echo $row['course'];?></td>        
                            <td width="200"></td>   
                            <td width="200"><?php echo $row['branch'];?></td>        
                            <td width="100"></td>
                            <td width="100"><?php echo $row['y_o_g'];?></td>  
                            <td width="100"></td>
                            <td width="100"><?php echo $row['guide'];?></td>  
                            <td width="100"></td>
                        </tr>
                        <?php
                        $count++;
                    }
                    ?>
                    </table>
                    <?php
            }
            mysqli_close($conn);      
        ?>
    </body>
</html>
