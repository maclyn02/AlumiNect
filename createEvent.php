<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Event Creation Page</title>
        <link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css">     
        <link rel="stylesheet" type="text/css" media="all" href="mystyle.css">  
        <script type="text/javascript" src="jsDatePick.min.1.3.js"></script>  
        <script type="text/javascript">
            window.onload = function()
            {
                    new JsDatePick({useMode:2,target:"dateField",dateFormat:"%Y-%m-%d"});
            };
        </script>
    </head>
    <body>
        <?php
        session_start();
        if(!empty($_SESSION['uID']))
        {
            $uname=$_SESSION['username'];
            $uid=$_SESSION['uID'];
        
        ?>  
        <h1><center>Create an Event</center></h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table align="center" style="border-style:double;border-width:10px;border-color:tan;background-color: wheat" cellpadding="20">
            <tr>
                <td>NAME</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>VENUE</td>
                <td><input type="text" name="ven" required></td>
            </tr>
            <tr>
                <td>DATE</td>
                <td><input type="date" id="dateField" name="date" placeholder="select date" readonly required></td>
            </tr>
            <tr>
                <td>TIME</td>
                <td><input type="text" name="time" required></td>
            </tr>
            <tr>
                <td>CREATED BY</td>
                <td><input type="text" name="uname" value="<?php echo $uname;?>" readonly></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="Submit" name="create" value="CREATE" class="btn"></td>
            </tr>
        </table>
        </form>
        <?php
       
        if(isset($_POST['create']))
        {
            include('dbConnect.php');
            
            if($_POST['name']!="" && $_POST['ven']!="" && $_POST['date']!="" && $_POST['time']!="")
            {
                $name=$_POST['name'];
                $venue=$_POST['ven'];
                $date=$_POST['date'];
                $time=$_POST['time'];               
                
                $query="insert into event(event_name,venue,edate,etime,manager) values('$name','$venue','$date','$time','$uid')";
                $result=mysqli_query($conn,$query);
                ?>
                <script>
                    alert("Event Created!");
                    window.location='event.php';
                </script>
                <?php
            }
        }
        }
        else
        {
            header("location:mainScreen.php");
        }
        ?>
    </body>
</html>

