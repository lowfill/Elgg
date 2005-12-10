<?php

	global $template;
	global $template_definition;
	
	$template_definition[] = array(
									'id' => 'folder',
									'name' => gettext("Folder"),
									'description' => gettext("Each individual folder"),
									'glossary' => array(
															'{{username}}' => gettext("The owner of the folder"),
															'{{name}}' => gettext("The name of the folder"),
															'{{url}}' => gettext("The folder's URL"),
															'{{menu}}' => gettext("Menu items for folder owner (edit, delete, etc)"),
															'{{icon}}' => gettext("The URL of the file's icon"),
															'{{keywords}}' => gettext("Keywords associated with the folder")
														)
									);
	
	$template['folder'] = <<< END
					<table>
						<tr>
							<td valign="middle">
								<a href="{{url}}">
									<img src="{{icon}}" width="93" height="90" border="0" alt="" />
								</a>
							</td>
							<td valign="middle">
								<a href="{{url}}">{{name}}</a> <small>{{menu}}</small><br />
								<small>{{keywords}}</small
							</td>
						</tr>
					</table>
END;

	$template_definition[] = array(
									'id' => 'file',
									'name' => gettext("File"),
									'description' => gettext("Each individual file within a folder"),
									'glossary' => array(
															'{{url}}' => gettext("The file's URL"),
															'{{originalname}}' => gettext("Its filename"),
															'{{description}}' => gettext("A description of the file"),
															'{{title}}' => gettext("Its title"),
															'{{menu}}' => gettext("Menu items for file owner (edit, delete, etc)"),
															'{{icon}}' => gettext("The URL of its icon"),
															'{{keywords}}' => gettext("Keywords associated with the folder")
														)
									);

	$template['file'] = <<< END
	
					<table>
						<tr>
							<td>
								<a href="{{url}}">
									<img src="{{icon}}" width="90" height="90" border="0" alt="" />
								</a>
							</td>
							<td valign="middle">
								<a href="{{url}}"><b>{{title}}</b></a>
								<small>{{menu}}</small><br />
									<p>{{description}}</p>
								<small>{{originalname}}</small><br />
								<small>{{keywords}}</small>
							</td>
						</tr>
					</table>
	
END;

?>