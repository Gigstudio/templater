<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Errorhandler{
    public const EL_INFO = 0;
    public const EL_WARN = 1;
    public const EL_FATAL = 2;
    public const EL_SUPRESS = 5;

    public int $log_lvl = self::EL_WARN;
    private string $log_file;
	public bool $error_display;
	public string $error_page_path = PATH_VIEWS . 'errors';

    public string $er_code;
    public string $er_msg;
    public array $params = [];
    public array $messages;
    public string $lang = 'ru';

    public function __construct(){
        $this->log_file = PATH_LOGS . 'log_' . date("Y-m-d") . '.log';
        $this->error_display = ENVIRONMENT == 'development';
        $this->setLang('ru');
        $this->set_handler();
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
				$this->write($file, $message, $error);
			// }

			if ($this->error_display) {
				$msg = '<b>' . $error . '</b>: ' . $message . ' in <b>' . $file . '</b> on line <b>' . $line . '</b>';
				// Application::$app->session->setFlash($error, $msg, 'dynamic');
				echo $msg.'<br>';
			} else {
				// header('Location: ' . $this->error_page);
				// die();
			}
		});

		// Exception Handler
		set_exception_handler(function(\Throwable $e) {
            $this->setError($e->getCode());
			// if ($this->error_log) {
				$this->write($e->getFile(), $e->getMessage(), get_class($e));
			// }

			if ($this->error_display) {
				$msg = '<b>' . $e->getCode() . '</b>: ' . $e->getMessage() . ' in <b>' . $e->getFile() . '</b> on line <b>' . $e->getLine() . '</b>';
				// Application::$app->session->setFlash($e->getCode(), $msg, 'dynamic');
				echo $msg.'<br>';
			} else {
				// header('Location: ' . $this->error_page_path);
				// die();
			}
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
        return $this->messages[$code] ?? $code;
    }

    public function display(){

    }

    public function log(){
        
    }

	public function write(string $sender='Application', string $message, string $status = 'info'): void {
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
