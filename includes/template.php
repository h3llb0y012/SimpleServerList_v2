<?php

class template {
	private $dir = "templates/",
			$vars = array();

	public function __construct($dir = null)
	{
		if ($dir)
			$this->dir = $dir;
	}

	public function assignVars($vars = array())
	{
		foreach ($vars as $var => $value) {
			$this->vars[$var] = $value;
		}
	}

	public function get($index)
	{
		return $this->vars[$index];
	}

	public function render($file)
	{
		if (file_exists($this->dir . $file . '.php'))
			include($this->dir . $file . '.php');
		else
			exit('error loading template');
	}
}

?>