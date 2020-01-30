<?php

class Controller extends Input
{
    public function __construct()
    {
        parent::__construct();
        $this->create = self::create();
        $this->memory = self::memory();
    }

    public function memory()
    {
        if ((isset($_SESSION['operator'])) && (!isset($_SESSION['number'])) && (isset($_SESSION['operator_m'])) && (isset($_SESSION['number_m']))) {
            $_SESSION['operator_m'] = $_SESSION['operator'];
        } elseif ((isset($_SESSION['operator'])) && (isset($_SESSION['number'])) && (isset($_SESSION['operator_m'])) && (isset($_SESSION['number_m']))) {
            $_SESSION['number_m'] = self::countMethods($_SESSION['number_m'], $_SESSION['operator_m'], $_SESSION['number']);
            $_SESSION['operator_m'] = $_SESSION['operator'];
            unset($_SESSION['number']);
        } elseif ((isset($_SESSION['number_m'])) && (isset($_SESSION['operator_m'])) && (parent::isOperatorClick($_SESSION['operator_m']))) {
            $_SESSION['number_m'] = self::countMethods($_SESSION['number_m'], $_SESSION['operator_m'], $_SESSION['number_m']);
        } elseif ((isset($_SESSION['number'])) && (isset($_SESSION['operator']))) {
            $_SESSION['number_m'] = $_SESSION['number'];
            $_SESSION['operator_m'] = $_SESSION['operator'];
            unset($_SESSION['number']);
        } elseif ((!isset($_SESSION['operator'])) && (isset($_SESSION['number'])) && (isset($_SESSION['operator_m'])) && (isset($_SESSION['number_m']))) {

        }
        unset($_SESSION['operator']);
    }

    //Show methods
    public function showNumber()
    {
        return (isset($_SESSION['number'])) ? str_replace(".", ",", $_SESSION['number']) : 0;
    }

    public function showNumberMemory()
    {
        return (isset($_SESSION['number_m'])) ? $_SESSION['number_m'] : 0;
    }

    public function showOperatorMemory()
    {
        if (isset($_SESSION['operator_m'])) {
            $operator = $_SESSION['operator_m'];
            if (($operator == 'o') || ($operator == 'p') || ($operator == '=')) {
                $operator = null;
            }
            return $operator;
        }
    }

    public function showStatement()
    {
        return (isset($_SESSION['statement'])) ? $_SESSION['statement'] : null;
    }

    public function create()
    {
        if (parent::isNumber()) {
            $object = new Input;
            $object = $object->number();
            return $_SESSION['number'] = $object;
        } elseif (parent::isOperator()) {
            return $_SESSION['operator'] = $this->character;
        } elseif (parent::isClear()) {
            session_unset();
        }
    }

    public function countMethods($argOne, $operator, $argTwo)
    {
        switch ($operator) {
            case '+':
                return $argOne + $argTwo;
                break;
            case '-':
                return $argOne - $argTwo;
                break;
            case '*':
                return $argOne * $argTwo;
                break;
            case '/':
                if (($argOne == 0) || ($argTwo == 0)) {
                    $_SESSION['statement'] = 'Niepoprawne dane wejściowe: dzielenie przez zero!';
                    return 0;
                } else {
                    return $argOne / $argTwo;
                }
                break;
            case '%':
                if (($argOne == 0) || ($argTwo == 0)) {
                    $_SESSION['statement'] = 'Niepoprawne dane wejściowe: zero!';
                    return 0;
                } else {
                    return ($argOne / $argTwo) * 100;
                }
                break;
            case 'o':
                return sqrt($argOne);
                break;
            case 'p':
                return $argOne * $argTwo;
                break;
            default:
                return false;
        }
        return false;
    }

    public function postRedirect()
    {
        if (isset($_POST['character'])) {
            $_POST = null;
            // POST-REDIRECT:
            header('Location: index.php');
            exit();
        }
    }
}
