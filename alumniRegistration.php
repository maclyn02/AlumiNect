<!DOCTYPE html>

<?php
    include_once 'dbConnect.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alumni Registration Page</title>
    <link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css">     
    <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">  
    <script type="text/javascript" src="jsDatePick.min.1.3.js"></script>  
    <script type="text/javascript">
	window.onload = function()
        {
		new JsDatePick({useMode:2,target:"dateField",dateFormat:"%Y-%m-%d"});
	};
    </script>
    <script type="text/javascript">
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
            function getFieldOfInterest()
            {
                if(document.getElementById("p_app").value=="YES")
                {
                    document.getElementById("fieldLabel").innerHTML="Enter key Field of Interest<font color='red'>*</font>";
                    document.getElementById("fieldBox").innerHTML="<input type='text' id='field' name='field'>";
                    document.getElementById("field").focus();                    
                }
                else
                {
                    document.getElementById("fieldLabel").innerHTML="";
                    document.getElementById("fieldBox").innerHTML="<input type='hidden' id='field' name='field'>";                    
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
            function IsAlpha(e,ids) 
            {
                var specialKeys = new Array();
                specialKeys.push(8);//backspace
                specialKeys.push(9);//tab
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || specialKeys.indexOf(keyCode) != -1);
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
            function IsAlphaQuote(e,ids) 
            {
                var specialKeys = new Array();
                specialKeys.push(8);//backspace
                specialKeys.push(9);//tab
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 39 || specialKeys.indexOf(keyCode) != -1);
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
            function IsEmail(e,ids) 
            {
                var specialKeys = new Array();
                specialKeys.push(8);//backspace
                specialKeys.push(9);//tab
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 64 && keyCode <= 90) || (keyCode >= 48 && keyCode <= 57) || (keyCode >= 97 && keyCode <= 122) || keyCode == 46 || specialKeys.indexOf(keyCode) != -1);
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
                if(document.getElementById("reg").value=="invalid")
                {
                    document.getElementById("in_uname").innerHTML="Please click check to verify your username";
                    document.regF.uname.focus();
                    return false;
                }
                else
                {
                    document.getElementById("iyp").innerHTML="";             
                }
                if(document.regF.uname.value=="")
                {
                    document.getElementById("in_uname").innerHTML="Enter username";
                    document.regF.uname.focus();
                    return false;
                }
                else
                {
                     document.getElementById("in_uname").innerHTML="";
                }
                if(document.regF.upass.value=="")
                {
                    document.getElementById("ipass").innerHTML="Provide password";
                    document.regF.upass.focus();
                    return false;
                }
                else
                {
                     document.getElementById("ipass").innerHTML="";
                }   
                if(document.regF.upass.value!=document.regF.cupass.value)
                {
                    document.getElementById("ipass").innerHTML="Re-type password";
                    document.regF.upass.value="";
                    document.regF.upass.focus();
                    document.regF.cupass.value="";
                    return false;
                }
                else
                {
                     document.getElementById("ipass").innerHTML="";
                } 
                if(document.regF.fname.value=="")
                {
                    document.getElementById("iname").innerHTML="Enter your name";
                    document.regF.fname.focus();
                    return false;
                }
                if(document.regF.lname.value=="")
                {
                    document.getElementById("iname").innerHTML="Enter your name";
                    document.regF.lname.focus();
                    return false;
                }
                else
                {
                     document.getElementById("iname").innerHTML="";
                }
                if(document.regF.bdate.value=="")
                {
                    document.getElementById("idate").innerHTML="Enter birth date";
                    document.regF.bdate.focus();
                    return false;
                }
                else
                {
                    document.getElementById("idate").innerHTML="";
                }
                if(!document.getElementById("s1").checked && !document.getElementById("s2").checked)
                {
                    document.getElementById("isex").innerHTML="Enter gender";
                    return false;
                }
                else
                {
                    document.getElementById("isex").innerHTML="";
                }
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
                if(document.regF.course.selectedIndex==0)
                {
                    document.getElementById("icourse").innerHTML="Enter course name";
                    return false;
                }
                else
                {
                    document.getElementById("icourse").innerHTML="";
                }
                if(document.regF.branch.selectedIndex==0)
                {
                    document.getElementById("ibranch").innerHTML="Enter branch name";
                    return false;
                }
                else
                {
                    document.getElementById("ibranch").innerHTML="";
                }
                if(document.regF.roll.value=="")
                {
                    document.getElementById("iroll").innerHTML="Enter roll number";
                    document.regF.roll.focus();
                    return false;
                }
                else
                {
                    document.getElementById("iroll").innerHTML="";
                }
                if(document.regF.yj.selectedindex==0)
                {
                    document.getElementById("iyj").innerHTML="select year of joining";
                    return false;
                }
                else
                {
                    document.getElementById("iyj").innerHTML="";
                }
                if(document.regF.yp.selectedindex==0)
                {
                    document.getElementById("iyp").innerHTML="select year of passing";
                    return false;
                }
                else if(document.regF.yj.value>=document.regF.yp.value)
                {
                    document.getElementById("iyp").innerHTML="year of passing cant be less than year of joining";
                    return false;
                }
                else
                {
                    document.getElementById("iyp").innerHTML="";             
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
                if(document.getElementById("work").value!="")
                {
                    if(document.getElementById("workdesc").value=="")
                    {
                        document.getElementById("iwork").innerHTML="Please describe your workplace";
                        return false;
                    }
                }
                else
                {
                    document.getElementById("iwork").innerHTML="";
                }
                if(document.getElementById("project").value!="")
                {
                    if(document.getElementById("projectAr").value=="")
                    {
                        document.getElementById("ipro").innerHTML="Please enter Project area";
                        return false;
                    }
                }
                else
                {
                    document.getElementById("ipro").innerHTML="";
                }
            }
    </script>
    </head>
    <body>
        <h3><center>Register Now...</center></h3>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="regF" enctype="multipart/form-data">
            <table align="left">
                <tr><td class="heads" colspan="3" align="center">Login Details</td></tr>
                
                <tr><td>USERNAME
                    <label style="color:red">*</label></td><td>
                    <input type="text" name="uname">     
                    <input type="Submit" name="check" value="CHECK" class="btn"></td>
                    <td><p id="in_uname" style="color:red"></p></td>
                </tr>
                
                <tr><td>PASSWORD<label style="color:red">*</label></td><td><input type="password" name="upass"></td><td><p id="ipass" style="color:red"></td></tr>
                
                <tr><td>CONFIRM PASSWORD<label style="color:red">*</label></td><td><input type="password" name="cupass"></td></tr> 
                
                <tr><td  class="heads" colspan="3" align="center">Personal Details</td></tr>
                
                <tr><td>PHOTO</td><td><img id="preview" name="pic" src="#" height="150" width="150" style="background-image: url(anonymous.jpg);background-size: 150px"></td></tr>
                <tr><td></td><td><input id="fileToUpload" name="fileToUpload" type="file" onchange="readURL(this);"></td></tr>
                
                <tr><td>Name<label style="color:red">*</label></td><td colspan="3"><input type="text" name="fname" placeholder="First Name" onkeypress="return IsAlphaQuote(event,'iname');" ondrop="return false;" onpaste="return false;"><input type="text" name="mname" placeholder="Middle Name(optional)" onkeypress="return IsAlphaQuote(event,'iname');" ondrop="return false;" onpaste="return false;"><input type="text" name="lname" placeholder="Last Name" onkeypress="return IsAlphaQuote(event,'iname');" ondrop="return false;" onpaste="return false;"></td><td><p id="iname" style="color:red"></p></td></tr>
                
                <tr><td>Date of Birth<label style="color:red">*</label></td><td><input type="text" id="dateField" name="bdate" readonly placeholder="select birth date"></td><td><p id="idate" style="color:red"></p></td></tr>
                
                <tr><td>Gender<label style="color:red">*</label></td><td><input type="radio" name="gen" id="s1" value="male"> Male<input type="radio" name="gen" id="s2" value="female"> Female</td><td><p id="isex" style="color:red"></p></td></tr>
                
                <tr><td  class="heads" colspan="3" align="center">Contact Details</td></tr>
                
                <tr><td>Permanent Address<label style="color:red">*</label></td><td><textarea name="address" style="height:50px;width:300px" onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"></textarea></td><td><p id="iaddr" style="color:red"></p></td></tr>
                
                <tr><td>City/Village<label style="color:red">*</label></td><td><input type="text" name="city" onkeypress="return IsAlpha(event,'icity');" ondrop="return false;" onpaste="return false;"></td><td><p id="icity" style="color:red"></p></td></tr>
                
                <tr><td>State<label style="color:red">*</label></td><td><input type="text" name="state" onkeypress="return IsAlpha(event,'istate');" ondrop="return false;" onpaste="return false;"></td><td><p id="istate" style="color:red"></p></td></tr>
                
                <tr><td>Nation<label style="color:red">*</label></td><td><input type="text" name="nation" onkeypress="return IsAlpha(event,'inat');" ondrop="return false;" onpaste="return false;"></td><td><p id="inat" style="color:red"></p></td></tr>
                
                <tr><td>Pin-code<label style="color:red">*</label></td><td><input type="text" name="pin" maxlength="6" onkeypress="return IsNumeric(event,'ipin');" ondrop="return false;" onpaste="return false;"></td><td><p id="ipin" style="color:red"></p></td></tr>
                
                <tr><td>Mobile Number<label style="color:red">*</label></td><td><input type="text" name="mob" maxlength="10" onkeypress="return IsNumeric(event,'imob');" ondrop="return false;" onpaste="return false;" ></td><td><p id="imob" style="color:red"></p></td></tr>
                
                <tr><td>E-mail ID<label style="color:red">*</label></td><td><input type="text" name="email" onkeypress="return IsEmail(event,'imail');" ondrop="return false;" onpaste="return false;"></td><td><p id="imail" style="color:red"></p></td></tr>
                
                <tr><td class="heads" colspan="3" align="center">Course Details</td></tr>
                
                <tr><td>Course<label style="color:red">*</label></td>
                    <td><select name="course">
                        <option>--select course--</option>
                    <?php
                        $query="select distinct course from coursemaster";
                        
                        $result=mysqli_query($conn,$query);
                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                        {                            
                            echo "<option>".$row['course']."</option>";                   
                        }
                    ?>
                    </select>
                    </td>   
                    <td><p id="icourse" style="color:red"></p></td>
                </tr>            
                
                <tr><td>Branch<label style="color:red">*</label></td>
                    <td><select name="branch">
                        <option>--select branch--</option>
                    <?php
                        $query="select branch from coursemaster";                        
                         $result=mysqli_query($conn,$query);
                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                        {  
                           echo "<option>".$row['branch']."</option>";                            
                        }
                        
                    ?>
                    </select>
                    </td><td><p id="ibranch" style="color:red"></p></td>
                </tr>   
                
                <tr><td>Roll number<label style="color:red">*</label></td><td><input type="text" name="roll" onkeypress="return IsNumeric(event,'iroll');" ondrop="return false;" onpaste="return false;"></td>
                    <td><p id="iroll" style="color:red"></p></td>
                </tr>
                
                <tr><td>Year of joining<label style="color:red">*</label></td>
                    <td><select name="yj">
                            <option>--select year--</option>
                            <script>
                            var tdate=new Date();
                            for(var i=tdate.getFullYear();i>=tdate.getFullYear()-80;i--)
                            {
                                document.write("<option>"+i+"</option>");
                            }
                            </script>
                    </td><td><p id="iyj" style="color:red"></p></td>
                </tr> 
                
                <tr><td>Year of passing highest degree<label style="color:red">*</label></td>
                    <td><select name="yp">
                            <option>--select year--</option>
                            <script>
                            var tdate=new Date();
                            for(var i=tdate.getFullYear();i>=tdate.getFullYear()-80;i--)
                            {
                                document.write("<option>"+i+"</option>");
                            }
                            </script>
                    </td>
                    <td><p id="iyp" style="color:red"></p></td>
                </tr> 
                
                <tr><td  class="heads" colspan="3" align="center">Professional Info</td></tr>
                <tr><td>Additional Qualification</td><td><input type="text" name="qual" onkeypress="return IsAlpha(event,'iqual');" ondrop="return false;" onpaste="return false;"></td><td><p id="iqual" style="color:red"></p></td></tr>   
                <tr><td>Workplace</td><td><input type="text" name="work" id="work"></td></tr> 
                <tr><td>Description of workplace</td><td><textarea name="workdesc" id="workdesc" style="height:50px;width:300px" onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"></textarea></td><td><p id="iwork" style="color:red"></p></td></tr>
                <tr><td>Associated Project Name</td><td><input type="text" id="project" name="project"></td></tr> 
                <tr><td>Project Area</td><td><input type="text" id="projectAr" name="projectAr"></td><td><p id="ipro" style="color:red"></p></td></tr> 
                
                <tr><td  class="heads" colspan="3" align="center">Service Contribution</td></tr>
                <tr height="50"><td>Are you interested in guiding <br> student projects/conducting <br> seminars/workshops ?  <label style="color:red">*</label></td>
                    <td><select name="p_app" id="p_app" onchange="return getFieldOfInterest();">
                            <option>--CHOOSE OPTION--</option>
                            <option>YES</option>
                            <option>NO</option>
                        </select>
                    </td>
                    <td><p id="ip" style="color:red"></p></td>
                </tr>
                <tr><td id="fieldLabel"></td><td id="fieldBox"></td><td><p id="if" style="color:red"></p></td> </tr>
                <tr height="50">
                    <td>Do you wish to receive <br> broadcast messages from us ?  <label style="color:red">*</label></td>
                    <td><select name="m_app" id="m_app">
                            <option>--CHOOSE OPTION--</option>
                            <option>YES</option>
                            <option>NO</option>
                        </select>
                    </td>
                    <td><p id="im" style="color:red"></p></td>
                </tr>
                
                
                <tr><td>Your suggestion </td><td><textarea name="suggest" style="height:100px;width:400px" onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"></textarea></td></tr>
                
                <tr><td></td><td><input type="submit" name="register" value="REGISTER" onclick="return validateForm()" class="btn"></td><input type="hidden" id="reg" value="invalid"></tr>
                <tr><td><label style="color:red">*</label> are MANDATORY fields</td></tr>
            </table>
        </form>
           
        <?php        
        if(isset($_POST['check']))
        {
            $uchk=htmlentities($_POST['uname'],ENT_QUOTES);
            $query="select al_uname from alumnee where (al_uname='$uchk')";
            
            $result=mysqli_query($conn,$query);
            if($row=mysqli_FETCH_ARRAY($result,MYSQLI_NUM) && $_POST['uname']!="")
            {                      
                ?>
                <script>
                    document.getElementById('in_uname').innerHTML='Username already in use! Provide another username to proceed';
                    document.regF.uname.focus();
                </script>
                <?php
            }                      
            else
            {
                ?>
                <script>
                    document.getElementById('in_uname').innerHTML='Username valid';
                    document.regF.uname.value="<?php echo $_POST['uname'];?>";
                    document.regF.upass.focus();
                    document.getElementById('reg').value='valid';
                </script>
                <?php
            }
        }        
        if(isset($_POST['register']))
        {
                $uname=htmlentities($_POST['uname'],ENT_QUOTES);
                $fname=htmlentities($_POST['fname'],ENT_QUOTES);
                $mname=htmlentities($_POST['mname'],ENT_QUOTES);
                $lname=htmlentities($_POST['lname'],ENT_QUOTES);
                $gen=$_POST['gen'];
                $email=$_POST['email'];
                $upass=htmlentities($_POST['upass'],ENT_QUOTES);
                $year_g=$_POST['yp'];
                $roll=$_POST['roll'];
                $course=$_POST['course'];
                $br=$_POST['branch'];
                $add=htmlentities($_POST['address'],ENT_QUOTES);
                $city=$_POST['city'];
                $state=$_POST['state'];
                $nat=$_POST['nation'];
                $pin=$_POST['pin'];
                $mob=$_POST['mob'];
                $year_j=$_POST['yj'];
                $dob=$_POST['bdate'];
                $p_app=$_POST['p_app'];
                $m_app=$_POST['m_app'];
                $qual=$_POST['qual'];
                $work=htmlentities($_POST['work'],ENT_QUOTES);
                $workdesc=htmlentities($_POST['workdesc'],ENT_QUOTES);
                $project=htmlentities($_POST['project'],ENT_QUOTES);
                $projectAr=htmlentities($_POST['projectAr'],ENT_QUOTES);
                $suggest=htmlentities($_POST['suggest'],ENT_QUOTES);
                $field=htmlentities($_POST['field'],ENT_QUOTES);                        
                                   
                $query="insert into alumnee values('$fname','$gen','$email','$uname','$upass',$year_g,$roll,'$course','$br','$add','$city','$state','$nat','$pin',$mob,'unapproved',$year_j,'$dob','$lname','$p_app','$m_app')";
                
                $result=mysqli_query($conn,$query);  
                if($mname!="")
                {
                    $query="insert into mid_names(al_mname,al_uname) values('$mname','$uname')";
                    $result=mysqli_query($conn,$query); 
                }
                if($qual!="")
                {
                    $query="insert into qualification(al_uname,qual) values('$uname','$qual')";
                    $result=mysqli_query($conn,$query);
                }
                if($work!="" && $workdesc!="")
                {
                    $query="insert into works_for(al_uname,org_name,org_desc) values('$uname','$work','$workdesc')";
                    $result=mysqli_query($conn,$query); 
                }
                if($project!="" && $projectAr!="")
                {
                    $query="insert into guided(al_uname,project_name,project_area) values('$uname','$project','$projectAr')";
                    $result=mysqli_query($conn,$query);
                }           
                
                
                /////imgCode//////////////////
                
                
                $target_dir = "uploads/";
                $target_file = $target_dir.$uname."_".basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $imageFileType . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                
                // Check if file already exists
                if (file_exists($target_file)) 
                {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) 
                {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
                {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) 
                {
                    echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } 
                else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                {
                     echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                     $query="insert into imgdb(al_uname,path) values('$uname','$target_file')";
                     $result=mysqli_query($conn,$query); 
                } 
                else 
                {
                    echo "Sorry, there was an error uploading your file.";
                }
    
                /////////////////////////////////////////////////////////////////////
                
                if($suggest!="")
                {
                    $query="insert into suggestions(message) values('$suggest')";
                    $result=mysqli_query($conn,$query); 
                }
                
                if($field!="")
                {
                    $query="insert into fields(al_uname,field_name) values('$uname','$field')";
                    $result=mysqli_query($conn,$query); 
                }
                echo '<script>window.location.href="login.php";</script>';
        }
        mysqli_close($conn);
        ?>        
    </body>
</html>

