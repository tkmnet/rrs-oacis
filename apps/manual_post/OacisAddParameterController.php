<?php

namespace adf\apps\manual_post;

use adf\Config;
use adf\controller\AbstractController;

class OacisAddParameterController extends AbstractController {
	
	public function post() {
		
		ini_set ( 'display_errors', 1 );
		
		//TODO オアシスに登録処理
		
		$simulatorID = "590463aee4dec200d962035a";
		$hostID = "59046193315fa7ef1ceaf976";
		
		if($_POST['parameter_simulator_id']!=""){
			$simulatorID = $_POST['parameter_simulator_id'];
		}
		
		if($_POST['parameter_host_id']!=""){
			$hostID= $_POST['parameter_host_id'];
		}
		
		//echo $simulatorID . " " .$hostID;
		
		$name = $_POST['parameter_name'];
		
		$mapName = $_POST['parameter_map'];
		$agentName = $_POST['parameter_agent'];
		
		$output = shell_exec("sh ". Config::$ROUTER_PATH. "ruby/add_agent.sh ".$simulatorID." ".$hostID." ".$mapName." " . $agentName);
		
		echo '{"output":"hoge" }';
		
		
	}
	
	
}