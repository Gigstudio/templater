<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Document{
	private string $language = '';
	private string $title = '';
	private string $description = '';
	private string $keywords = '';
	private array $links = [];
	private array $css_styles = [];
	private array $inline_styles = [];
	private array $scripts = [];

	public function setLanguage(string $language): void {
		$this->language = $language;
	}

	public function getLanguage(): string {
		return $this->language;
	}

	public function setTitle(string $title): void {
		$this->title = $title;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function setDescription(string $description): void {
		$this->description = $description;
	}

	public function getDescription(): string {
		return $this->description;
	}

	public function setKeywords(string $keywords): void {
		$this->keywords = $keywords;
	}

	public function getKeywords(): string {
		return $this->keywords;
	}

	public function addScript($files){
		if(is_string($files)){
			$files = array($files);
		}
        foreach($files as $file){
        	$this->scripts[] = $file;
        }
	}

	public function getScript(): string{
	    $ins = '';
	    foreach($this->scripts as $file){
	        $path = PATH_ASSETS . 'js/' . $file;
	        if(file_exists($path)){
	            $src = HOME_URL . 'assets/js/' . $file;
	            $ins .= "&lt;script&nbsp;type=\"text/javascript\" src=\"$src\"&gt;&lt;/script&gt\n";
	        }
	    }
	    return $ins;
	}

	public function addStyle($files){
		if(is_string($files)){
			$files = array($files);
		}
        foreach($files as $file){
        	$this->css_styles[] = $file;
        }
	}

	public function getStyle(): string{
	    $ins = '';
	    foreach($this->css_styles as $file){
	        $path = PATH_ASSETS . $file;
	        if(file_exists($path)){
	            $src = 'assets/' . $file;
	            $ins .= "&lt;link href=\"$src\" rel=\"stylesheet\"&gt;\n";
	        }
	    }
	    return $ins;
	}

	public function addInlineStyle(array $css){
        foreach($css as $selector => $style){
        	$this->inline_styles[$selector] = $style;
        }
	}

	public function getInlineStyles(): string {
        $ins = '&lt;style type="text/css"&gt;';
        foreach($this->inline_styles as $selector => $style){
            $ins .= "$selector{\n";
            if(is_array($style)){
                foreach($style as $k => $v){
                    $ins .= "\t$k: $v;\n";
                }
            }
            $ins .= "}\n";
        }
        return $ins.'&lt;/style&gt;';
	}
}
