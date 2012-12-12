<?php
class TemplateParser
{
    private $_template;
    static $parser;
    

    private function TemplateParser($template)
    {
        $this->setTemplate($template);
    }

    public static function init($template)
    {
        if (!self::$parser)
        {
            self::$parser = new TemplateParser($template);
        }
        return self::$parser;
    }

    public function setTemplate($template)
    {
        $this->_template = $template;
    }

    public function getTemplate()
    {
        return $this->_template;
    }

    public function parse()
    {
        // BIOS::importClass(BIOS::$_basicModules['File']);
        $templateFile = new File();
        $templateFile->open($this->getTemplate()->getTemplateFile());
        $content = $templateFile->readContent();
        $templateFile->close();

        $compiledTemplateFile = $this->_convertTags($content);
		
		return $this->_renderCompileTempate($compiledTemplateFile, $this->getTemplate()->getAssignments());
    }
	
	
	private function _renderCompileTempate($compiledTemplateFile,$data)
	{
		extract($data);
		ob_start();
		require ($compiledTemplateFile);
		$html = ob_get_clean();
		return $html;
	}

    private function _convertTags($content)
    {
        $tags = array(
            '/neq/' => '!=',
            '/eq/' => '==',
			'/{loop\s+data=(\$\D\w+)\s+item=(\D\w+)}/' => '<?php if (is_array($1)) foreach ($1 as $$2):?>',
			'/\/loop/' => ' endforeach;',
            '/{if\s(.+)}/' => '<?php if ($1):?>',
            '/\/if/' => 'endif;',
            '/{\$/' => '{echo $',
            '/{/' => '<?php ',
            '/}/' => '?>',
            '/\.(\w+)/' => "['$1']",
        );

        foreach($tags as $tag => $phpv)
        {
            $content = preg_replace($tag, $phpv, $content);
        }
		
		$compiledTemplate = new File();
		$compiledTemplate->setFilePath($this->getTemplate()->getCompileDir());
		$compiledTemplate->setFileName(md5($this->getTemplate()->getTemplateFile()));
		$compiledTemplate->setFileExt('php');
		$compiledTemplate->setFileSize(strlen($content));
		$compiledTemplate->overwrite($content);
		
        return $compiledTemplate->getFileFullPath();
    }

}