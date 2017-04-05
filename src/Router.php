<?php

namespace adf;

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use adf\controller\IndexController;

class Router {
	function routing() {
		
		// ルーティング用ライブラリの読み込み
		$router = new RouteCollector ();
		
		$router->any ( '/example', function () {
			return 'This route responds to any method (POST, GET, DELETE etc...) at the URI /example';
		} );
		
		// 静的ファイルのルーティングテスト
		$router->any ( '/test', function () {
			include ('./test.html');
			return;
		} );
		
		/*
		 * $router->any ( '/', function () {
		 * // トップページ
		 * // include (Config::SRC_REAL_URL . 'controller/Home.php');
		 * // Controller::dispatch(new IndexController);
		 * IndexController::render ();
		 * return;
		 * } );?
		 */
		
		$router->controller ( '/', 'adf\\controller\\IndexController' );
		$router->controller ( '/index.php', 'adf\\controller\\IndexController' );
		$router->controller ( '/hoge', 'adf\\controller\\IndexController' );
		
		/*$router->any ( '/agent/upload', function () {
			// zipを受け取る
			include (Config::SRC_REAL_URL . 'controller/FileUpload.php');
			return;
		} );*/
		$router->controller('/agent/upload', 'adf\\controller\\FileUploadController');
		
		$router->controller('/agents', 'adf\\controller\\AgentListController');
		
		// Print out the value returned from the dispatched function
		try {
			
			$url = $_SERVER ['REQUEST_URI'];
		
			if(dirname($_SERVER["SCRIPT_NAME"])!="/"){
				$url = str_replace(dirname($_SERVER["SCRIPT_NAME"]), '', $url);
			}
			
			$dispatcher = new Dispatcher ( $router->getData () );
			$response = $dispatcher->dispatch ( $_SERVER ['REQUEST_METHOD'], $url);
			echo $response;
			exit ();
		} catch ( HttpRouteNotFoundException $e ) {
			print '<pre>';
			print_r ( $e );
			print '</pre>';
			exit ();
		} catch ( HttpMethodNotAllowedException $e ) {
			print '<pre>';
			print_r ( $e );
			print '</pre>';
			exit ();
		}
	}
}

?>
