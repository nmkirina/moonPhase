<?php

class MoonPhaze {
    
    const START_YEAR = 2001;
    const START_MOON_YEAR_NUMBER = 1;
    const MOON_DAY_STEP = 11;
    const MOON_MONTH = 30;
    const MOON_PHASE_COUNT = 8;
    
    public $year;
    public $month;
    public $day;    
    public $error;
    private $dateArray;
    private $moonYearNumber;
    private $moonAge;

    private function explodeDate ($date){
        $this->dateArray = explode('/', $date);
    }
    
    private function validation(){
        
        if ((isset($this->dateArray[0])) && (isset($this->dateArray[1])) && (isset($this->dateArray[2]))) {
            return true;
        } 
        
        $this->error();
        return false;
    }

    private function error (){
        $this->error = true;
        session_start();
        session_unset();
        $_SESSION['error'] = true;
        $_SESSION['error_message'] = 'Неверные данные';
        
    }

    private function calculateMoonYearNumber () {
        
        if (self::START_YEAR == $this->year) { return self::START_MOON_YEAR_NUMBER; }
        
        $n = $this->year - self::START_YEAR;
        if ($n > 0) {
            $moonYearNumber = self::START_MOON_YEAR_NUMBER + $n * self::MOON_DAY_STEP;
            while ($moonYearNumber > self::MOON_MONTH) {
                $moonYearNumber -= self::MOON_MONTH;
            }
        } else {
                $moonYearNumber = self::MOON_MONTH + self::START_MOON_YEAR_NUMBER;
                $moonYearNumber += self::MOON_DAY_STEP * $n;
                while ($moonYearNumber < 0) {
                    $moonYearNumber = self::MOON_MONTH + $moonYearNumber;
                }
        }
        return $moonYearNumber;
    }
    
    private function calculateMoonAge () {
        $moonAge = $this->day + $this->month + $this->moonYearNumber;
        while ($moonAge > 30){
            $moonAge -= self::MOON_MONTH;
        }
        return $moonAge;
    }
    
    public function find() {
        $step = self::MOON_MONTH / self::MOON_PHASE_COUNT;
        $phaseArray[0] = 0;
        for($i = 1; $i <= self::MOON_PHASE_COUNT; $i++) {
            $phaseArray[] = $phaseArray[$i - 1] + $step;
            if (($phaseArray[$i - 1] <= $this->moonAge) && 
                ($this->moonAge <= $phaseArray[$i])){
                return $i;
            }
        }
    }
    
    public function __construct($date) {
        $this->explodeDate($date);
        $this->error = false;
        if ($this->validation()){
            $this->month = $this->dateArray[0];
            $this->day = $this->dateArray[1];
            $this->year = $this->dateArray[2];
            $this->moonYearNumber = $this->calculateMoonYearNumber();
            $this->moonAge = $this->calculateMoonAge();
        } 
    }
}

