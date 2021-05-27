<?php
class Car{
    static $ile = 5;
    private $model;
    protected $cena;
    private $kurs;

    public function __construct($model, $cena, $kurs)
    {
        $this->model = $model;
        $this->cena = $cena;
        $this->kurs = $kurs;
    }


    public static function getIle()
    {
        return self::$ile;
    }

    public static function setIle($ile)
    {
        self::$ile = $ile;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getCena()
    {
        return $this->cena;
    }

    public function setCena($cena)
    {
        $this->cena = $cena;
    }

    public function getKurs()
    {
        return $this->kurs;
    }

    public function setKurs($kurs)
    {
        $this->kurs = $kurs;
    }

    function value(){
        return $this->getCena() * $this->getKurs() * Car::$ile;

    }
    public function __toString() {
        return "Model ". $this->model ." Cena ".$this->cena ." Kurs ".$this->kurs;
    }
}

class NewCar extends Car{
    private $alarm = false;
    private $radio = false;
    private $climatronic = false;

    public function __construct($model, $cena, $kurs, $alarm, $radio, $climatronic)
    {
        parent::__construct($model, $cena, $kurs);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->climatronic = $climatronic;
    }

    public function isAlarm()
    {
        return $this->alarm;
    }
    public function getCena()
    {
        return $this->cena;
    }

    public function setAlarm($alarm)
    {
        $this->alarm = $alarm;
    }

    public function isRadio()
    {
        return $this->radio;
    }

    public function setRadio($radio)
    {
        $this->radio = $radio;
    }

    public function isClimatronic()
    {
        return $this->climatronic;
    }

    public function setClimatronic($climatronic)
    {
        $this->climatronic = $climatronic;
    }


    public function value()
    {
        parent::value();
        if($this->alarm=="true"){$this->setCena($this->getCena() * 1.05);}
        if($this->radio=="true"){$this->setCena($this->getCena() * 1.075 );}
        if($this->climatronic=="true"){$this->setCena($this->getCena() * 1.10 );}

    }

    public function __toString() {
        return " Model ". $this->getModel() ." Cena ".$this->getCena() ." Kurs ".$this->getKurs().
            " Czy ma alarm " .$this->alarm ." Czy ma radio ". $this->radio .
            " Czy jest climatronic ". $this->climatronic;

    }

}
class InsuranceCar extends NewCar {
    private $firstOwner = false;
    private $years = 0;

    public function __construct($model, $cena, $kurs, $alarm, $radio, $climatronic, $firstOwner, $years)
    {
        parent::__construct($model, $cena, $kurs, $alarm, $radio, $climatronic);
        $this->firstOwner = $firstOwner;
        $this->years = $years;
    }

    public function getCena()
    {
        return $this->cena;
    }


    public function setCena($cena)
    {
        $this->$cena = $cena;
    }


    public function getFirstOwner()
    {
        return $this->firstOwner;
    }

    public function setFirstOwner($firstOwner)
    {
        $this->firstOwner = $firstOwner;
    }

    public function getYears()
    {
        return $this->years;
    }

    public function setYears($years)
    {
        $this->years = $years;
    }
    public function value()
    {
        parent::value();
        if($this->firstOwner=="true"){$this->setCena($this->getCena() * 0.95 );}
        $this->setCena($this->getCena() * (1 - ($this->getYears()) / 100));
        
    }
    public function __toString() {
        return " Model ". $this->getModel() ." Cena ".$this->getCena() ." Kurs ".$this->getKurs().
            " Czy ma alarm " . $this->isAlarm() ." Czy ma radio ". $this->isRadio() .
            " Czy jest climatronic ". $this->isClimatronic() . " Pierwszy właściciel " . $this->firstOwner .
            " Ile ma lat " . $this->years;
    }
}

$c1 = new Car("mercedes", 30, 4.5);
$nc1 = new NewCar("mercedes", 30, 5, "true", "true", "false" );
$nc1->value(). "\n";
echo $nc1 . "\n";
echo "Wartość " . $nc1->getCena() * $nc1->getKurs() * Car::$ile. "\n";
$ic = new InsuranceCar("bmw", 30, 5, "true", "true", "false", "true", 5);
$ic->value(). "\n";
echo $ic. "\n";
echo "Wartość " . $ic->getCena() * $ic->getKurs() * Car::$ile. "\n";

?>