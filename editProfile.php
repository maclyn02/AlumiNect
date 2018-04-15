<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include 'dbConnect.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Profile</title>
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">
        <script type="text/javascript">
            function readURL(input) 
            {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();
                    reader.onload = function (e) 
                    {
                        document.getElementById('preview').src=e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            } 
            function IsNumeric(e,ids) 
            {
                var specialKeys = new Array();
                specialKeys.push(8);//backspace
                specialKeys.push(9);//tab
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
                if(!ret)
                {
                    document.getElementById(ids).innerHTML="Invalid character";
                }
                else
                {
                    document.getElementById(ids).innerHTML="";
                }
                return ret;
            }
            var email=/^[a-zA-Z0-9-_\.]+@[a-zA-Z]+\.[a-zA-Z]{2,3}$/;
            function readURL(input) 
            {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();
                    reader.onload = function (e) 
                    {
                        document.getElementById('preview').src=e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }             
            function IsNumeric(e,ids) 
            {
                var specialKeys = new Array();
                specialKeys.push(8);//backspace
                specialKeys.push(9);//tab
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
                if(!ret)
                {
                    document.getElementById(ids).innerHTML="Invalid character";
                }
                else
                {
                    document.getElementById(ids).innerHTML="";
                }
                return ret;
            }
            function validateForm()
            {
                if(document.regF.address.value=="")
                {
                    document.getElementById("iaddr").innerHTML="Enter address";
                    document.regF.address.focus();
                    return false;
                }
                else
                {
                    document.getElementById("iaddr").innerHTML="";
                }
                if(document.regF.city.value=="")
                {
                    document.getElementById("icity").innerHTML="Enter city";
                    document.regF.city.focus();
                    return false;
                }
                else
                {
                    document.getElementById("icity").innerHTML="";
                }
                if(document.regF.state.value=="")
                {
                    document.getElementById("istate").innerHTML="Enter state";
                    document.regF.state.focus();
                    return false;
                }
                else
                {
                    document.getElementById("istate").innerHTML="";
                }
                if(document.regF.nation.value=="")
                {
                    document.getElementById("inat").innerHTML="Enter nation";
                    document.regF.nation.focus();
                    return false;
                }
                else
                {
                    document.getElementById("inat").innerHTML="";
                }
                if(document.regF.pin.value=="")
                {
                    document.getElementById("ipin").innerHTML="Enter PINCODE";
                    document.regF.pin.focus();
                    return false;
                }
                else
                {
                    document.getElementById("ipin").innerHTML="";
                }
                if(document.regF.mob.value=="")
                {
                    document.getElementById("imob").innerHTML="Enter mobile number";
                    document.regF.mob.focus();
                    return false;
                }
                else
                {
                    document.getElementById("imob").innerHTML="";
                }
                if(document.regF.email.value=="")
                {
                        document.getElementById("imail").innerHTML="Enter an email address";
                        document.regF.email.focus();
                        return false;                    
                }
                else if(document.regF.email.value.search(email)==-1)
                {
                    document.getElementById("imail").innerHTML="Enter valid email address";
                    document.regF.email.focus();
                    return false;  
                }
                else
                {
                    document.getElementById("imail").innerHTML="";
                } 
                if(document.getElementById("p_app").selectedIndex==0)
                {
                    document.getElementById("ip").innerHTML="Select an option";
                    return false;
                }
                else
                {
                    document.getElementById("ip").innerHTML="";
                }
                if(document.getElementById("field").value=="")
                {
                    document.getElementById("if").innerHTML="Enter field";
                    document.getElementById("field").focus();
                    return false;
                }
                else
                {
                    document.getElementById("if").innerHTML="";
                }
                if(document.getElementById("m_app").selectedIndex==0)
                {
                    document.getElementById("im").innerHTML="Select an option";
                    return false;
                }
                else
                {
                    document.getElementById("im").innerHTML="";
                }
            }
        </script>
    </head>
    <body>
        <?php
        session_start();
        if(!empty($_SESSION['uID']))
        {
            $uid=$_SESSION['uID'];
            $query="select * from alumnee a left outer join mid_names m on a.al_uname=m.al_uname where (a.al_uname='$uid')";
			$result=mysqli_query($conn,$query);	
			if($row=mysqli_FETCH_ARRAY($result,MYSQLI_ASSOC))
            {                      
                $fname=htmlentities($row['al_fname'],ENT_QUOTES);
                $mname=htmlentities($row['al_mname'],ENT_QUOTES);
                $lname=htmlentities($row['al_lname'],ENT_QUOTES);
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
                $upass=htmlentities($row['al_pass'],ENT_QUOTES);
                $guide=$row['guide'];
                $block=$row['accept_messages'];
            }

            ?>  
            <h3><center>Profile</center></h3>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="editF" enctype="multipart/form-data">
                <table align="left">
                    <tr><td class="heads" colspan="2" align="center">Login Details</td></tr>
                    <tr><td style="width:200">USERNAME</td><td><?php echo $uid;?></td></tr>
                    <tr><td>Password</td><td><input type="password" name="upass" style="height:15px;width:200px" placeholder="Your current password">  <input type="submit" name="editpass" value="Edit" class="btn"></td></tr> 
                <?php
                if(isset($_POST['editpass']) && $_POST['upass']==$upass)
                {
                    ?>
                    <tr><td>New Password</td><td><input type="password" name="nupass" style="height:15px;width:200px"></td></tr> 
                    <tr><td>Confirm Password</td><td><input type="password" name="cupass" style="height:15px;width:200px">  <input type="submit" name="confirm" value="Confirm" class="btn"></td></tr> 
                    <?php
                }
                ?>             
                <tr><td class="heads" colspan="2" align="center">Personal Details</td></tr>
                <tr><td>PHOTO</td>
                    <?php
                        $query="select path from imgdb where (al_uname='$uid')";
                        $result=mysqli_query($conn,$query);	
                        if($r=mysqli_FETCH_ARRAY($result,MYSQLI_ASSOC))
                        {
                            ?>
                            <td><img id="preview" name="pic" src="<?php echo $r['path'];?>" height="150" width="150"></td>
                            <?php
                            if(isset($_POST['change']))
                            {
                                /////imgCode   
                            }
                        }
                        else
                        {
                            ?>
                            <td><img id="preview" name="pic" src="#" height="150" width="150" style="background-image: url(anonymous.jpg);background-size: 150px"></td>
                            <?php
                            if(isset($_POST['change']))
                            {
                                /////imgCode   
                            }
                        }
                    ?>
                </tr>                    
                <tr><td></td><td><input id="imgfile" name="file" type="file" onchange="readURL(this)" class="btn">  <input type="submit" name="change" value="Save" class="btn"></td></tr>
                <tr><td>Name<label style="color:red">*</label></td><td><?php echo $fname." ".$mname." ".$lname;?></td><td><p id="iname" style="color:red"></p></td></tr>
                <tr><td style="width:200">Date of Birth</td><td><?php echo $dob;?></td></tr>
                <tr><td style="width:200">Gender </td><td><?php echo $gen;?></td></tr>
                <tr><td class="heads" colspan="2" align="center">Contact Details</td></tr>
                <tr><td style="width:200">Address</td><td style="width:100"><input type="text" name="address" value="<?php echo $add;?>"></td></tr>
                <tr><td style="width:200">City</td><td style="width:100"><input type="text" name="city" value="<?php echo $city;?>"></td></tr>
                <tr><td style="width:200">State</td><td style="width:100"><input type="text" name="state" value="<?php echo $state;?>"></td></tr>
                <tr><td style="width:200">Nation</td><td style="width:100"><input type="text" name="nation" value="<?php echo $nat;?>"></td></tr>
                <tr><td style="width:200">Pin-code</td><td style="width:100"><input type="text" name="pin" value="<?php echo $pin;?>"></td></tr>
                <tr><td style="width:200">Mobile Number</td><td style="width:100"><input type="text" name="mob" maxlength="10" value="<?php echo $mob;?>" onkeypress="return IsNumeric(event,'imob');" ondrop="return false;" onpaste="return false;"></td><td><p id="imob" style="color:red"></p></td></tr>
                <tr><td style="width:200">E-mail ID</td><td style="width:100"><input type="text" name="email" value="<?php echo $email;?>"></td></tr>
                <tr><td class="heads" colspan="2" align="center">Course Details</td></tr>
                <tr><td style="width:200">Course</td><td><?php echo $course;?></td></tr>            
                <tr><td style="width:200">Branch</td><td><?php echo $br;?></td></tr>            
                <tr><td style="width:200">Roll number</td><td><?php echo $roll;?></td></tr>
                <tr><td style="width:200">Year of joining</td><td><?php echo $year_j;?></td></tr>   
                <tr><td style="width:200">Year of passing highest degree</td><td><?php echo $year_g;?></td></tr>            
                 <tr><td  class="heads" colspan="3" align="center">Service Contribution</td></tr>
                <tr height="50"><td>Are you interested in guiding <br> student projects/conducting <br> seminars/workshops ?  <label style="color:red">*</label></td>
                    <td><select name="p_app" id="p_app">
                            <?php
                            if($guide=="YES")
                            {
                                ?><option>YES</option>
                                  <option>NO</option><?php
                            }
                            else
                            {
                                ?><option>NO</option>
                                  <option>YES</option><?php
                            }
                            ?>
                        </select>
                    </td>
                    <td><p id="ip" style="color:red"></p></td>
                </tr>
                <tr><td id="fieldLabel"></td><td id="fieldBox"></td><td><p id="if" style="color:red"></p></td> </tr>
                <tr height="50">
                    <td>Do you wish to receive <br> broadcast messages from us ?  <label style="color:red">*</label></td>
                    <td><select name="m_app" id="m_app">
                            <?php
                            if($block=="YES")
                            {
                                ?><option>YES</option>
                                  <option>NO</option><?php
                            }
                            else
                            {
                                ?><option>NO</option>
                                  <option>YES</option><?php
                            }
                            ?>
                        </select>
                    </td>
                    <td><p id="im" style="color:red"></p></td>
                </tr>
                <tr><td style="width:200"></td><td align="right"><input type="Submit" name="save" value="SAVE" class="btn"></td></tr>
                </table>
            </form>
        <?php
        if(isset($_POST['confirm']) &&  $_POST['nupass']!="" && $_POST['nupass']==$_POST['cupass'])
        {
            $upass=  htmlentities($_POST['nupass'],ENT_QUOTES);
            $query="update alumnee set al_pass='$upass' where (al_uname='$uid')"; 
            $result=mysqli_query($conn,$query);	                        
        }
        if(isset($_POST['save']))
        {             
            $email=$_POST['email'];
            $add=htmlentities($_POST['address'],ENT_QUOTES);
            $city=$_POST['city'];
            $state=$_POST['state'];
            $nat=$_POST['nation'];
            $pin=$_POST['pin'];
            $mob=$_POST['mob'];
            $p_app=$_POST['p_app'];
            $m_app=$_POST['m_app'];

            $query="update alumnee set al_email='$email',address='$add',city='$city',state='$state',nation='$nat',pincode='$pin',mob='$mob',guide='$p_app',accept_messages='$m_app' where (al_uname='$uid')";
            $result=mysqli_query($conn,$query);	                 
            
            echo "<script> window.location.href='profile.php?uid=".$uid."';</script>";
        }
        }
        else 
        {
            header("location: mainScreen.php");
        }
        ?>        
    </body>
</html>

