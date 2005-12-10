<?php

	//	ELGG weblog view page

	// Run includes
		require("../includes.php");
		
		run("profile:init");
		run("weblogs:init");
		run("friends:init");
		
		define("context", "weblog");
		
		$title = run("profile:display:name") . " :: " . gettext("Blog Archives");
		
		$body .= run("weblogs:archives:month:view");
		
		$body = run("templates:draw", array(
						'context' => 'contentholder',
						'title' => $title,
						'body' => $body
					)
					);
		
		echo run("templates:draw:page", array(
						$title, $body
					)
					);

?>