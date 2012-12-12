<?php
class Template
{
	static $template;
	private $_templateFile;
	private $_vars;
	private $_layout;
	private $_cacheDir;
	private $_compileDir;
	private $_delimiter_left = '{';
	private $_delimiter_right = '}';
	
	private function Template()
	{

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

		$templatePath .= $tpl . '.html';
		$this->setTemplateFile($templatePath);
		return $templatePath;
	}
	
	private function _compile($tpl, $data)
	{

		$html = $this->_getParser()->parse($tpl);

		return $html;
	}

	private function _getParser()
	{
		return TemplateParser::init($this);
	}


	

}