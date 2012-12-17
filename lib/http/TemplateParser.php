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
        $compiledTemplateFile = new File();
        $compiledTemplateFile->setFilePath($this->getTemplate()->getCompileDir());
        $compiledTemplateFile->setFileName(md5($this->getTemplate()->getTemplateFile()));
        $compiledTemplateFile->setFileExt('php');
        if (1 or File::readLastModifyTime($this->getTemplate()->getTemplateFile()) 
                > $compiledTemplateFile->getLastModifyTime())
        {
            $compiledTemplateFile = $this->_convertTags($content);    
        }
        else
        {
            $compiledTemplateFile = $compiledTemplateFile->getFileFullPath();    
        }
        
        return $this->_renderCompileTempate($compiledTemplateFile, $this->getTemplate()->getAssignments());
    }

    public function parseLayout($file, $data)
    {
        // BIOS::importClass(BIOS::$_basicModules['File']);
        $this->getTemplate()->assign('content', $data);
        $templateFile = new File();
        $templateFile->open($file);
        $content = $templateFile->readContent();
        $templateFile->close();
        $compiledTemplateFile = new File();
        $compiledTemplateFile->setFilePath($this->getTemplate()->getCompileDir());
        $compiledTemplateFile->setFileName(md5($file));
        $compiledTemplateFile->setFileExt('php');
        if (1 or File::readLastModifyTime($file) 
                > $compiledTemplateFile->getLastModifyTime())
        {
            $compiledTemplateFile = $this->_convertLayoutTags($content);    
        }
        else
        {
            $compiledTemplateFile = $compiledTemplateFile->getFileFullPath();    
        }
        
        return $this->_renderCompileTempate($compiledTemplateFile, $this->getTemplate()->getAssignments());
    }
	
	
	private function _renderCompileTempate($compiledTemplateFile,$data)
	{
		if(!empty($data))
		{
			extract($data);
		}
		ob_start();
		require ($compiledTemplateFile);
		$html = ob_get_clean();
		return $html;
	}

    private function _convertLayoutTags($content)
    {
        $compiledTemplate = new File();
        $compiledTemplate->setFilePath($this->getTemplate()->getCompileDir());
        $compiledTemplate->setFileName(md5($this->getTemplate()->getTemplateFile()));
        $compiledTemplate->setFileExt('php');
        
        
        $tags = array(
            '/{assign:(\D\w+)\s+(.+)\/}/' => '<?php call_user_func(array("Template", "$1"),"$2");?>',
            '/{files\s+[\'"](.+)[\'"]\s?\/}/' => '<?php call_user_func(array("Template", "file"), "$1");?>',
            '/{\$/' => '{echo $',
		    '/(\$.+)\.(\w+)/' => "$1['$2']",
			'/{/' => '<?php ',
            '/}/' => '?>',
        );

        foreach($tags as $tag => $phpv)
        {
            $content = preg_replace($tag, $phpv, $content);
        }
        
       $compiledTemplate->setFileSize(strlen($content));
       $compiledTemplate->overwrite($content);
        
        return $compiledTemplate->getFileFullPath();

    }

    private function _convertTags($content)
    {
		$compiledTemplate = new File();
		$compiledTemplate->setFilePath($this->getTemplate()->getCompileDir());
		$compiledTemplate->setFileName(md5($this->getTemplate()->getTemplateFile()));
		$compiledTemplate->setFileExt('php');
		
		
        $tags = array(
            '/{assign:(\D\w+)\s+(.+)\/}/' => '<?php call_user_func(array("Template", "$1"),"$2");?>',
			'/{files\s+[\'"](.+)[\'"]\s?\/}/' => '<?php call_user_func(array("Template", "files"), "$1");?>',
		  	'/{ext:(\D\w+\s+.+)\/}/' => "{ext:$1}",
		  	'/{ext:(\D\w+)\s+(.+)}/' => "<?php call_user_func(array('InlineEvent', 'extenalApi'), array('$1', '$2'));?>",
            '/neq/' => '!=',
            '/eq/' => '==',
			'/gt/' => '>',
			'/lt/' => '<',
		  	'/{loop\s+data=(\$\D\w+)\s+item=(\D\w+)}/' => '<?php if (is_array($1)) foreach ($1 as $$2):?>',
		  	'/\/loop/' => ' endforeach;',
            '/{if\s(.+)}/' => '<?php if ($1):?>',
			'/{else}/' => '<?php else:?>',
            '/\/if/' => 'endif;',
            '/{\$/' => '{echo $',
			'/(\$\w+)\.(\w+)/' => "$1['$2']",
			'/{/' => '<?php ',
            '/}/' => '?>',
        );

        foreach($tags as $tag => $phpv)
        {
           $content = preg_replace($tag, $phpv, $content);
        }
			
	   $compiledTemplate->setFileSize(strlen($content));
	   $compiledTemplate->overwrite($content);
		
        return $compiledTemplate->getFileFullPath();
    }

}