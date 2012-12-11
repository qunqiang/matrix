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

        $content = $this->_convertTags($content);

        var_dump($content);
    }

    private function _convertTags($content)
    {
        $tags = array(
            '/neq/' => '!=',
            '/eq/' => '==',
            '/{if\s(.+)}/' => '<?php if ($1):?>',
            '/\/if/' => 'endif;',
            '/{\$/' => '{echo $',
            '/{/' => '<?php ',
            '/}/' => '?>',
            '/\.(\w+)/' => "['$1']",
        

        );

        foreach($tags as $tag => $phpv)
        {
            var_dump($tag, $phpv);
            $content = preg_replace($tag, $phpv, $content);
        }
        return htmlspecialchars($content);
    }

}