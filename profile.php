<?php session_start();      ?>
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
        if(!empty($_SESSION['uID']))
        {
            include('dbConnect.php');
                $uid=  htmlentities($_GET['uid'],ENT_QUOTES);
                $query="select * from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (a.al_uname='$uid')";
				$result=mysqli_query($conn,$query);
                if($row=mysqli_FETCH_ARRAY($result,MYSQLI_ASSOC))
                {
                    $fname=$row['al_fname'];
                    $mname=$row['al_mname'];
                    $lname=$row['al_lname'];
                    $gen=$row['gender'];
                    $email=$row['al_email'];
                    $year_g=$row['y_o_g'];
                    $roll=$row['roll'];
                    $course=$row['course'];
                    $br=$row['branch'];
                    $add=$row['address'];
                    $city=$row['city'];
                    $state=$row['state'];
                    $nat=$row['nation'];
                    $pin=$row['pincode'];
                    $mob=$row['mob'];
                    $year_j=$row['y_o_j'];
                    $dob=$row['dob'];
                    $guide=$row['guide'];
                    $block=$row['accept_messages'];
                }

                ?>  
                <h3><center>Profile</center></h3>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <table align="left">
                         <tr>
                            <td class="heads" colspan="4" align="center">Login Details</td>
                        </tr>
                        <tr>
                            <td style="width:100">USERNAME</td>
                            <td style="width:100"></td>
                            <td><?php echo $uid;?></td>
                        </tr>
                        <tr>
                            <td class="heads" colspan="4" align="center">Personal Details</td>
                        </tr>
                        <tr>
                            <td>PHOTO<br><br></td>
                            <td style="width:100"></td>
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
                            <td style="width:100">Name </td>
                            <td style="width:100"></td>
                            <td><?php echo $fname." ".$mname." ".$lname;?></td>
                        </tr>
                        <tr>
                            <td style="width:100">Date of Birth </td>
                            <td style="width:100"></td>
                            <td><?php echo $dob;?></td>
                        </tr>
                        <tr>
                            <td style="width:100">Gender </td>
                            <td style="width:100"></td>
                            <td><?php echo $gen;?></td>
                        </tr>
                        <tr>
                            <td class="heads" colspan="4" align="center">Contact Details</td>
                        </tr>
                        <tr>
                            <td style="width:100">Address</td>
                            <td style="width:100"></td>
                            <td><?php echo $add;?></td>
                        </tr>
                        <tr>
                            <td style="width:100">City</td>
                            <td style="width:100"></td>
                            <td><?php echo $city;?></td>
                        </tr>
                        <tr>
                            <td style="width:100">State</td>
                            <td style="width:100"></td>
                            <td><?php echo $state;?></td>
                        </tr>
                        <tr>
                            <td style="width:100">Nation</td>
                            <td style="width:100"></td>
                            <td><?php echo $nat;?></td>
                        </tr>
                        <tr>
                            <td style="width:100">Pin-code</td>
                            <td style="width:100"></td>
                            <td><?php echo $pin;?></td>
                        </tr>
                        <tr>
                            <td style="width:100">Mobile Number</td>
                            <td style="width:100"></td>
                            <td><?php echo $mob;?></td>
                        </tr>
                        <tr>
                            <td style="width:100">E-mail ID</td>
                            <td style="width:100"></td>
                            <td><?php echo $email;?></td>
                        </tr>
                        <tr>
                            <td class="heads" colspan="4" align="center">Course Details</td>
                        </tr>
                        <tr>
                            <td style="width:100">Course</td>
                            <td style="width:100"></td>
                            <td><?php echo $course;?></td>                        
                        </tr>            
                        <tr>
                            <td style="width:100">Branch</td>
                            <td style="width:100"></td>
                            <td><?php echo $br;?></td>
                        </tr>            
                        <tr>
                            <td style="width:100">Roll number</td>
                            <td style="width:100"></td>
                            <td><?php echo $roll;?></td>
                        </tr>
                        <tr>
                            <td style="width:100">Year of joining</td>
                            <td style="width:100"></td>
                            <td><?php echo $year_j;?></td>
                        </tr>   
                        <tr>
                            <td style="width:100">Year of passing highest degree</td>
                            <td style="width:100"></td>
                            <td><?php echo $year_g;?></td>
                        </tr>  
                        <tr><td class="heads" colspan="3" align="center">Professional Info</td></tr>
                        <tr><td>Additional Qualification</td>
                        <?php
                        $query="select * from qualification where (al_uname='$uid')";
                        $result=mysqli_query($conn,$query);
                        while($r1=mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {
                            ?>
                            <td><?php echo $r1['qual'].",";?></td>
                            <?php
                        }
                        ?>  
                        </tr>
                        <tr><td>Workplace</td>
                        <?php
                        $query="select * from works_for where (al_uname='$uid')";
                        $result=mysqli_query($conn,$query);
                        while($r2=mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {
                            ?>
                            <td><?php echo $r2['org_name'].",";?></td>
                            <?php
                        }
                        ?>
                        </tr>
                        <tr><td>Associated Projects</td>
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
                        $result=mysqli_query($conn,$query);
                        while($r3=mysqli_fetch_array($result,MYSQLI_ASSOC))
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
                       <?php
                       if(empty($_SESSION['who']))
                       {
                           ?>
                           <tr>
                                <td style="width:100"></td>
                                <td style="width:100"></td>
                                <td><input type="Submit" name="edit" value="  EDIT  " class="btn"></td>
                            </tr>
                            <?php
                       }
                       ?>
                    </table>
                </form>
                <?php                                
                if(isset($_POST['edit']))
                {
                    echo "<script> window.location.href='editProfile.php';</script>";     
                }
                mysqli_close($conn);
        }
        else
        {
            echo "<script> window.location.href='mainScreen.php';</script>";    
        }
        ?>        
    </body>
</html>

