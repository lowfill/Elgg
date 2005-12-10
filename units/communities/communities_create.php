<?php

	if (isset($_SESSION['comm_name'])) {
		$comm_name = $_SESSION['comm_name'];
	}
	if (isset($_SESSION['comm_username'])) {
		$comm_name = $_SESSION['comm_username'];
	}

	global $page_owner;
	
	if (logged_on && $page_owner == $_SESSION['userid']) {
	
	$header = gettext("Create a new community"); // gettext variable
       $communityName = gettext("Community name:"); // gettext variable
       $communityUsername = gettext("Username for community:"); // gettext variable
       $buttonValue = gettext("Create"); // gettext variable

       $run_result .= <<< END

<div class="community_create">
	<p>
		&nbsp;
	</p>
	<h5>
		$header
	</h5>
	<form action="" method="post">
END;

		$run_result .= run("templates:draw", array(
														'context' => 'databox1',
														'name' => $communityName,
														'column1' => "<input type=\"text\" name=\"comm_name\" value=\"$comm_name\" />"
													)
													);
		$run_result .= run("templates:draw", array(
														'context' => 'databox1',
														'name' => $communityUsername,
														'column1' => "<input type=\"text\" name=\"comm_username\" value=\"$comm_username\" />"
													)
													);
			
		$run_result .= <<< END
		<p>
			<input type="submit" value="$buttonValue" />
			<input type="hidden" name="action" value="community:create" />
		</p>
		
	</form>
</div>

END;

	}

?>