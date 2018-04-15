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
       <?php
            include('dbConnect.php');
            $uid=htmlentities($_GET['uid'],ENT_QUOTES);
            if($_SESSION['who']!="")
            {
                header("location:profile.php?uid=$uid");
            }
            
            $query="select * from profile_info where (al_uname='$uid')";
			$result=mysqli_query($conn,$query);
            while($row=mysqli_FETCH_ARRAY($result,MYSQLI_ASSOC))
            {
                    $fname=$row['al_fname'];
                    $mname=$row['al_mname'];
                    $lname=$row['al_lname'];
                    $gen=$row['gender'];
                    $year_g=$row['y_o_g'];
                    $course=$row['course'];
                    $br=$row['branch'];
                    $year_j=$row['y_o_j'];
                    $guide=$row['guide'];
                    $block=$row['accept_messages'];

                ?>  
                <h3><center>Profile</center></h3>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                    <table align="left">
                         <tr>
                            <td class="heads" colspan="2" align="center">Login Details</td>
                        </tr>
                        <tr>
                            <td style="width:200">USERNAME</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td class="heads" colspan="2" align="center">Personal Details</td>
                        </tr>
                        <tr>
                            <td>PHOTO<br><br></td>
                            <?php
                                $query="select path from imgdb where (al_uname='$uid')";
                                $result=mysqli_query($conn,$query);
                                if($r=mysqli_FETCH_ARRAY($result,MYSQLI_ASSOC))
                                {
                                    ?>
                                    <td><img id="preview" name="pic" src="<?php echo $r['path'];?>" height="150" width="150"></td>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <td><img id="preview" name="pic" src="#" height="150" width="150" style="background-image: url(anonymous.jpg);background-size: 150px"></td>
                                    <?php
                                }
                            ?>
                        </tr>
                        <tr>
                            <td style="width:200">Name </td>
                            <td><?php echo $fname." ".$mname." ".$lname;?></td>
                        </tr>
                        <tr>
                            <td style="width:200">Date of Birth</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td style="width:200">Gender </td>
                            <td style="width:200"><?php echo $gen;?></td>
                        </tr>
                        <tr>
                            <td class="heads" colspan="2" align="center">Contact Details</td>
                    </tr>
                        <tr>
                            <td style="width:200">Address</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td style="width:200">City</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td style="width:200">State</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td style="width:200">Nation</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td style="width:200">Pin-code</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td style="width:200">Mobile Number</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td style="width:200">E-mail ID</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td class="heads" colspan="2" align="center">Course Details</td>
                        </tr>
                        <tr>
                            <td style="width:200">Course</td>
                            <td><?php echo $course;?></td>                        
                        </tr>            
                        <tr>
                            <td style="width:200">Branch</td>
                            <td><?php echo $br;?></td>
                        </tr>            
                        <tr>
                            <td style="width:200">Roll number</td>
                            <td>Not Available</td>
                        </tr>
                        <tr>
                            <td style="width:200">Year of joining</td>
                            <td><?php echo $year_j;?></td>
                        </tr>   
                        <tr>
                            <td style="width:200">Year of passing highest degree</td>
                            <td><?php echo $year_g;?></td>
                        </tr> 
                        <tr><td class="heads" colspan="3" align="center">Professional Info</td></tr>
                        <tr><td style="width:200">Additional Qualification</td><td>Not Available</td></tr>
                        <tr><td style="width:200">Workplace</td><td>Not Available</td></tr>
                        <tr><td style="width:200">Associated Projects</td>
                        <?php
                        $query="select * from guided where (al_uname='$uid')";
                        $result=mysqli_query($conn,$query);
                        while($r3=mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {
                            ?>
                            <td><?php echo $r3['project_name']."(".$r3['project_area']."), ";?></td>
                            <?php
                        }
                        ?>
                        <tr><td  class="heads" colspan="3" align="center">Service Contribution</td></tr>
                        <tr height="50"><td>Interested in guiding <br> student projects/conducting <br> seminars/workshops ?  <label style="color:red">*</label></td>
                            <td><?php echo $guide;?></td>
                        </tr>
                       <tr><td>Fields of interest</td>
                        <?php
                        $query="select * from fields where (al_uname='$uid')";
                        $stid=mysqli_query($conn,$query);
                        while($r3==mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {
                            ?>
                            <td><?php echo $r3['field_name'].",";?></td>
                            <?php
                        }
                        ?>
                        </tr>
                        <tr>
                            <td>Receive broadcast messages?</td>
                            <td><?php echo $block;?></td>
                       </tr>
                    </table>
                </form>
                <?php
            }
        ?>        
    </body>
</html>

