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
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="form1">
        <table width="100%" cellspacing="0" bgcolor="antiqueWhite" cellpadding="10">
            <tr height="100">
                <td align="center"><input type="submit" name="cc" value="ADD COURSE AND BRANCH" class="btn"></td>
                <td align="center"><input type="submit" name="cb" value="ADD BRANCH" class="btn"></td>
                <td align="center"><input type="submit" name="cdep" value="ADD DEPARTMENT" class="btn"></td>
                <td align="center"><input type="submit" name="cdesg" value="ADD DESIGNATION" class="btn"></td>
            </tr>
        </table>
        </form>
        <br><br><br>
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
            <table align="center" cellpadding="20" style="border-style:double;border-width:10px;border-color:tan;background-color: wheat">
            <?php        
            if(isset($_POST['cc']))
            {
                ?>
                <tr><td>Course Name</td><td><input type="text" name="cname" required></td></tr>  
                <tr><td>Branch Name</td><td><input type="text" name="bname" required></td></tr>
                <tr><td colspan="2" align="center"><input type="submit" name="addCB" value="ADD" class="btn"></td></tr>
                <?php
            }
            else if(isset($_POST['cb']))
            {
                ?>
                <tr><td>Branch Name</td><td><input type="text" name="branchname"></td></tr>  
                <tr><td>Course Name</td>
                    <td><select name="pcourse">
                            <option>--SELECT PARENT COURSE--</option>
                        <?php
                        $query="select distinct course from coursemaster";
                        $result=mysqli_query($conn,$query);
                        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                        {   
                            echo "<option>".$row['course']."</option>";                            
                        }
                        ?>
                    </td>
                </tr>                
                <tr><td colspan="2" align="center"><input type="submit" name="addBranch" value="ADD" class="btn"></td></tr>
                <?php
            }
            else if(isset($_POST['cdep']))
            {
                ?>
                <tr><td>Department Name</td><td><input type="text" name="depname"></td></tr>                      
                <tr><td colspan="2" align="center"><input type="submit" name="addDep" value="ADD" class="btn"></td></tr>
                <?php
            }
            else if(isset($_POST['cdesg']))
            {
                ?>
                <tr><td>Post Name</td><td><input type="text" name="postname"></td></tr>                      
                <tr><td colspan="2" align="center"><input type="submit" name="addDesg" value="ADD" class="btn"></td></tr>
                <?php
            }            
            ?> 
            </table>
        </form>
        <?php
        if(isset($_POST['addCB']))
        {
            $cname=$_POST['cname'];
            $bname=$_POST['bname'];   
            $query="insert into coursemaster values ('$cname','$bname')";
            $result=mysqli_query($conn,$query);
        }
        else if(isset($_POST['addbranch']))
        {
            $cname=$_POST['pcourse'];
            $bname=$_POST['branchname']; 
            $query="insert into coursemaster values ('$cname','$bname')";
            $result=mysqli_query($conn,$query);
        }
        else if(isset($_POST['addDep']))
        {
            $dep=$_POST['depname'];
            $query="insert into dept_master values ('$dep')";
            $result=mysqli_query($conn,$query);         
        }
        else if(isset($_POST['addDesg']))
        {
            $pname=$_POST['postname'];
            $query="insert into designations values ('$pname')";
            $result=mysqli_query($conn,$query);
        }
        ?>
    </body>
</html>
