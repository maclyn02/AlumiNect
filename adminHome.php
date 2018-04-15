<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Home</title>
</head>
<body>
    <?php
        if(!empty($_SESSION['uID']))
        {            
        ?>  
        <table width="100%" height="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="2" bgcolor="tan" align="center">
                    <label style="color:white;font-size:45px;font-style:italic">AlumiNect - Control Panel</label><br><label style="color:white;font-size:20px;font-style:italic">Admin Zone</label>
                </td>
            </tr>
            <tr>
                <td width="80%" height="535">
                    <iframe src="approveRegistrations.php" name="work" width="100%" height="100%" scrolling="yes" style="border:solid;border-width:0px;padding:0px">
                    </iframe>
                </td>
                <td width="20%" height="535">
                    <table bgcolor="wheat" width="100%" height="100%">
                    <tr>
                        <td align="center">
                            <a href="search.php" target="work"><h2>Search</h2></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="event.php" target="work"><h2>Events</h2></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="approveRegistrations.php" target="work"><h2>Approve Alumni</h2></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="discussions.php" target="work"><h2>Discussions</h2></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="broadcast.php" target="work"><h2>Broadcast Letters</h2></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="superLogin.php" target="work"><h4>Switch to Super Admin Mode</h4></a>
                        </td>
                    </tr>
                </table>
                </td>     
            </tr>
            <tr>
                <td colspan="2" bgcolor="tan" height="20%"><center><label style="font-size:20px">Logged in as <?php echo $_SESSION['username'];?><br><a href="mainScreen.php" target="_top">Logout?</a></label></center>
                </td>
            </tr>
        </table>
    <?php
    }
 else 
 {
   echo '<script> window.location.href="mainScreen.php"';   
 }
    ?>
        
</body>
</html>
