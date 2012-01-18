<?php if ($user_permissions[getParentModule()][getChildModule()]['can_read']): ?>
<?php require_once(COMMON_MODULES_PATH.DIRECTORY_SEPARATOR."public.php"); ?>
<?php
require_once(MODULES_PATH.DIRECTORY_SEPARATOR."runtime".DIRECTORY_SEPARATOR."misc".DIRECTORY_SEPARATOR."request_action.php");

require_once(MODULES_PATH.DIRECTORY_SEPARATOR."runtime".DIRECTORY_SEPARATOR."misc".DIRECTORY_SEPARATOR."functions.php");

function printCompletedItem($processes = array(), $parent_id = 0) {
	global $connection, $user_permissions;

	if (isNotNULL($processes)) {
		print "<ul>\n";
		print "<li class=\"treeitem\">";
		print "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"1\" border=\"0\" class=\"treeitem\">";
		foreach ($processes as $process) {
			print "<tr><td width=\"50%\" title=\"<p style=' text-align : left !important; '>";
			$properties = $connection->execute('select name, value from process_instance_properties_list where instance_id = '.$process['id'].' and property_id in (select property_id from cs_process_info_property where process_id = '.$process['process_id'].') order by property_id')->fetchAll();
			$chrono = $connection->execute('select * from cs_chrono where instance_id = '.$process['id'])->fetchAll();
			foreach ($properties as $property) {
				$property['value'] = stripMacros($property['value']); 
				print "<b>".$property['name'].": </b>".htmlentities((mb_strlen($property['value']) > 50?mb_substr($property['value'], 0, 50)."...":$property['value']), ENT_COMPAT, DEFAULT_CHARSET)."<br>";
			}
			if (isNotNULL($process['parent_id'])) {
				print "<b>Родительский документ: </b>".$process['parentname']." №".$process['parent_id']."<br />";
			}
			print "</p>\" class=\"small action".(($process['id'] == PROCESS_INSTANCE_ID)?" red":"")."\" onClick=\"document.location.href = '?module=".getParentModule().DIRECTORY_SEPARATOR.getChildModule().DIRECTORY_SEPARATOR."processes/list&project_instance_id=".$process['project_instance_id']."&project_id=".$process['project_id']."&process_instance_id=".$process['id']."&process_id=".$process['process_id']."';\">";
			print (($process['initiator_id'] == USER_CODE)?"<strong>":"").$process['name']." №".$process['id'].(($process['initiator_id'] == USER_CODE)?"</strong>":"")."</td><td align=\"center\" class=\"small\" width=\"20%\">".$process['initiatorname']."</td><td align=\"center\" class=\"small\" width=\"15%\">".($process['started_at']?strftime("%d.%m.%Y в %H:%M", strtotime($process['started_at'])):"-")."</td><td align=\"center\" class=\"small\" width=\"15%\">".strftime("%d.%m.%Y в %H:%M", strtotime($process['ended_at']))."</span></td>";
			print "<td width=\"auto\" align=\"center\">";
			if ((isNotNULL($chrono)) and (($user_permissions[getParentModule()][getChildModule()]['can_read']) or ($user_permissions[getParentModule()][getParentChildModule()]['can_read']))) {
				print "<span class=\"small action\" title=\"История движения документа '".$process['name']."'\" onClick=\"openWindow('?module=".getParentModule().DIRECTORY_SEPARATOR.getChildModule().DIRECTORY_SEPARATOR."history/list&project_instance_id=".$process['project_instance_id']."&project_id=".$process['project_id']."&process_instance_id=".$process['id']."&process_id=".$process['process_id']."');\"><img src=\"images/date.png\" /></span>";
				print "&nbsp";
			}
			if (($user_permissions[getParentModule()][getChildModule()]['can_read']) or ($user_permissions[getParentModule()][getParentChildModule()]['can_read'])) {
				print "<span class=\"small action\" title=\"Хронология документа '".$process['name']."'\" onClick=\"openWindow('?module=".getParentModule().DIRECTORY_SEPARATOR.getChildModule().DIRECTORY_SEPARATOR."chronos/list&project_instance_id=".$process['project_instance_id']."&project_id=".$process['project_id']."&process_instance_id=".$process['id']."&process_id=".$process['process_id']."');\"><img src=\"images/time.png\" /></span>";
				print "&nbsp";
			}
			if ($user_permissions[getParentModule()][getChildModule()]['can_read']) {
				print "<span class=\"small action\" title=\"Печать документа '".$process['name']."'\" onClick=\"openWindow('?module=".getParentModule().DIRECTORY_SEPARATOR.getChildModule().DIRECTORY_SEPARATOR."processes/list&media=print&project_instance_id=".$process['project_instance_id']."&project_id=".$process['project_id']."&process_instance_id=".$process['id']."&process_id=".$process['process_id']."');\"><img src=\"images/print.png\" /></span>";
				print "&nbsp";
			}
			if ($user_permissions[getParentModule()][getChildModule()]['can_read']) {
				print "<span class=\"small action\" title=\"Просмотр документа '".$process['name']."'\" onClick=\"openWindow('?module=".getParentModule().DIRECTORY_SEPARATOR.getChildModule().DIRECTORY_SEPARATOR."processes/list&project_instance_id=".$process['project_instance_id']."&project_id=".$process['project_id']."&process_instance_id=".$process['id']."&process_id=".$process['process_id']."');\"><img src=\"images/template.png\" /></span>";
			}
			print "</td></tr>";
		}
		print "</table>";
		print "</li>\n";
		print "</ul>\n";
	}
}
?>
<?php
  $query = 'select distinct project_processes_instances_list.* from project_processes_instances_list, cs_process_current_action where (project_processes_instances_list.id = cs_process_current_action.instance_id)'.
    // выборка по отдельному предприятию
    (((defined('PROJECT_INSTANCE_ID')) and (PROJECT_INSTANCE_ID <> ''))?' and (project_processes_instances_list.project_instance_id = '.PROJECT_INSTANCE_ID.')':'').
    //
    ' and ((project_processes_instances_list.project_id in (select project_id from cs_project_role where division_id in ('.implode(', ', $engine->getAccount()->getDivisionsList()).')))'.
	   ' or (project_processes_instances_list.project_instance_id in '.
	   '(select project_instance_id from cs_project_process_instance where cs_project_process_instance.process_instance_id in (select id from project_processes_instances_list as ppil where ppil.project_instance_id = project_processes_instances_list.project_instance_id and (ppil.initiator_id = '.USER_CODE.' or (ppil.id in (select instance_id from cs_process_current_action where (instance_id = project_processes_instances_list.id) and ((performer_id = '.USER_CODE.') or (initiator_id = '.USER_CODE.')) and (ended_at is not null) and (status_id in ('.implode(', ', array(Constants::ACTION_STATUS_COMPLETED, Constants::ACTION_STATUS_SKIPED)).'))))))'.
	   ')))'.
	//
	' and '.(isNULL($inwhere)
	   // 
	   ?'(((cs_process_current_action.performer_id = '.USER_CODE.') or (cs_process_current_action.initiator_id = '.USER_CODE.')) and '.
	 	'(cs_process_current_action.status_id in ('.implode(', ', array(Constants::ACTION_STATUS_COMPLETED, Constants::ACTION_STATUS_SKIPED)).')))'
	   //
	   :'((cs_process_current_action.performer_id = '.((defined('X_PROCESS_PERFORMER') and (X_PROCESS_PERFORMER <> ''))?X_PROCESS_PERFORMER:USER_CODE).') or ('.(implode(' and ', $inwhere)).')) and ('.(implode(' and ', $inwhere)).') and '.
	    '(cs_process_current_action.status_id in ('.implode(', ', array(Constants::ACTION_STATUS_COMPLETED, Constants::ACTION_STATUS_SKIPED)).'))').
	(isNotNULL($where)
	    //
	    ?' and ('.(implode(' and ', $where)).')'
	    //
	    :'').' and (project_processes_instances_list.status_id in ('.implode(', ', array(Constants::PROCESS_STATUS_COMPLETED, Constants::PROCESS_STATUS_CHILD_COMPLETED)).'))'.
	    //
	     ' order by project_processes_instances_list.project_id, project_processes_instances_list.started_at desc, '.
         'project_processes_instances_list.ended_at desc, project_processes_instances_list.id desc,'.
	     'project_processes_instances_list.name limit '.CURRENT_LIMIT;

  $processes = $connection->execute($query)->fetchAll();

  print "<div class=\"caption\"><img src=\"images/constants.png\" style=\" float: right; z-index: 1000; \" onClick=\"hideIt('request_params')\" title=\"Выборка документов по параметрам\" />Архивные документы".(defined('PROJECT_INSTANCE_ID')?": ".$projectslist[PROJECT_INSTANCE_ID]:"")."</div>\n";
  require_once(MODULES_PATH.DIRECTORY_SEPARATOR."runtime".DIRECTORY_SEPARATOR."misc".DIRECTORY_SEPARATOR."request_form.php");
  
  $projectslist = getProjectsList($processes);

  if (isNotNULL($projectslist)) {
	  print "<ul class=\"tree\" id=\"projects_tree\" style=\" display : none; \">\n";
	  foreach ($projectslist as $project_id => $project_name) {
		print "<li class=\"roottreeitem\"><a href=\"#\"></a>Предприятие: ".$project_name;
		if ($user_permissions[getParentModule()][getChildModule()]['can_read']) {
			printCompletedItem(getByProject($processes, $project_id));
		}
	  	print "</li>\n";
	  }
	  print "</ul>\n";
  }
?>
<script>
<!--
	var projects_tree_options = {
			'theme' : { 'name' : 'SimpleTree' },
			closeSiblings : false,
			maxOpenDepth : <?= (((defined('PROJECT_INSTANCE_ID')) or (count($projectslist) == 1))?2:0); ?>,
			flagClosedClass : 'close',
			toggleMenuOnClick : true,
			incrementalConvert : false,
			openTimeout : 0,
			closeTimeout: 0
	}
	var projects_tree = new CompleteMenuSolution;
	projects_tree.initMenu('projects_tree', projects_tree_options);
//-->
</script>
<?php endif; ?>
