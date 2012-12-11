<?php
class NullPointerException extends Signal
{
    public $message = 'Null Pointer';
    public $code     = 500;

    public function __toString()
    {
        return $this->getCode() . ' ' .$this->getMessage();
    }

}