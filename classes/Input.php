<?php

class Input
{

    protected $character;
    protected $number;

    protected function __construct()
    {
        (self::isPostSet()) ? $this->character = $_POST['character'] : $this->character = null;
        (self::isSessionSet()) ? $this->number = $_SESSION['number'] : $this->number = null;
    }

    public function isPostSet()
    {
        return (isset($_POST['character'])) ? true : false;
    }

    public function isSessionSet()
    {
        return (isset($_SESSION['number'])) ? true : false;
    }

    protected function isNumber()
    {
        return (preg_match('/([0-9]|\.)/', $this->character)) ? true : false;
    }

    protected function isOperator()
    {
        return (preg_match('/(\+|\-|\*|\/|\=|\%|o|p)/', $this->character)) ? $this->character : false;
    }

    protected function isClear()
    {
        return (preg_match('/c/', $this->character)) ? true : false;
    }

    protected function isOperatorClick($character)
    {
        return (preg_match('/(o|p)/', $character)) ? $character : false;
    }

    private function isFloat()
    {
        return (strpos($this->number, '.')) ? true : false;
    }

    protected function number()
    {
        if (($this->character == '.') && (!$this->post_character)) {
            return $number = 0 . $this->character;
        } elseif (($this->character == '.') && (self::isFloat())) {
            return $number = $this->number;
        } else {
            return $number = $this->number . $this->character;
        }
    }

}
