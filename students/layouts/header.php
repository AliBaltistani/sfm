<style>
    .navbar-name{
        color: #fff;
    text-align: center;
    height: 75px;
    font-size: 22px;
    letter-spacing: 1px;
    font-weight: 900;
    padding-top: 25px;
    text-transform: uppercase;
    text-shadow: 2px 5px 08px green;
    }
</style>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Student Portal</a>
            </div>

            <center class="navbar-name">
            Sunrise public school Murkunja Shigar
            </center>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div text-center">
                            <img src="../img/admin-p.png" class="img" />
                            <h5 style="color:white;"><?php echo $_SESSION['rainbow_name'];?></h5>
                        </div>

                    </li>


                    <li>
                        <a class="<?php if($page=='dashboard'){ echo 'active-menu';}?>" href="index.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
					
					 <li>
                        <a class="<?php if($page=='profile'){ echo 'active-menu';}?>" href="profile.php"><i class="fa fa-users "></i>Profile</a>
                    </li>


                    <li>
                        <a class="<?php if($page=='grade'){ echo 'active-menu';}?>" href="grade.php"><i class="fa fa-th-large"></i> My Courses</a>
                    </li>
                    
					<li>
                        <a class="<?php if($page=='fees'){ echo 'active-menu';}?>" href="fees.php"><i class="fa fa-money "></i>Fees Section</a>
                    </li>
					 
					
					 
					
					<li>
                        <a class="<?php if($page=='setting'){ echo 'active-menu';}?>" href="setting.php"><i class="fa fa-cogs "></i>Account Setting</a>
                    </li>
					
					 <li>
                        <a href="logout.php"><i class="fa fa-power-off "></i>Logout</a>
                    </li>
					
			
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->