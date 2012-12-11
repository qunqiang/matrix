<?php
class File
{
    
    private $_filePath;
    private $_fileName;
    private $_fileExt;
    private $_fileSize;

    private $_fp;

    public function setFp($fp)
    {
        $this->_fp = $fp;
    }
    public function getFp()
    {
        return $this->_fp;
    }

    public function setFilePath($filePath)
    {
        $this->_filePath = $filePath;
    }
    public function getFilePath()
    {
        return $this->_filePath;
    }

    public function setFileName($fileName)
    {
        $this->_fileName = $fileName;
    }
    public function getFileName()
    {
        return $this->_fileName;
    }

    public function setFileExt($fileExt)
    {
        $this->_fileExt = $fileExt;
    }
    public function getFileExt()
    {
        return $this->_fileExt;
    }

    public function setFileSize($fileSize)
    {
        $this->_fileSize = $fileSize;
    }
    public function getFileSize()
    {
        return $this->_fileSize;
    }

    public function open($uri = '')
    {
        if (file_exists($uri))
        {
            $fp = fopen($uri, 'r');
            if (is_resource($fp))
            {
                $this->setFp($fp);
                return true;
            }
            else
            {
                return null;
            }
        }
    }

    public function readContent()
    {
        $content = '';
        if ($this->getFp())
        {
            while ($line = fgets($this->getFp(), 1024))
            {
                $content .= $line;
            }    
        }
        return $content;
    }

    public function close()
    {
        if (is_resource($this->getFp()))
        {
            fclose($this->getFp());
        }
        else
        {
            BIOS::raise('NullPointer');
        }
    }



}