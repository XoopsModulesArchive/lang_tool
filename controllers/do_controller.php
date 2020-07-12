<?php
DEFINE('LANG_TOOL_PATTERN', '/define\s*\(\s*[\'"]([^\'"]*?)[\'"]\s*,\s*[\'"](.*?)[\'"]\s*\)\s*;\s*/ism');
//ini_set('pcre.backtrack_limit', 1024 * 1024 * 1024 * 1024);
//ini_set('pcre.recursion_limit', 1024 * 1024 * 1024 * 1024);
class DoController extends AppController {

    var $name = 'Do';
    var $helpers = array('Html', 'Form');
    var $uses = array('LtLanguage');
    var $skip_patterns = array(
		'/\/\/.*/',
    	'/\/\*([^\*]*)\*\//s',
    );
    var $fileList = array();

    function index() {
        $this->redirect('/do/step1');
    }

    function step1() {
        $base = XOOPS_ROOT_PATH.'/modules';
        if(is_dir($base)){
            $dh = new Folder($base);
            $items = $dh->read();
            foreach($items[0] AS $item) {
                $mo_dir[$item] = $item;
            }
        } else {
            $this->set('error', printf(_MD_LANG_TOOL_DIRERROR, $base));
        }
        $mo_dir['xoops_core_lang_files'] = 'xoops_core_lang_files';
        $this->set('modules', $mo_dir);
    }

    function step2() {
        if($this->data) {
            if(!empty($this->data['Do']['manual_path']) && $this->data['Do']['manual_path'] !=
            $_SESSION['lang_tool']['base_dir'] && file_exists($this->data['Do']['manual_path'])) {
                $_SESSION['lang_tool']['base_dir'] = $this->data['Do']['manual_path'];
                $_SESSION['lang_tool']['module'] = $this->data['Do']['manual_path'];
            } else if($this->data['Do']['module'] == 'xoops_core_lang_files') {
                $_SESSION['lang_tool']['base_dir'] = XOOPS_ROOT_PATH.'/language/';
                $_SESSION['lang_tool']['module'] = $this->data['Do']['module'];
            } else {
                $_SESSION['lang_tool']['base_dir'] = XOOPS_ROOT_PATH.'/modules/'.$this->data['Do']['module'].'/language/';
                $_SESSION['lang_tool']['module'] = $this->data['Do']['module'];
            }
            $_SESSION['lang_tool']['path'] = $_SESSION['lang_tool']['file'] = '';
        }
        if(!empty($_SESSION['lang_tool']['module'])) {
            $this->set('languages', $this->LtLanguage->find('list', array('fields' =>
            array('LtLanguage.dirname', 'LtLanguage.title'))));
        } else {
            $this->redirect(array('action' => 'step1'));
        }
    }

    function step3() {
        if($this->data) {
            $_SESSION['lang_tool']['from'] = $this->data['Do']['from'];
            $_SESSION['lang_tool']['to'] = $this->data['Do']['to'];
        }
        if(!empty($_SESSION['lang_tool']['module'])&&!empty($_SESSION['lang_tool']['from'])&&
        !empty($_SESSION['lang_tool']['to'])){
            if(!isset($_SESSION['lang_tool']['path'])) {
                $_SESSION['lang_tool']['path'] = '';
            }
            $fh = new Folder($_SESSION['lang_tool']['base_dir'] . $_SESSION['lang_tool']['from'] .
            $_SESSION['lang_tool']['path']);
            $files = $fh->read();
            $lang_file = array();
            if($_SESSION['lang_tool']['path'] != '') {
                $lang_file[0] = '..';
            }
            $lang_file = am($lang_file, $files[0], $files[1]);
            $this->set('lang_file', $lang_file);
            if(!empty($_SESSION['lang_tool']['file'])) {
                $this->set('showFocus', true);
            }
        } else {
            $this->redirect(array('action' => 'step2'));
        }
    }

    function step4() {
        if(!empty($this->data)) {
            $sourceFile = $_SESSION['lang_tool']['base_dir'] . $_SESSION['lang_tool']['from'] .
            $_SESSION['lang_tool']['path'] . DS . $this->data['Do']['file'];
            if($this->data['Do']['file'] == '..') {
                $_SESSION['lang_tool']['path'] = substr($_SESSION['lang_tool']['path'], 0,
                strrpos($_SESSION['lang_tool']['path'], DS));
                $this->redirect(array('action' => 'step3'));
            } else if(is_dir($sourceFile)) {
                $_SESSION['lang_tool']['path'] .= DS . $this->data['Do']['file'];
                $this->redirect(array('action' => 'step3'));
            } else {
                $targetFile = $_SESSION['lang_tool']['base_dir'] . $_SESSION['lang_tool']['to'] .
                $_SESSION['lang_tool']['path'] . DS . $this->data['Do']['file'];
                $_SESSION['lang_tool']['file'] = $this->data['Do']['file'];
                $pathParts = pathinfo($this->data['Do']['file']);
                switch($pathParts['extension']) {
                    case 'php':
                        $sourceMatches = array();
                        $sourceString = file_get_contents($sourceFile);
                        $sourceString = preg_replace($this->skip_patterns, '', $sourceString);
                        preg_match_all(LANG_TOOL_PATTERN, $sourceString, $sourceMatches);
                        $sourceCount = sizeof($sourceMatches[1]);
                        $sourceLanguage = array();
                        for($i=0; $i < $sourceCount; $i++){
                            $sourceLanguage[$sourceMatches[1][$i]] = $sourceMatches[2][$i];
                        }
                        if(!empty($sourceLanguage)) {
                            $targetLanguage = array();
                            if(file_exists($targetFile)) {
                                $targetMatches = array();
                                $targetString = file_get_contents($targetFile);
                                $targetString = preg_replace($this->skip_patterns, '', $targetString);
                                preg_match_all(LANG_TOOL_PATTERN, $targetString, $targetMatches);
                                $targetCount = sizeof($targetMatches[1]);
                                for($i = 0; $i < $targetCount; $i ++) {
                                    $targetLanguage[$targetMatches[1][$i]] = $targetMatches[2][$i];
                                }
                            }
                            $this->set('sourceLanguage', $sourceLanguage);
                            $this->set('targetLanguage', $targetLanguage);
                            break;
                        } else {
                            $pathParts['extension'] = 'tpl';
                        }
                    case 'tpl':
                    default:
                        $this->set('sourceString', file_get_contents($sourceFile));
                        if(file_exists($targetFile)) {
                            $this->set('targetString', file_get_contents($targetFile));
                        }
                }
                $this->set('extension', $pathParts['extension']);
            }
        } else {
            $this->redirect(array('action' => 'step3'));
        }
    }

    function step5() {
        if($this->data) {
            $dir2 = $_SESSION['lang_tool']['base_dir'].$_SESSION['lang_tool']['to'].$_SESSION['lang_tool']['path'];
            $file1 = $dir2 . DS . $_SESSION['lang_tool']['file'];
            $file2 = XOOPS_ROOT_PATH . DS . 'cache' . DS . $_SESSION['lang_tool']['module'] . DS .
            'language' . DS . $_SESSION['lang_tool']['to'] . $_SESSION['lang_tool']['path'] . DS .
            $_SESSION['lang_tool']['file'];

            if(!file_exists($dir2) && is_writeable($_SESSION['lang_tool']['base_dir'])) {
                mkdir($dir2, 0707, true);
            }

            if(is_writeable($dir2)){
                $target_file = $file1;
            } else {
                $target_file = $file2;
                $_SESSION['lang_tool']['write_cache'] = true;
            }

            $translated_str = '';
            switch($this->data['Do']['extension']) {
                case 'php':
                    $file_from = $_SESSION['lang_tool']['base_dir'] . $_SESSION['lang_tool']['from'] .
                    $_SESSION['lang_tool']['path'] . DS . $_SESSION['lang_tool']['file'];
                    $source_str = file_get_contents($file_from);
                    $source_str = preg_replace($this->skip_patterns, '', $source_str);
                    $translated_str = preg_replace_callback(LANG_TOOL_PATTERN, array(get_class($this), 'lang_trans'), $source_str);
                    break;
                case 'tpl':
                    $translated_str = $this->data['Do']['target'];
                default:
            }
            if(!empty($translated_str)) {
                file_put_contents($target_file, $translated_str);
            }

            $this->set('targetFile', $target_file);
        }

    }

    function download() {
        foreach(array('base_dir', 'module', 'to', 'file') AS $key) {
            if(empty($_SESSION['lang_tool'][$key])) {
                $this->redirect($this->referer());
            }
        }
        if(isset($_SESSION['lang_tool']['write_cache']) && $_SESSION['lang_tool']['write_cache'] === true) {
            $path = XOOPS_ROOT_PATH . DS . 'cache' . DS . $_SESSION['lang_tool']['module'] . DS .
            'language' . DS . $_SESSION['lang_tool']['to'];
        } else {
            $path = $_SESSION['lang_tool']['base_dir'].$_SESSION['lang_tool']['to'];
        }
        $zipfilename = $_SESSION['lang_tool']['module'] . '_lang_' . $_SESSION['lang_tool']['to'] . '.zip';
        $this->getlist($path);
        App::import('Vendor', 'ZipLib');
        $zip = new zipfile;
        foreach($this->fileList AS $file) {
            $localName = substr($file, strrpos($file, $_SESSION['lang_tool']['to']));
            $zip->addFile(file_get_contents($file), $localName);
        }
        $dump_buffer = $zip->file();
        header('Pragma: public');
        header('Content-type: application/zip');
        header('Content-length: ' . strlen($dump_buffer));
        header('Content-Disposition: attachment; filename="'.$zipfilename.'"');
        echo $dump_buffer;
        exit;
    }

    function getlist($dir){
        if(is_dir($dir)){
            if($dh = opendir($dir)){
                while(($file = readdir($dh)) !== false){
                    if($file != '.' && $file != '..')
                    $this->getlist($dir . '/' . $file);
                }
            }
        } else {
            $this->fileList[] = $dir;
        }
    }

	private function lang_trans($matches) {
		if(isset($this->data['Lang'][$matches[1]])) {
		    $new_string = preg_replace('/\'/', '\\\'', $this->data['Lang'][$matches[1]]);
		} else {
		    $new_string = preg_replace('/\'/', '\\\'', $matches[2]);
		}
		while(strpos($new_string, '\\\\')){
			$new_string = str_replace('\\\\', '\\', $new_string);
		}

		if(preg_match_all('/\\\\\'\s*\.(.*?)\s*\.\s*\\\\\'/ism', $new_string, $inmatches)) {
			foreach($inmatches[1] AS $key => $val) {
				$inmatches[1][$key] = '\' . ' . stripslashes($val) . ' . \'';
			}
			$new_string = str_replace($inmatches[0], $inmatches[1], $new_string);
		}
		return 'define(\''.$matches[1].'\', \''.$new_string.'\');'. chr(10);
	}

}
