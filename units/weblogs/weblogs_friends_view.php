<?php

	// View a weblog
	
	// Get the current profile ID
	
		global $page_owner;
		
		$url = url;
		
	// If the weblog offset hasn't been set, it's 0
		if (!isset($_REQUEST['weblog_offset'])) {
			$weblog_offset = 0;
		} else {
			$weblog_offset = $_REQUEST['weblog_offset'];
		}
		$weblog_offset = (int) $weblog_offset;
		
	// Get all posts in the system by our friends that we can see
	
		$friends = run("friends:get",array($page_owner));
		
		$where2 = "weblog = \"$page_owner\"";
		
		if (sizeof($friends) > 0) {
			
			foreach($friends as $friend) {

				if ($where2 != "") {
					$where2 .= "or ";
				}
				$where2 .= "weblog=\"".$friend->user_id."\" ";
				
			}
			
		}
	
		$where1 = run("users:access_level_sql_where",$_SESSION['userid']);
		// if (!isset($_SESSION['friends_posts_cache']) || (time() - $_SESSION['friends_posts_cache']->created > 60)) {
			// $_SESSION['friends_posts_cache']->created = time();
			// $_SESSION['friends_posts_cache']->data = db_query("select * from weblog_posts where ($where1) and ($where2) order by posted desc limit $weblog_offset,25");
		// }
		// $posts = $_SESSION['friends_posts_cache']->data;
		$posts = db_query("select * from weblog_posts where ($where1) and ($where2) order by posted desc limit $weblog_offset,25");
		$numberofposts = db_query("select count(ident) as numberofposts from weblog_posts where ($where1) and ($where2)");
		$numberofposts = $numberofposts[0]->numberofposts;
		
		if (sizeof($posts > 0)) {
			
			$lasttime = "";
			
			foreach($posts as $post) {
				
				$time = gmdate("F d, Y",$post->posted);
				if ($time != $lasttime) {
					$run_result .= "<h2 class=\"weblogdateheader\">$time</h2>\n";
					$lasttime = $time;
				}
				
				$run_result .= run("weblogs:posts:view",$post);
				
			}
			
			$weblog_name = htmlentities(stripslashes($_REQUEST['weblog_name']));
			
			if ($numberofposts - ($weblog_offset + 25) > 0) {
				$display_weblog_offset = $weblog_offset + 25;
				$back = gettext("Back"); // gettext variable
                            $run_result .= <<< END
				
				<a href="{$url}{$weblog_name}/weblog/friends/skip={$display_weblog_offset}">&lt;&lt; $back</a>
				<!-- <form action="" method="post" style="display:inline">
					<input type="submit" value="&lt;&lt; Previous 25" />
					<input type="hidden" name="weblog_offset" value="{$display_weblog_offset}" />
				</form> -->
				
END;
			}
			if ($weblog_offset > 0) {
				$display_weblog_offset = $weblog_offset - 25;
				if ($display_weblog_offset < 0) {
					$display_weblog_offset = 0;
				}
				$next = gettext("Next"); // gettext variable
                           $run_result .= <<< END
				
				<a href="{$url}{$weblog_name}/weblog/friends/skip={$display_weblog_offset}">$next &gt;&gt;</a>
				
END;
			}
			
		}

?>