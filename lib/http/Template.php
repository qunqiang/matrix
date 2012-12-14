<?php
class Template
{
	static $template;
	private $_file;
	private $_templateFile;
	private $_tpl;
	private $_vars;
	private $_layout;
	private $_cacheDir;
	private $_compileDir;
	private $_delimiter_left = '{';
	private $_delimiter_right = '}';
	
	private function Template()
	{
	}

	public function setTpl($tpl)
	{
		$this->_tpl = $tpl;
	}
	public function getTpl()
	{
		return $this->_tpl;
	}

	public function getLayoutPath()
	{
		return APP  . 'views' . DS . 'layouts' . DS;
	}

	public function setTemplateFile($templateFile)
	{
		$this->_templateFile = $templateFile;
	}
	public function getTemplateFile()
	{
		return $this->_templateFile;
	}

	public function setCacheDir($cacheDirPath)
	{
		$this->_cacheDir = $cacheDirPath;
	}
	public function getCacheDir()
	{
		return $this->_cacheDir;
	}

	public function setCompileDir($compileDirPath)
	{
		$this->_compileDir = $compileDirPath;
	}
	public function getCompileDir()
	{
		$templateConfig = BIOS::activeOS()->getConf('base.runtime.template');
		if (empty($templateConfig) && empty($this->_compileDir))
		{
			BIOS::raise('EmptyPath');
		}
		return $this->_compileDir ? $this->_compileDir : $templateConfig['compileDir'];
	}

	public function setDelimiterLeft($delimiterLeft)
	{
		$this->_delimiter_left = $delimiterLeft;
	}
	public function getDelimiterLeft()
	{
		return $this->_delimiter_left;
	}

	public function setDelimiterRight($delimiterRight)
	{
		$this->_delimiter_right = $delimiterRight;
	}
	public function getDelimiterRight()
	{
		return $this->_delimiter_right;
	}
	
	public function initView()
	{
		if (!self::$template)
		{
			self::$template = new Template;
		}
		return self::$template;
	}

	public function setLayout($layout)
	{
		$this->_layout = $layout;
	}
	public function getLayout()
	{
		return $this->_layout;
	}

	public function assign($key, $value)
	{
		return $this->_addVar($key, $value);
	}

	public function isAlreadyAssigned($key)
	{
		$vars = $this->getAssignments();
		if (isset($var[$key]))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function display($tpl = '')
	{
		$html = $this->render($tpl);
		echo $html;

	}
	
	public function render($tpl)
	{
		$html = '';
		$tkey = '';
		if ($templateFile = $this->_checkTemplate($tpl))
		{
			$html = $this->_compile($templateFile, $this->getAssignments());
		}
		
		return $html;
		
	}
	
	private function _addVar($key, $value)
	{
		$vars = $this->getAssignments();
		$vars[$key] = $value;
		$this->setAssignments($vars);
		return true;
	}

	public function setAssignments($vars)
	{
		$this->_vars = $vars;
	}

	public function getAssignments()
	{
		return $this->_vars;
	}
	
	private function _checkTemplate($tpl)
	{
		// check template file for exsiting
		$request = HttpEvent::getRequest();
		return $this->getTemplatePath($request, $tpl);
	}

	public static function getInfo($args)
	{
		$infoName = '';
		if (empty($args))
		{
			BIOS::raise('InvalidParameter');
		}
		$infoName = $args;
		$template = self::initView();
		echo call_user_func(array('File', 'read'.ucfirst($infoName)), $template->getTemplateFile());
		// return $template->getFile()->getLastModifyTime();
	}

	public function getTemplatePath($request, $tpl = '')
	{
		$templatePath = APP.'views' .DS;
		if ($request->getController())
		{
			$templatePath .= BIOS::initComponent('WebTool')->trimController($request->getController());
			$templatePath .= DS;
		}

		if (empty($tpl))
		{
			$tpl = BIOS::initComponent('WebTool')->trimAction($request->getAction());
		}

		$this->setTpl($tpl);
		$templatePath .= $tpl . '.html';
		$this->setTemplateFile($templatePath);
		return $templatePath;
	}
	
	private function _compile($tpl, $data)
	{

		$content = $this->_getParser()->parse($tpl);
		if (!empty($data))
		{
			extract($data);
		}
		if ($this->getLayout())
		{
			ob_start();
			$path = $this->getLayoutPath();
			$layoutFile = $path . $this->getLayout() . '.html';
			// $html = $this->_getParser()->parseLayout($layoutFile);
			// echo $html;
			require($layoutFile);
			$html = ob_get_clean();
			echo '<pre>';
			echo (htmlspecialchars($html));
			exit;
		}
		else
		{
			$html = $content;
		}
		
		return $html;
	}

	private function _getParser()
	{
		return TemplateParser::init($this);
	}


	

}