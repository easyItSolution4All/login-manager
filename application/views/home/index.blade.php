<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" data-ng-app="Login Manager">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Login Manager</title>
	{{ HTML::style('/css/main.css') }}
	{{ HTML::script('/js/angular.min.js') }}
	{{ HTML::script('/js/angular-resource.min.js') }}
	{{ HTML::script('/js/services.js') }}
	{{ HTML::script('/js/filters.js') }}
	{{ HTML::script('/js/app.js') }}
	{{ HTML::script('/js/directives.js') }}
	{{ HTML::script('/js/controllers/logins.js') }}
	{{ HTML::script('/js/controllers/clients.js') }}
	{{ HTML::script('/js/controllers/projects.js') }}
</head>
<body>
	<div class="wrapper of">
		<div class="header of">
			<h2 class="logo">18FEET<span><br />&nbsp;LOGIN MANAGER</span></h2>
			<div class="user">Logged in as <strong>Ninja Admin </strong>  <span class="v_line"> | </span> <a href="#"> Logout</a></div>
		</div>
		
		<!-- Navigation -->
		<div class="navigation of">
			<ul lm-menu></ul>
			
			<div id="searchform">
				<form method="get" action="">
				<input type="text" placeholder="What are you looking for?" class="search-box" name="search" />
				<input type="submit" class="button search-btn" value="SEARCH" />
				</form>
			</div>
		</div>
		
		<div class="page of">
			<div ng-view></div>
		</div>
		
		<!--<p class="footer"><a href="#">ADVANCED  SEARCH</a> <span class="v_line"> |</span> <a href="#">LOGOUT</a></p> -->
	</div>
</body>
</html>
