<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" data-ng-app="Login Manager">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Login Manager</title>
	{{ Asset::scripts(); }}
	{{ Asset::styles(); }}
</head>
<body>
	<div class="wrapper of">
		<div class="header of">
			<h2 class="logo">18FEET<span><br />&nbsp;LOGIN MANAGER</span></h2>
			<div class="user">Logged in as <strong>Ninja Admin </strong>  <span class="v_line"> | </span> <a href="#"> Logout</a></div>
		</div>
		
		<!-- Navigation -->
		<div class="navigation of rounded">
			<ul lm-menu></ul>
			
			<div id="searchform">
				<form method="get" ng-submit="loginSearch(this)">
					<input type="text" placeholder="What are you looking for?" class="search-box" name="query" ng-model="query" />
					<input type="submit" class="button continue search-btn" value="SEARCH" />
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
