<?php
/*Class for handling the template of the layout of the Views -->
<!-- Author: Steven Ng*/

class Layout
{	
	public function loadFixedNavBar($title, $dir)
    {
		$func = '<!DOCTYPE html>
		<html lang="en">
		  <head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">
			<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

			<title>' . $title . '</title>

			<!-- Bootstrap core CSS -->
			<link href="'. $dir .'bootstrap/css/bootstrap.css" rel="stylesheet">

			<!-- Custom styles for this template -->
			<link href="'. $dir .'bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">

			<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		  </head>

		  <body>

			<!-- Fixed navbar -->
			<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			  <div class="container">
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="index.php">Student Management System</a>
				</div>
				<div class="collapse navbar-collapse">
				  <ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Home</a></li>
				  </ul>
				</div><!--/.nav-collapse -->
			  </div>
			</div>
			';
			
		return $func;
	}
	
	public function loadFixedMainNavBar($type, $title, $dir)
    {
		if ($type == "Admin")
		{
			if ($title == "Admin Main")
			{
				$links = '
						  <li class="active"><a href="'. $dir .'admin/main.php">Home</a></li>
						  <li><a href="'. $dir .'emailPage.php">Email</a></li>
						  <li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Accounts <b class="caret"></b></a>
						  <ul class="dropdown-menu">
							<li><a href="'. $dir .'admin/register.php">Add</a></li>
							<li><a href="'. $dir .'admin/viewUser.php">View/Edit</a></li>
						  </ul>
						  </li>
						  <li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Classes <b class="caret"></b></a>
							  <ul class="dropdown-menu">
								<li><a href="'. $dir .'admin/classForm.php">Add</a></li>
								<li><a href="'. $dir .'admin/viewClasses.php">View/Edit</a></li>
							  </ul>
						  </li>';
			}
			else if ($title == "Email")
			{
				$links = '
						  <li><a href="'. $dir .'admin/main.php">Home</a></li>
						  <li class="active"><a href="'. $dir .'emailPage.php">Email</a></li>
						  <li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Accounts <b class="caret"></b></a>
						  <ul class="dropdown-menu">
							<li><a href="'. $dir .'admin/register.php">Add</a></li>
							<li><a href="'. $dir .'admin/viewUser.php">View/Edit</a></li>
						  </ul>
						  </li>
						  <li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Classes <b class="caret"></b></a>
							  <ul class="dropdown-menu">
								<li><a href="'. $dir .'admin/classForm.php">Add</a></li>
								<li><a href="'. $dir .'admin/viewClasses.php">View/Edit</a></li>
							  </ul>
						  </li>';
			}
			else
			{
				$links = '
						  <li><a href="'. $dir .'admin/main.php">Home</a></li>
						  <li><a href="'. $dir .'emailPage.php">Email</a></li>
						  <li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Accounts <b class="caret"></b></a>
						  <ul class="dropdown-menu">
							<li><a href="'. $dir .'admin/register.php">Add</a></li>
							<li><a href="'. $dir .'admin/viewUser.php">View/Edit</a></li>
						  </ul>
						  </li>
						  <li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Classes <b class="caret"></b></a>
							  <ul class="dropdown-menu">
								<li><a href="'. $dir .'admin/classForm.php">Add</a></li>
								<li><a href="'. $dir .'admin/viewClasses.php">View/Edit</a></li>
							  </ul>
						  </li>';
			}
		}
		else if ($type == "Teacher")
		{
			if ($title == "Teacher Main")
			{
				$links = '
						<li class="active"><a href="'. $dir .'teacher/main.php">Home</a></li>
						<li><a href="'. $dir .'emailPage.php">Email</a></li>
						<li><a href="'. $dir .'teacher/viewClasses.php">Manage Classes</a></li>';
			}
			else if ($title == "Email")
			{
				$links = '
						<li><a href="'. $dir .'teacher/main.php">Home</a></li>
						<li class="active"><a href="'. $dir .'emailPage.php">Email</a></li>
						<li><a href="'. $dir .'teacher/viewClasses.php">Manage Classes</a></li>';
			}
			else
			{
				$links = '
						<li><a href="'. $dir .'teacher/main.php">Home</a></li>
						<li><a href="'. $dir .'emailPage.php">Email</a></li>
						<li><a href="'. $dir .'teacher/viewClasses.php">Manage Classes</a></li>
						';
			}
		}
		else if ($type == "Student")
		{
			if ($title == 'Student Main')
			{
				$links = '
						<li class="active"><a href="'. $dir .'student/main.php">Home</a></li>
						<li><a href="'. $dir .'emailPage.php">Email</a></li>';
			}
			else if ($title == "Email")
			{
				$links = '
						<li><a href="'. $dir .'student/main.php">Home</a></li>
						<li class="active"><a href="'. $dir .'emailPage.php">Email</a></li>';
			}
			else
			{
				$links = '
						<li><a href="'. $dir .'student/main.php">Home</a></li>
						<li><a href="'. $dir .'emailPage.php">Email</a></li>';
			}
		}
		else if ($type == "Parent")
		{
			if ($title == 'Parent Main')
			{
				$links = '
						<li class="active"><a href="'. $dir .'parent/main.php">Home</a></li>
						<li><a href="'. $dir .'emailPage.php">Email</a></li>';
			}
			else if ($title == "Email")
			{
				$links = '
						<li><a href="'. $dir .'parent/main.php">Home</a></li>
						<li class="active"><a href="'. $dir .'emailPage.php">Email</a></li>';
			}
			else
			{
				$links = '
						<li><a href="'. $dir .'parent/main.php">Home</a></li>
						<li><a href="'. $dir .'emailPage.php">Email</a></li>';
			}
		}
		$func = '<!DOCTYPE html>
		<html lang="en">
		  <head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">
			<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

			<title>' . $title . '</title>

			<!-- Bootstrap core CSS -->
			<link href="'. $dir .'bootstrap/css/bootstrap.css" rel="stylesheet">

			<!-- Custom styles for this template -->
			<link href="'. $dir .'bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">

			<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!--[if lt IE 9]>
			  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		  </head>

		  <body>

			<!-- Fixed navbar -->
			<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			  <div class="container">
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="'. $dir .'index.php">Student Management System</a>
				</div>
				<div class="collapse navbar-collapse">
				  <ul class="nav navbar-nav">
					' . $links . '
				  </ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="'. $dir .'classes/logout.php">Logout</a></li>
				</ul>
				</div><!--/.nav-collapse -->
			  </div>
			</div>
			';
			
		return $func;
	}
	
	/*public function loadNarrowNav($title, $dir)
	{
		if ($title == "Home")
		{
		
			if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) 
			{
				$links = '<li class="active"><a href="index.php">Home</a></li>
					<li><a href="adopt.php">Adopt</a></li>
					<li><a href="email_newsletter_signup.php">Subscribe</a></li>
					<li><a href="login.php">Sign-In</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
			else
			{
				$links = '<li class="active"><a href="index.php">Home</a></li>
					<li><a href="adopt.php">Adopt</a></li>
					<li><a href="email_newsletter_signup.php">Subscribe</a></li>
					<li><a href="classes/logout.php">Sign-Out</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
		}
		else if ($title == "Login")
		{
			if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) 
			{
				$links = '<li><a href="index.php">Home</a></li>
					<li><a href="adopt.php">Adopt</a></li>
					<li><a href="email_newsletter_signup.php">Subscribe</a></li>
					<li class="active"><a href="login.php">Sign-In</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
			else
			{
				$links = '<li><a href="index.php">Home</a></li>
					<li><a href="adopt.php">Adopt</a></li>
					<li><a href="email_newsletter_signup.php">Subscribe</a></li>
					<li class="active"><a href="classes/logout.php">Sign-Out</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
			
		}
		else if ($title == "Adopt")
		{
			if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) 
			{
				$links = '<li><a href="index.php">Home</a></li>
					<li class="active"><a href="adopt.php">Adopt</a></li>
					<li><a href="email_newsletter_signup.php">Subscribe</a></li>
					<li><a href="login.php">Sign-In</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
			else
			{
				$links = '<li><a href="index.php">Home</a></li>
					<li class="active"><a href="adopt.php">Adopt</a></li>
					<li><a href="email_newsletter_signup.php">Subscribe</a></li>
					<li><a href="classes/logout.php">Sign-Out</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
			
		}
		else if ($title == "Newsletter")
		{
			if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) 
			{
				$links = '<li><a href="index.php">Home</a></li>
					<li><a href="adopt.php">Adopt</a></li>
					<li class="active"><a href="email_newsletter_signup.php">Subscribe</a></li>
					<li><a href="login.php">Sign-In</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
			else
			{
				$links = '<li><a href="index.php">Home</a></li>
					<li><a href="adopt.php">Adopt</a></li>
					<li><a href="email_newsletter_signup.php">Subscribe</a></li>
					<li class="active"><a href="classes/logout.php">Sign-Out</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
			
		}
		else
		{
			if(!isset($_SESSION['sess_user_id']) || (trim($_SESSION['sess_user_id']) == '')) 
			{
				$links = '<li><a href="index.php">Home</a></li>
					<li><a href="adopt.php">Adopt</a></li>
					<li><a href="email_newsletter_signup.php">Newsletter</a></li>
					<li><a href="login.php">Sign-In</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
			else
			{
				$links = '<li><a href="index.php">Home</a></li>
					<li><a href="adopt.php">Adopt</a></li>
					<li><a href="email_newsletter_signup.php">Newsletter</a></li>
					<li><a href="classes/logout.php">Sign-Out</a></li>
					<li class="active"><a href="#" data-container="body" data-toggle="popover" 
					data-placement="bottom" data-content="" data-original-title="" title="">
					<span class="badge"><span class="simpleCart_quantity"></span></span> Items - <span class="simpleCart_total"></span>&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span>
					</a></li>';
			}
			
		}
		$func = '
		<!DOCTYPE html>
			<html lang="en">
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<meta name="description" content="">
				<meta name="author" content="">
				<link rel="shortcut icon" href="'. $dir .'bootstrap/assets/ico/favicon.png">

				<title>'. $title .' &middot; Paws For A Cause</title>

				<!-- Bootstrap core CSS -->
				<link href="'. $dir .'bootstrap/dist/css/bootstrap.css" rel="stylesheet">

				<!-- Custom styles for this template -->
				<link href="'. $dir .'bootstrap/dist/css/jumbotron-narrow.css" rel="stylesheet">
				<link href="'. $dir .'bootstrap/dist/css/background.css" rel="stylesheet">
		
		<body>

		<div class="container">
			<div class="header">
				<ul class="nav nav-pills pull-right">
				'. $links .'
				</ul>
				<h3 class="text-muted"><a href="index.php"><img src="images/logo.png" alt="Paws For A Cause" width="150" height="40"></a></h3>
			</div>';
			
			return $func;
	}*/
	
	public function loadFooter($dir)
    {
		$func = '
			<div class="navbar navbar-default navbar-fixed-bottom">
			  <div class="container">
				<p class="text-muted">&copy 2014 Steven Ng, Andre Vicente, Brian Kennedy, Syed Kamil.</p>
			  </div>
			</div>


			<!-- Bootstrap core JavaScript
			================================================== -->
			<!-- Placed at the end of the document so the pages load faster -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script src="'. $dir .'bootstrap/js/bootstrap.js"></script>
		  </body>';
		
		return $func;
	}
	
	public function loadUserRow(User $user, $modalNum)
	{
		if ($user->getRole() != 3)
		{
			$edit = '<button type="button" class="btn btn-info" onclick="location.href=\'editGuardian.php?accountid=' . $user->getUserID() . '&role=' . $user->getRole() . '\';">Edit</button>';
			$view = '
					<!-- Button trigger modal -->
					<button class="btn btn-primary " data-toggle="modal" data-target="#myModal' . $modalNum . '">
					 View
					</button>

					<!-- Modal -->
					<div class="modal fade" id="myModal' . $modalNum . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h2 class="modal-title" id="myModalLabel" align="center">' . $user->getFirstName(). ' ' . $user->getLastName() . '\'s Profile</h2>
						  </div>
						  <div class="modal-body">
							<div class="table-responsive">
								<table class="table table-condensed">
									<thead>
										<tr>
											<th style="text-align: center;" colspan="6">
												<h3>Account Information</h3>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>ID</td>
											<td>
												' . $user->getUserID() . '
											</td>
										</tr>
										<tr>
											<td>Username</td>
											<td>
												' . $user->getUserName() . '
											</td>
										</tr>
										<tr>
											<td>Account Type</td>
											<td>
												' . $user->getRoleFormatted() . '
											</td>
										</tr>
										<tr>
											<td>Active</td>
											<td>
												' . $user->getStatusFormatted() . '
											</td>
										</tr>
										<tr>
											<td>Child\'s ID</td>
											<td>
												' . $user->getChildIDFormatted() . '
											</td>
										</tr>
									</tbody>
									<thead>
										<tr>
											<th style="text-align: center;" colspan="6">
												<h3>Personal Information</h3>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>First Name</td>
											<td>
												' . $user->getFirstName() . '
											</td>
										</tr>
										<tr>
											<td>Last Name</td>
											<td>
												' . $user->getLastName() . '
											</td>
										</tr>
										<tr>
											<td>Birthdate</td>
											<td>
												' . $user->getDOBFormatted() . '
											</td>
										</tr>
										<tr>
											<td>Contact Number</td>
											<td>
												' . $user->getContact() . '
											</td>
										</tr>
										<tr>
											<td>Email</td>
											<td>
												' . $user->getEmail() . '
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							' . $edit . '
						  </div>
						</div>
					  </div>
					</div>		
					';
		}
		else
		{
			$edit = '<button type="button" class="btn btn-info" onclick="location.href=\'editStudent.php?accountid=' . $user->getUserID() . '&role=' . $user->getRole() . '\';">Edit</button>';
			$view = '
					<!-- Button trigger modal -->
					<button class="btn btn-primary " data-toggle="modal" data-target="#myModal' . $modalNum . '">
					 View
					</button>

					<!-- Modal -->
					<div class="modal fade" id="myModal' . $modalNum . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h2 class="modal-title" id="myModalLabel" align="center">' . $user->getFirstName() . ' ' . $user->getLastName() . '\'s Profile</h2>
						  </div>
						  <div class="modal-body">
							<div class="table-responsive">
								<table class="table table-condensed">
									<thead>
										<tr>
											<th style="text-align: center;" colspan="6">
												<h3>Account Information</h3>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>ID</td>
											<td>
												' . $user->getUserID() . '
											</td>
										</tr>
										<tr>
											<td>Username</td>
											<td>
												' . $user->getUserName() . '
											</td>
										</tr>
										<tr>
											<td>Account Type</td>
											<td>
												' . $user->getRoleFormatted() . '
											</td>
										</tr>
										<tr>
											<td>Active</td>
											<td>
												' . $user->getStatusFormatted() . '
											</td>
										</tr>
									</tbody>
									<thead>
										<tr>
											<th style="text-align: center;" colspan="6">
												<h3>Personal Information</h3>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Student ID</td>
											<td>
												' . $user->getStudentID() . '
											</td>
										</tr>
										<tr>
											<td>Account Balance</td>
											<td>
												' . $user->getBalanceFormatted() . '
											</td>
										</tr>
										<tr>
											<td>First Name</td>
											<td>
												' . $user->getFirstName() . '
											</td>
										</tr>
										<tr>
											<td>Last Name</td>
											<td>
												' . $user->getLastName() . '
											</td>
										</tr>
										<tr>
											<td>Birthdate</td>
											<td>
												' . $user->getDOBFormatted() . '
											</td>
										</tr>
										<tr>
											<td>Contact Number</td>
											<td>
												' . $user->getContact() . '
											</td>
										</tr>
										<tr>
											<td>Email</td>
											<td>
												' . $user->getEmail() . '
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							' . $edit . '
						  </div>
						</div>
					  </div>
					</div>	
					';
		}
		
		$func = '
			<tr class="searchable">
				<td style="text-align: center;">
					' . $user->getUserID() . '
				</td>
				<td style="text-align: center;">
					' . $user->getUserName() . '
				</td>
				<td style="text-align: center;">
					' . $user->getFirstName() . '
				</td>
				<td style="text-align: center;">
					' . $user->getLastName() . '
				</td>
				<td style="text-align: center;">
					' . $user->getRoleFormatted() . '
				</td>
				<td style="text-align: center;">
					' . $user->getStatusFormatted() . '
				</td>
				<td style="text-align: center;">
					' . $view . '
				</td>
			</tr>
		';
		
		return $func;
	}
	
	public function loadClassRow(Classroom $class, $modalNum, $role)
	{
		if ($role == 1)
		{
			$edit = '<button type="button" class="btn btn-info" onclick="location.href=\'../admin/editClass.php?classid=' . $class->getClassID() . '\';">Edit</button>';
			$checkbox = '<td style="text-align: center;">
						<input name="status" id="status' . $modalNum . '" type="checkbox" value="' . $class->getClassID() . '">
						</td>';
		}
		else
		{
			$edit = '<button type="button" class="btn btn-info" disabled="disabled">Edit</button>';
			$checkbox = '';
		}
		$view = '
				<!-- Button trigger modal -->
				<button class="btn btn-primary " data-toggle="modal" data-target="#myModal' . $modalNum . '">
				 View
				</button>

				<!-- Modal -->
				<div class="modal fade" id="myModal' . $modalNum . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title" id="myModalLabel" align="center">' . $class->getCourseNumber(). ' ' . $class->getCourseName() . '</h3>
					  </div>
					  <div class="modal-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<th style="text-align: center;" colspan="6">
											<h3>Class Info</h3>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>ID</td>
										<td>
											' . $class->getClassID() . '
										</td>
									</tr>
									<tr>
										<td>Course Number</td>
										<td>
											' . $class->getCourseNumber() . '
										</td>
									</tr>
									<tr>
										<td>Course Name</td>
										<td>
											' . $class->getCourseName() . '
										</td>
									</tr>
									<tr>
										<td>Teacher</td>
										<td>
											' . $class->getTeacherUser() . ' &lt' . $class->getTeacherFirst() . ' ' . $class->getTeacherLast() . '&gt' . '
										</td>
									</tr>
									<tr>
										<td>Semester</td>
										<td>
											' . $class->getSemester() . '
										</td>
									</tr>
									<tr>
										<td>School Year</td>
										<td>
											' . $class->getSchoolYear() . '
										</td>
									</tr>
									<tr>
										<td>Start Date</td>
										<td>
											' . $class->getStartDateFormatted() . '
										</td>
									</tr>
									<tr>
										<td>End Date</td>
										<td>
											' . $class->getEndDateFormatted() . '
										</td>
									</tr>
									<tr>
										<td>Start Time</td>
										<td>
											' . $class->getStartTimeFormatted() . '
										</td>
									</tr>
									<tr>
										<td>End Time</td>
										<td>
											' . $class->getEndTimeFormatted() . '
										</td>
									</tr>
									<tr>
										<td>Status</td>
										<td>
											' . $class->getStatusFormatted() . '
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						' . $edit . '
					  </div>
					</div>
				  </div>
				</div>		
				';
		
		$page = '<button class="btn btn-info" onclick="location.href=\'../classPage.php?classid=' . $class->getClassID() . '\';">Class</button>';
		
		$func = '
			<tr class="searchable">
				' . $checkbox . '
				<td style="text-align: center;">
					' . $class->getCourseNumber() . '
				</td>
				<td style="text-align: center;">
					' . $class->getCourseName() . '
				</td>
				<td style="text-align: center;">
					' . $class->getTeacherFirst() . ' ' . $class->getTeacherLast() . '
				</td>
				<td style="text-align: center;">
					' . $class->getSemester() . '
				</td>
				<td style="text-align: center;">
					' . $class->getSchoolYear() . '
				</td>
				<td style="text-align: center;">
					' . $class->getStatusFormatted() . '
				</td>
				<td style="text-align: center;">
					' . $view . '
				</td>
				<td style="text-align: center;">
					' . $page . '
				</td>
			</tr>
		';
		
		return $func;
	}
	
	public function loadInbox(Email $mail, $modalNum, $box)
	{	
		//$delete = '<button class="btn btn-danger">Delete</button>';
		$msg =  '
					<button class="btn btn-link " data-toggle="modal" data-target="#myModal' . $modalNum . '">
						' . $mail->getSubjectFormatted() . '
					</button>

					<div class="modal fade" id="myModal' . $modalNum . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title" id="myModalLabel" align="center">From: ' . $mail->getFromUser() . ' &lt;' . $mail->getFromFirst() . ' ' . $mail->getFromLast() . '&gt;' . '</h3>
							<h3 class="modal-title" id="myModalLabel" align="center">To: ' . $mail->getDestUser() . ' &lt;' . $mail->getDestFirst() . ' ' . $mail->getDestLast() . '&gt;' . '</h3>
						  </div>
						  <div class="modal-body">
							<pre>' . $mail->getMessage() . '</pre>
						  </div>
						  <div class="modal-footer">
							<button class="btn btn-danger pull-left" onclick="deleteReadEmail(\'' . $box . '\', ' . $mail->getID() . ')">Delete</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" id="reply" class="btn btn-success" data-dismiss="modal" onclick="forward(\'' . $box . '\', ' . $mail->getID() . ')">Forward</button>
							<button type="button" id="reply" class="btn btn-primary" data-dismiss="modal" onclick="reply(\'' . $box . '\', ' . $mail->getID() . ')">Reply</button>
						  </div>
						</div>
					  </div>
					</div>
				';
		$func = '
			<tr class="searchable">
				<td style="text-align: center;">
					<input name="delete" id="delete' . $modalNum . '" type="checkbox" value="' . $mail->getID() . '">
				</td>
				<td style="text-align: center;">
					' . $mail->getFromUser() . ' <' . $mail->getFromFirst() . ' ' . $mail->getFromLast() . '>' . '
				</td>
				<td>
					<p>' . $msg . '</p>
				</td>
				<td>
					' . $mail->getDateFormatted() . '
				</td>
			</tr>
		';
		
		return $func;
	}
	
	public function loadDraft(Email $mail, $modalNum, $box)
	{	
		$func = '
			<tr class="searchable">
				<td style="text-align: center;">
					<input name="delete" id="delete' . $modalNum . '" type="checkbox" value="' . $mail->getID() . '">
				</td>
				<td style="text-align: center;">
					' . $mail->getFromUser() . ' <' . $mail->getFromFirst() . ' ' . $mail->getFromLast() . '>' . '
				</td>
				<td>
					<button id="loadSavedMail" class="btn btn-link" onclick="loadSavedMail(\'' . $box . '\', ' . $mail->getID() . ')">' . $mail->getSubjectFormatted() . '</button>
				</td>
				<td>
					' . $mail->getDateFormatted() . '
				</td>
			</tr>
		';
		
		return $func;
	}
	
	public function loadRosterRow($id, $user, $first, $last, $status, $grade, $class, $modalNum)
	{	
		if ($status)
		{
			$status = "True";
			$change = '<button type="button" class="btn btn-danger" onclick="location.href=\'teacher/editDeleteGrade.php?id=' . $id . '&class=' . $class . '\';">Edit/Delete</button>';
			$change2 = '<button type="button" class="btn btn-danger pull-left" onclick="location.href=\'teacher/editDeleteGrade.php?id=' . $id . '&class=' . $class . '\';">Edit/Delete</button>';
			$add = '<button type="button" class="btn btn-primary" onclick="location.href=\'teacher/addGrade.php?id=' . $id . '&class=' . $class . '\';">Add</button>';
		}
		else
		{
			$status = "False";
			$change = '<button type="button" class="btn btn-danger" disabled="disabled" onclick="location.href=\'teacher/editDeleteGrade.php?id=' . $id . '&class=' . $class . '\';">Edit/Delete</button>';
			$change2 = '<button type="button" class="btn btn-danger pull-left" disabled="disabled" onclick="location.href=\'teacher/editDeleteGrade.php?id=' . $id . '&class=' . $class . '\';">Edit/Delete</button>';
			$add = '<button type="button" class="btn btn-primary" disabled="disabled" onclick="location.href=\'teacher/addGrade.php?id=' . $id . '&class=' . $class . '\';">Add</button>';
		}
		$gradeRow = '';
		if (!count($grade))
		{
			$gradeRow = "<tr>
							<td colspan='2' style='text-align: center;'>No grades available</td>
						</tr> ";
		}
		else
		{
			for ($j = 0; $j < count($grade); $j++)
			{
				$gradeRow = $gradeRow . "<tr>
											<td>" . $grade[$j]['label'] . "</td>
											<td>" . $grade[$j]['grade'] . "</td>
										</tr> ";
			}
		}
		$grade =  '
					<button class="btn btn-info" data-toggle="modal" data-target="#myModal' . $modalNum . '">
						View
					</button>

					<div class="modal fade" id="myModal' . $modalNum . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title" id="myModalLabel" align="center">' . $user . ' &lt;' . $first . ' ' . $last . '&gt;' . ' Grade</h3>
						  </div>
						  <div class="modal-body">
							<div class="table-responsive">
								<table class="table table-condensed">
									<th>Grade Label</th>
									<th>Grade</th>
									<tbody> 
										' . $gradeRow . '
									</tbody>
								</table>
							</div>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							' . $add . '
							' . $change2 . '
						  </div>
						</div>
					  </div>
					</div>
				';
	
		$func = '
			<tr class="searchable">
				<td style="text-align: center;">
					<input name="delete" id="delete' . $modalNum . '" type="checkbox" value="' . $id . '">
				</td>
				<td style="text-align: center;">
					' . $id . '
				</td>
				<td style="text-align: center;">
					' . $user . '
				</td>
				<td style="text-align: center;">
					' . $first . '
				</td>
				<td style="text-align: center;">
					' . $last . '
				</td>
				<td style="text-align: center;">
					' . $status . '
				</td>
				<td style="text-align: center;">
					' . $add . '
				</td>
				<td style="text-align: center;">
					' .  $change . '
				</td>
				<td style="text-align: center;">
					' . $grade . '
				</td>
			</tr>
		';
		
		return $func;
	}
	
	public function loadRosterStudentRow($user, $first, $last)
	{	
		$func = '
			<tr class="searchable">
				<td style="text-align: center;">
					' . $user . '
				</td>
				<td style="text-align: center;">
					' . $first . '
				</td>
				<td style="text-align: center;">
					' . $last . '
				</td>
			</tr>
			';
			
		return $func;
	}
	
	public function loadGradeRow($id, $user, $first, $last, $grade)
	{
		$name = $first . ' ' . $last;
		$gradeRow = '';
		for ($j = 0; $j < count($grade); $j++)
		{
			$gradeRow = $gradeRow . "<tr class='searchable'>
										<td style='text-align: center;'>" . $id . "</td>
										<td style='text-align: center;'>" . $user . "</td>
										<td style='text-align: center;'>" . $name . "</td>
										<td style='text-align: center;'>" . $grade[$j]['label'] . "</td>
										<td style='text-align: center;'>" . $grade[$j]['grade'] . "</td>
									</tr> ";
		}
		return $gradeRow;
	}
	
	public function loadTopicRow($topic, $num, $role)
	{
		if ($role == 3)
		{
			$checkbox = '';
		}
		else
		{
			$checkbox = '
				<td style="text-align: center;">
					<input name="delete" id="remove' . $num . '" type="checkbox" value="' . $topic->getTopicID() . '">
				</td>
				';
		}
		$func = '
			<tr class="searchable">
				' . $checkbox . '
				<td style="width: 60%;">
					<button class="btn btn-link" onclick="loadClassPages(\'#forum\', \'classes/topicPage.php?topicid=\', ' . $topic->getTopicID() . ')">' . $topic->getTopicSubjectFormatted() . '</button>
				</td>
				<td style="text-align: center;">
					' . $topic->getAuthorUser() . ' &lt;' . $topic->getAuthorFirst() . ' ' . $topic->getAuthorLast() . '&gt;' . '
				</td>
				<td style="text-align: center;">
					' . $topic->getNumMsgs() . '
				</td>
				<td style="text-align: center;">
					' . $topic->getLastPostDate() . '
				</td>
			</tr>
		';
		
		return $func;
	}
	
	public function loadDiscussionRow($topic, $user, $role)
	{
		$edit = '';
		switch ($topic->getAuthorRole())
		{
			case 1: $panel = 'panel-danger';
					break;
			case 2: $panel = 'panel-success';
					break;
			case 3: $panel = 'panel-primary';
					break;
			default: $panel = 'panel-default';
					break;
		}
		switch ($role)
		{
			case 1: $edit = '<button class="btn btn-info btn-info pull-right" onclick="editOPMessage(' . $topic->getTopicID() . ')">Edit</button>';
					break;
			case 2: $edit = '<button class="btn btn-info btn-info pull-right" onclick="editOPMessage(' . $topic->getTopicID() . ')">Edit</button>';
					break;
			case 3: if ($user == $topic->getAuthorUser())
					{
						$edit = '<button class="btn btn-info btn-info pull-right" onclick="editOPMessage(' . $topic->getTopicID() . ')">Edit</button>';
					}
					break;
		}
		$func = '
			<tr class="searchable">
				<td style="text-align: left; width: 90%;">
					<div class="panel ' . $panel . '">
					  <div class="panel-heading">
						' . $topic->getAuthorUser() . ' &lt;' . $topic->getAuthorFirst() . ' ' . $topic->getAuthorLast() . '&gt;' . '
					  </div>
					  <div class="panel-body">
						<pre>' . $topic->getTopicMessage() . '</pre>
						<button class="btn btn-primary pull-right" onclick="quoteOP(' . $topic->getTopicID() . ')">Quote</button>
						' . $edit. '
					  </div>
					</div>
				</td>
				<td style="text-align: center;">
					' . $topic->getPostDate() . '
				</td>
			</tr>
		';
		
		return $func;
	}
	
	public function loadDiscussionResponseRow($reply, $user, $role)
	{
		$edit = '';
		switch ($reply->getAuthorRole())
		{
			case 1: $panel = 'panel-danger';
					break;
			case 2: $panel = 'panel-success';
					break;
			case 3: $panel = 'panel-primary';
					break;
			default: $panel = 'panel-default';
					break;
		}
		switch ($role)
		{
			case 1: $edit = '<button class="btn btn-info btn-info pull-right" onclick="editMessage(' . $reply->getResponseID() . ')">Edit</button>';
					$delete = '<button class="btn btn-danger" onclick="deleteMessage(' . $reply->getResponseID() . ')">Delete</button>';
					break;
			case 2: $edit = '<button class="btn btn-info btn-info pull-right" onclick="editMessage(' . $reply->getResponseID() . ')">Edit</button>';
					$delete = '<button class="btn btn-danger" onclick="deleteMessage(' . $reply->getResponseID() . ')">Delete</button>';
					break;
			case 3: if ($user == $reply->getAuthorUser())
					{
						$edit = '<button class="btn btn-info btn-info pull-right" onclick="editMessage(' . $reply->getResponseID() . ')">Edit</button>';
					}
					$delete = '';
					break;
		}
		$func = '
			<tr class="searchable">
				<td style="text-align: left; width: 90%;">
					<div class="panel ' . $panel . '">
					  <div class="panel-heading">
						' . $reply->getAuthorUser() . ' &lt;' . $reply->getAuthorFirst() . ' ' . $reply->getAuthorLast() . '&gt;' . '
					  </div>
					  <div class="panel-body">
						<pre>' . $reply->getResponseMessage() . '</pre>
						<button class="btn btn-primary pull-right" onclick="quoteResponse(' . $reply->getResponseID() . ')">Quote</button>
						' . $edit. '
						' . $delete. '
					  </div>
					</div>
				</td>
				<td style="text-align: center;">
					' . $reply->getPostDate() . '
				</td>
			</tr>
		';
		
		return $func;
	}

	public function loadMessages(Message $mssg, $modalNum, $role)
	{	
		
		//function ' . dltMsg . ' ' . $modalNum . ' ' . () . '
					//{
					//	$database->exec("DELETE FROM messageboard WHERE messageID = ' . $mssg->getID() . '");
					//}
					
		//$delete = '<button class="btn btn-danger">Delete</button>';
		$edt =  '
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bModal' . $modalNum . '">Edit</button>		

					<div class="modal fade" id="bModal' . $modalNum . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title" id="myModalLabel" align="center">Edit Message</h3>
						  </div>
						  <div class="modal-body">
							<pre><textarea id="edtMessage' . $modalNum . '" name="edtMessage' . $modalNum . '" class="messageBoard">' . $mssg->getMessage() . '</textarea></pre>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal" data-target="edtMessage' . $modalNum . '" onclick="editMsg(' . $mssg->getID() . ', ' . $modalNum . ')" >Submit</button>				
						  </div>
						</div>
					  </div>
					</div>
				';
				
		$dlt = '
					<button type="button" class="btn btn-danger" onclick="deleteMsg(' . $mssg->getID() . ')">
						Delete
					</button>					
			';

		
		if ($role=='1')
		{	
			$func = '
				<tr class="searchable">
					<td>
						' . $dlt . '
					</td>
					<td>
						' . $edt . '
					</td>
					<td style="width: 85%;">
						<pre>' . $mssg->getMessage() . '</pre>
					
					</td>
					<td>
						' . $mssg->getAuthorFirst() . ' ' . $mssg->getAuthorLast() . '
					</td>
					<td>
						' . $mssg->getDateFormatted() . '
					</td>
				</tr>
			';
		}
		else
		{	
			$func = '
				<tr class="searchable">
					<td></td><td></td>
					<td style="width: 85%;">
						<pre>' . $mssg->getMessage() . '</pre>
					
					</td>
					<td>
						' . $mssg->getAuthorFirst() . ' ' . $mssg->getAuthorLast() . '
					</td>
					<td>
						' . $mssg->getDateFormatted() . '
					</td>
				</tr>
			';
		}
		return $func;
	}




	public function loadClassMessages(ClassMessage $mssg, $clssID, $modalNum, $role)
	{	
		

		$edt =  '
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cModal' . $modalNum . '">Edit</button>		

				<div class="modal fade" id="cModal' . $modalNum . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title" id="myModalLabel" align="center">Edit Message</h3>
					  </div>
					  <div class="modal-body">
						<pre><textarea id="edtMessage' . $modalNum . '" name="edtMessage' . $modalNum . '" class="messageBoard">' . $mssg->getMessage() . '</textarea></pre>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" data-target="edtMessage' . $modalNum . '" onclick="editClassMsg(' . $mssg->getID() . ', ' . $modalNum . ')">Submit</button>	
					  </div>
					</div>
				  </div>
				</div>
			';
				
		$dlt = '
					<button type="button" class="btn btn-danger" onclick="deleteClassMsg(' . $mssg->getID() . ')">
						Delete
					</button>					
			';

		
		if ($role=='1' || $role=='2')
		{	
			$func = '
				<tr class="searchable">
					<td>
						' . $dlt . '
					</td>
					<td>
						' . $edt . '
					</td>
					<td style="width: 85%;">
						<pre>' . $mssg->getMessage() . '</pre>
					
					</td>
					<td>
						' . $mssg->getAuthorFirst() . ' ' . $mssg->getAuthorLast() . '
					</td>
					<td>
						' . $mssg->getDateFormatted() . '
					</td>
				</tr>
			';
		}
		else
		{	
			$func = '
				<tr class="searchable">
					<td></td><td></td>
					<td style="width: 85%;">
						<pre>' . $mssg->getMessage() . '</pre>
					
					</td>
					<td>
						' . $mssg->getAuthorFirst() . ' ' . $mssg->getAuthorLast() . '
					</td>
					<td>
						' . $mssg->getDateFormatted() . '
					</td>
				</tr>
			';
		}
		return $func;
	}




	

	public function loadStudentLunchRow(User $user)
	{
		if ($user->getStatus())
		{
			$add = '<button class="btn btn-primary" onclick="location.href=\'../addMoneyPage.php?id=' . $user->getStudentID() . '\';">Add to Balance</button>';
		}
		else
		{
			$add = '<button class="btn btn-primary" disabled="disabled" onclick="location.href=\'../addMoneyPage.php?id=' . $user->getStudentID() . '\';">Add to Balance</button>';
		}
		$grade = '<button class="btn btn-info" onclick="location.href=\'../student/studentAllGrades.php?id=' . $user->getStudentID() . '\';">View Grades</button>';
		$func = '
			<tr class="searchable">
				<td style="text-align: center;">
					' . $user->getStudentID() . '
				</td>
				<td style="text-align: center;">
					' . $user->getFirstName() . '
				</td>
				<td style="text-align: center;">
					' . $user->getLastName() . '
				</td>
				<td style="text-align: center;">
					' . $user->getStatusFormatted() . '
				</td>
				<td style="text-align: center;">
					' . $user->getBalanceFormatted() . '
				</td>
				<td style="text-align: center;">
					' . $add . '
				</td>
				<td style="text-align: center;">
					' . $grade . '
				</td>
			</tr>
		';
		
		return $func;
	}







}
?>