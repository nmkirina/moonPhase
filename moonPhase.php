<?php

class moonPhaze {
    
    const START_YEAR = 2001;
    const START_MOON_DAY = 1;
    const MOON_DAY_STEP = 11;
    const MOON_MONTH = 30;
    const MOON_PHASE_COUNT = 8;
    
    private $year;
    private $month;
    private $day;
    private $dateArray;
    private $moonDay;
    private $moonAge;

    public function __construct($date) {
        $this->explodeDate($date);
        $this->day = $this->dateArray[0];
        $this->month = $this->dateArray[1];
        $this->year = $this->dateArray[2];
        $this->moonDay = $this->calculateMoonDay();
        $this->moonAge = $this->calculateMoonAge();
    }
    
    private function explodeDate ($date){
        $this->dateArray = explode('-', $date);
    }
    
    private function calculateMoonDay () {
        
        $n = self::START_YEAR - $this->year;
        if ($n > 0) {
            $moonDay = self::START_MOON_DAY + $n * self::MOON_DAY_STEP;
            while ($moonDay > self::MOON_MONTH) {
                $moonDay -= self::MOON_MONTH;
            }
        } else {
                $moonDay = self::MOON_MONTH + self::START_MOON_DAY;
                $moonDay += self::MOON_DAY_STEP * $n;
                while ($moonDay < 0) {
                    $moonDay = self::MOON_MONTH - $moonDay;
                }
        }
        return $moonDay;
    }
    
    private function calculateMoonAge () {
        return $this->day + $this->month + $this->moonDay;
    }
    
    public function find() {
        $step = self::MOON_MONTH / self::MOON_PHASE_COUNT;
        $phaseArray[0] = 0;
        for($i = 1; $i < self::MOON_PHASE_COUNT; $i++) {
            $phaseArray[] = $phaseArray[$i - 1] + $step;
            if (($phaseArray[$i - 1] <= $this->moonAge) && 
                ($this->moonAge <= $phaseArray[$i])){
                return $i;
            }
        }
    }
}

