<?php

	//	ELGG manage icons page

	// Run includes
		require("../includes.php");
		
	// Initialise functions for user details, icon management and profile management
		run("userdetails:init");
		run("profile:init");
		run("icons:init");
		
		if (isset($_REQUEST['context'])) {
			define("context", $_REQUEST['context']);
		} else {
			define("context", "account");
		}


	// You must be logged on to view this!
		protect(1);
		
		$title = run("profile:display:name") . " :: ". gettext("Manage user icons");
		
		$body = run("content:icons:manage");
		$body .= run("icons:edit");
		$body .= run("icons:add");
		
		$mainbody = run("templates:draw", array(
							'context' => 'contentholder',
							'title' => $title,
							'body' => $body
						)
						);
						
		echo run("templates:draw:page", array(
					$title, $mainbody
				)
				);

?>