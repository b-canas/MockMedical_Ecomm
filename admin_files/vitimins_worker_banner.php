<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="admin_files/admin_styles.css">
</head>

<body class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <!-- LINE FOR FUTURE LOGO <img src="images/ " width="125px"> -->
				<span id="text_logo"><h1>VitiMins</h1></span>
            </div>

            <nav class="banner">
                <ul id="MenuItems">
                    <li><a href="?action=show_products">Products</a></li>
                    <li><a href="?action=show_users">Users</a></li>
                    <li><a href="?action=view_user_orders">Orders</a></li>
                    <li><a href="">Account Management</a></li>
                    <li><a href="?action=log_off">Log Off</a></li>
                </ul>
            </nav>
            <img src="Images/menu.png" class="menu-icon" onclick="menutoggle()">
        </div>
    </div>



