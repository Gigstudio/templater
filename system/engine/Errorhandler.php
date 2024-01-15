<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Errorhandler{
	public array $codemap;

    public const EL_INFO = 0;
    public const EL_WARN = 1;
    public const EL_FATAL = 2;
    public const EL_SUPRESS = 5;

    public int $log_lvl = self::EL_WARN;
    private string $log_file;
	public bool $error_display;
	public string $error_page = PATH_VIEWS . 'templates/error.php';

    public string $er_code;
    public string $er_msg;
    public array $params = [];
    public array $messages;
    public string $lang = 'ru';

    public function __construct(){
        $this->log_file = PATH_LOGS . 'log_' . date("Y-m-d") . '.log';
        $this->error_display = ENVIRONMENT == 'development';
        $this->setLang('ru');
		if(false === $this->error_display){
        	$this->set_handler();
		}
    }

    public function set_handler(){
		// Error Handler
		set_error_handler(function(string $code, string $message, string $file, string $line) {
            $this->setError($code);
			switch ($code) {
				case E_NOTICE:
				case E_USER_NOTICE:
					$error = self::EL_INFO;
					break;
				case E_WARNING:
				case E_USER_WARNING:
					$error = self::EL_WARN;
					break;
				case E_ERROR:
				case E_USER_ERROR:
					$error = self::EL_FATAL;
					break;
				default:
					$error = 3;//'Unknown';
					break;
			}

			// if ($error >= $this->log_lvl) {
				$this->write($message, $file, $error);
			// }

			if ($this->error_display) {
				$msg = '<b>' . $error . '</b>: ' . $message . ' in <b>' . $file . '</b> on line <b>' . $line . '</b>';
				// Application::$app->session->setFlash($error, $msg, 'dynamic');
				// echo $msg.'<br>';
				header('Location: ' . HOME_URL . 'error');
			} else {
				header('Location: ' . HOME_URL . 'error');
				// die();
			}
		});

		// Exception Handler
		set_exception_handler(function(\Throwable $e) {
            $this->setError($e->getCode());
			$this->write($e->getMessage(), $e->getFile(), get_class($e));
			$er_content = array_key_exists($this->er_code, $this->messages) 
				? $this->messages[$this->er_code] : [
					'header' 	=> 'Unknown',
					'message'	=> 'Возникла непредвиденная ошибка: '.$e->getMessage(),
					'resolve'	=> '<a href="' . HOME_URL .'">На главную</a>'
				];
			ob_start();
			include $this->error_page;
			$content = ob_get_clean();
			echo $content;
			exit;
		});
    }

    public function setLang($lng){
        $path = PATH_PAGES . 'languages' . DS . $lng . DS;
        if(!file_exists($path . 'error.php')){
            return;
        }
        require_once $path . 'error.php';
        $this->lang = $lng;
        $this->messages = $_;
    }

    public function setError(string $code){
		http_response_code($code);
        $this->er_code = $code;
        $this->er_msg = $this->getMessage($code);
    }

    private function getMessage($code){
        return $this->messages[$code]['message'] ?? $code;
    }

	public function write(string $message, string $sender='Application', string $status = 'info'): void {
		$log = "[" . date("Y-m-d H:i:s") . "] - " . "Module: ".$sender." :: " . $status . " || " . $message . PHP_EOL;
		self::file_force_contents($this->log_file, $log);
	}

	private static function file_force_contents($dir, $contents){
		$parts = explode('/', $dir);
		$file = array_pop($parts);
		$dir = '';
		foreach($parts as $part)
			if(!is_dir($dir .= "/$part")) mkdir($dir, 0777);
		file_put_contents("$dir/$file", $contents, FILE_APPEND);
    }
}
