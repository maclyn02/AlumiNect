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
        <title>Admin Registration Page</title>
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css"> 
        <script type="text/javascript">
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
                if(document.adRegF.uname.value=="")
                {
                    document.getElementById("iuname").innerHTML="Enter username";
                    document.adRegF.uname.focus();
                    return false;
                }
                else
                {
                     document.getElementById("iuname").innerHTML="";
                }
                if(document.adRegF.upass.value=="")
                {
                    document.getElementById("ipass").innerHTML="Provide password";
                    document.adRegF.upass.focus();
                    return false;
                }
                else
                {
                     document.getElementById("ipass").innerHTML="";
                } 
                if(document.adRegF.upass.value!=document.adRegF.cupass.value)
                {
                    document.getElementById("ipass").innerHTML="Re-type password";
                    document.adRegF.upass.value="";
                    document.adRegF.upass.focus();
                    document.adRegF.cupass.value="";
                    return false;
                }
                else
                {
                     document.getElementById("ipass").innerHTML="";
                } 
                if(document.adRegF.name.value=="")
                {
                    document.getElementById("iname").innerHTML="Enter your name";
                    document.adRegF.name.focus();
                    return false;
                }
                else
                {
                     document.getElementById("iname").innerHTML="";
                }
                if(document.adRegF.des.value=="")
                {
                    document.getElementById("ides").innerHTML="Enter Designation";
                    document.adRegF.des.focus();
                    return false;
                }
                else
                {
                     document.getElementById("ides").innerHTML="";
                }
                if(document.adRegF.dept.value=="")
                {
                    document.getElementById("idep").innerHTML="Enter Department name";
                    document.adRegF.des.focus();
                    return false;
                }
                else
                {
                     document.getElementById("idep").innerHTML="";
                }
                if(document.adRegF.email.value=="")
                {
                    document.getElementById("iemail").innerHTML="Enter Email Id";
                    document.adRegF.email.focus();
                    return false;
                }
                else
                {
                     document.getElementById("iemail").innerHTML="";
                }
                if(document.adRegF.contact.value=="")
                {
                    document.getElementById("icon").innerHTML="Enter Contact number";
                    document.adRegF.contact.focus();
                    return false;
                }
                else
                {
                     document.getElementById("icon").innerHTML="";
                }
            }
        </script>
    </head>
    <body bgcolor="tan">
    <center><h3>Register as Admin</h3></center>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="adRegF">
        <table align="center" bgcolor="wheat" style="border-style:double;border-width:10px;border-color:tan" cellpadding="10">
            <tr>
                <td>USERNAME</td>
                <td><input type="text" name="uname"></td>
                <td><input type="Submit" name="check" value="CHECK" class="btn"></td>
                <td><p id="iuname" style="color:red"></p></td>
            </tr>
            <tr><td>PASSWORD</td><td><input type="password" name="upass"></td><td><p id="ipass" style="color:red"></p></td>
            </tr>
            <tr><td>CONFIRM PASSWORD</td><td><input type="password" name="cupass"></td></tr>
            <tr>
                <td>NAME</td>
                <td><input type="text" name="fname" placeholder="First Name"></td>
                <td><input type="text" name="mname" placeholder="Middle Name(optional)"></td>
                <td><input type="text" name="lname" placeholder="Last Name"></td>
                <td width="200"><p id="iname" style="color:red"></p></td>
            </tr>
            <tr><td>DESIGNATION</td><td><input type="text" name="des"></td><td><p id="ides" style="color:red"></p></td></tr>
            <tr><td>DEPARTMENT</td><td><input type="text" name="dept"></td><td><p id="idep" style="color:red"></p></td></tr>
            <tr><td>EMAIL</td><td><input type="text" name="email"></td><td><p id="iemail" style="color:red"></p></td></tr>
            <tr><td>CONTACT</td><td><input type="text" name="contact" maxlength="10" onkeypress="return IsNumeric(event,'icon');" ondrop="return false;" onpaste="return false;"></td><td><p id="icon" style="color:red"></p></td></tr>            
            <tr><td></td><td><input type="Submit" name="register" value="REGISTER" onclick="return validateForm()" class="btn"></td><td colspan="2">All details are mandatory</td></tr>
        </table>
        </form>
        <?php
        if(isset($_POST['check']))
        {
            $uchk=$_POST['uname'];
            $query="select logid from admin where (logid='$uchk')";
            
            $result=mysqli_query($conn,$query);
            if($row=mysqli_fetch_array($result,MYSQLI_NUM))
            {                      
                echo "document.getElementById('iuname').innerHTML='Username already in use!';document.adRegF.uname.focus();</script>";    
            }                      
            else
            {
                echo "<script>document.getElementById('iuname').innerHTML='Username valid';document.adRegF.uname.value=".$_POST['uname'].";document.adRegF.upass.focus();</script>";
            }
            mysqli_close($conn);
        }     
        if(isset($_POST['register']))
        {           
            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
            {
                $fname=htmlentities($_POST['fname'],ENT_QUOTES);
                $mname=htmlentities($_POST['mname'],ENT_QUOTES);
                $lname=htmlentities($_POST['lname'],ENT_QUOTES);
                $desg=$_POST['des'];
                $dept=$_POST['dept'];
                $email=$_POST['email'];
                $uname=htmlentities($_POST['uname'],ENT_QUOTES);
                $upass=htmlentities($_POST['upass'],ENT_QUOTES);   
                $contact=$_POST['contact'];
                
                $query="insert into admin values('$fname','$desg','$dept','$email','$uname','$upass','unapproved',$contact,'$lname')";
                $result=mysqli_query($conn,$query);
                $query="insert into ad_mid_names values('$uname','$mname')";
                $result=mysqli_query($conn,$query);
            }
            mysqli_close($conn);
        }
        ?>
    </body>
</html>

