<?php
namespace adf\controller;

use adf\Config;
use adf\controller\AbstractController;
use adf\file\AgentLoader;

class AgentListController extends AbstractController{
	
	public function get(){
		
		//エージェントのリストを取得
		$agents = AgentLoader::getAgents();
		
		include (Config::$SRC_REAL_URL . 'view/AgentListView.php');
	}
	
}