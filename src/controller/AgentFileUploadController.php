<?php

namespace adf\controller;

use adf\file\AgentLoader;
use ZipArchive;
use Symfony\Component\Finder\Finder;

use adf\Config;
use adf\controller\AbstractController;
use adf\Agent;

class AgentFileUploadController extends AbstractController
{
	public function post()
    {
		ini_set ( 'display_errors', 1 );
		
		$uuid = uniqid();
		//アップロードを受け取る処理
		self::receivePost($uuid);
		self::extractZip($uuid);
		//self::echoFileCheck($uuid);
		
		$fileName = $_POST['agent_name'];
		//$output = shell_exec("sh ". Config::$ROUTER_PATH. "ruby/add_agent.sh test " .$fileName."_".$uuid);
	}
	
	private function receivePost($uuid)
    {
        $tmpDir = Config::$ROUTER_PATH.Config::TMP_DIR_NAME;
        if (! file_exists ( $tmpDir )) { mkdir( $tmpDir ); }
		//phpinfo();
		
		$echoDate = [];
		$echoDate['uploadDir']  = realpath ( $tmpDir );
		$echoDate['name'] = $_FILES ['userfile'] ['name'];
		$echoDate['tmp_name'] = $_FILES ['userfile'] ['tmp_name'];
		//echo json_encode($echoDate);

		//move_uploaded_file ( $_FILES ['userfile'] ['tmp_name'], $uploadDir . "/" . $_FILES ['userfile'] ['name'] );
		move_uploaded_file( $_FILES ['userfile'] ['tmp_name'], $tmpDir . "/" . $uuid. ".zip");
	}

    private function extractZip($uuid)
    {
        $zip = new ZipArchive();
        $tmpDir = Config::$ROUTER_PATH.Config::TMP_DIR_NAME;
        $uploadedFile = $tmpDir."/".$uuid.".zip";
        $agentName = $_POST['agent_name'];

        // ZIPファイルをオープン
        $res = $zip->open($uploadedFile);

        // zipファイルのオープンに成功した場合
        if ($res === true)
        {
            $agentDir = Config::$ROUTER_PATH.Config::AGENTS_DIR_NAME;
            $approved = false;
            // 圧縮ファイル内の全てのファイルを指定した解凍先に展開する
            $fileDir = $tmpDir."/".$uuid;
            $zip->extractTo($fileDir.'/');
            $zip->close();
            system("rm -f ".$uploadedFile);

            if (file_exists($fileDir.'/'.'compile.sh')
                && file_exists($fileDir.'/'.'start.sh'))
            {
                $approved = true;
            }
            else
            {
                $files = scandir($fileDir.'/');
                foreach ($files as $file)
                {
                    $dir = $fileDir.'/'.$file;
                    if (is_dir($dir) && $file !== '.' && $file !== '..')
                    {
                        if (file_exists($dir.'/'.'compile.sh')
                            && file_exists($dir.'/'.'start.sh'))
                        {
                            $approved = true;
                            $fileDir = $dir;
                            break;
                        }
                    }
                }
            }

            if ($approved)
            {
                $fullName = $agentName.'_'.$uuid;
                system('mv "'.$fileDir.'" "'.$agentDir.'/'.$fullName.'"');
                system("rm -rf ".$tmpDir.'/'.$uuid);

                AgentLoader::addAgent($fullName, $agentName);

                echo '{"status":true}';
                return true;
            }

            system("rm -rf ".$tmpDir.'/'.$uuid);
        }

        echo '{"status":false}';
		return false;
    }
	
	private function echoFileCheck($uuid)
    {
		$status = $this->checkFile($uuid);

		if($status){
			echo '{"status":true}';
		}else{
			//ファイルも削除
			$agentDir = Config::$ROUTER_PATH. Config::AGENTS_DIR_NAME;
			$fileName = $_POST['agent_name'];
			
			$fileDir = $agentDir."/".$fileName."_".$uuid;
			system("rm -rf {$fileDir}");
			
			echo '{"status":false}';
		}
		
	}
	
	private function checkFile($uuid)
    {
		$agentDir = Config::$ROUTER_PATH. Config::AGENTS_DIR_NAME;
		$fileName = $_POST['agent_name'];
		$fileDir = $agentDir . "/" .$fileName."_" . $uuid;
		$finder = new Finder();

		$judgment = 0;
		if(count($finder->in($fileDir)->files()->name('compile.sh')) > 0) { $judgment++; }
		if(count($finder->in($fileDir)->files()->name('start.sh')) > 0) { $judgment++; }
		
		return ($judgment >= 2);
	}
	
	private function getFileList($fileDir)
    {
		$files = scandir ( $fileDir);
		$files = array_filter ( $files, function ($file) { // 注(1)
			return ! in_array ( $file, array (
					'.',
					'..'
			) );
		} );
		
		return $files;
		
	}
	
	
}

?>