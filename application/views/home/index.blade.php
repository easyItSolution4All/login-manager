<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" data-ng-app="Login Manager">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Login Manager</title>
	{{ HTML::style('/css/main.css') }}
	{{ HTML::script('/js/angular.min.js') }}
	{{ HTML::script('/js/angular-resource.min.js') }}
	{{ HTML::script('/js/services.js') }}
	{{ HTML::script('/js/app.js') }}
	{{ HTML::script('/js/controllers/logins.js') }}
	{{ HTML::script('/js/controllers/clients.js') }}
</head>
<body>
	<div class="wrapper">
		<h2 class="logo">LOGIN MANAGER</h2>
		<p class="txt_right">Logged in as <strong>Ninja Admin </strong>  <span class="v_line"> | </span> <a href="#"> Logout</a></p>
		
		<!-- Navigation -->
		<div class="navigation">
			<ul>
				<li><a href="/">LOGINS</a></li>
				<li><a href="/projects">PROJECTS</a></li>
				<li><a href="/clients" class="active">CLIENTS</a></li>
			</ul>
			
			<div id="searchform">
				<form method="get" action="">
				<input type="text" placeholder="What are you looking for?" class="search-box" name="search" />
				<input type="submit" class="button search-btn" value="SEARCH" />
				</form>
			</div>
		</div>
		
		<div class="clear"></div>
		
		<div class="content">
			<div ng-view></div>
		</div>
		
		<p class="footer"><a href="#">ADVANCED  SEARCH</a> <span class="v_line"> |</span> <a href="#">LOGOUT</a></p>
	</div>
</body>
</html>
