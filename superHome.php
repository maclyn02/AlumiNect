<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
    <?php
        if($_SESSION['who']=="superadmin")
        {            
        ?>  
        <table width="100%" height="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="2" bgcolor="tan" align="center">
                    <label style="color:white;font-size:45px;font-style:italic">AlumiNect - Control Panel</label><br><label style="color:white;font-size:20px;font-style:italic">Super Admin Zone</label>
                </td>
            </tr>
            <tr>
                <td width="80%" height="535">
                    <iframe src="approveRegistrations.php" name="work" width="100%" height="100%" scrolling="yes" style="border:solid;border-width:0px;padding:0px">
                    </iframe>
                </td>
                <td width="20%" height="535">
                    <table bgcolor="wheat" width="100%" height="100%" cellspacing="0">
                    <tr>
                        <td align="center">
                            <a href="search.php" target="work"><h4>Search</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="event.php" target="work"><h4>Events</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="approveRegistrations.php" target="work"><h4>Approve Alumni</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="approveAdmin.php" target="work"><h4>Approve Admins</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="discussions.php" target="work"><h4>Discussions</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="broadcast.php" target="work"><h4>Broadcast Letters</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="logs.php" target="work"><h4>View Logs</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="manage.php" target="work"><h4>Manage Users</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="editMasters.php" target="work"><h4>Master Records</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="superEdit.php" target="work"><h4>Change key</h4></a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="handover.php" target="work"><h4>Handover SuperAdmin rights</h4></a>
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
            header("location:mainScreen.php");
        }
        ?>
</body>
</html>
