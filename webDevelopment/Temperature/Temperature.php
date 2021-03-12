<?php
//Initializes the class
class Temperature 
{
	//Declaration of global variables
	public $celsiusTemp;
	public $fahrenTemp;
	public $kelvinTemp;
	
	//Allows the user to take in an inital temperature and a type(C for Celsius, K for Kelvin, and F for Fahrenheit
    public function Temperature($temp, $type)
	{
		switch($type)
		{
			case 'C':
			{
				$this->celsiusTemp = $temp;
				$this->fahrenTemp = ($this->celsiusTemp * 9/5) + 32;
				$this->kelvinTemp = ($this->celsiusTemp + 273.15);
				break;
			}
			
			case 'K':
			{
				$this->kelvinTemp = $temp;
				$this->celsiusTemp = ($this->kelvinTemp - 273.15);
				$this->fahrenTemp = ($this->kelvinTemp - 273.15) * 9/5 + 32;
				break;
			}
			
			case 'F':
			{
				$this->fahrenTemp = $temp;
				$this->celsiusTemp = ($this->fahrenTemp - 32) * 5/9;
				$this->kelvinTemp = ($this->fahrenTemp - 32) * 5/9 + 273.15;
				break;
			}
			
			default:
			{
				echo "Invalid type specified.";
				break;
			}
		}
		
	}
	
	//Takes in a interval to alter the temperature and the type it's incrementing
    public function incrementTemp($tempAlter, $type)
	{
		switch($type)
		{
			case 'C':
			{
				$this->celsiusTemp = ($this->celsiusTemp) + $tempAlter;
				$this->fahrenTemp = ($this->celsiusTemp * 9/5) + 32;
				$this->kelvinTemp = ($this->celsiusTemp + 273.15);
				break;
			}
			
			case 'K': 
			{
				$this->kelvinTemp = ($this->kelvinTemp) + $tempAlter;
				$this->celsiusTemp = ($this->kelvinTemp - 273.15);
				$this->fahrenTemp = ($this->kelvinTemp - 273.15) * 9/5 + 32;
				break;
			}
			
			case 'F':
			{
				$this->fahrenTemp = ($this->fahrenTemp) + $tempAlter;
				$this->celsiusTemp = ($this->fahrenTemp - 32) * 5/9;
				$this->kelvinTemp = ($this->fahrenTemp - 32) * 5/9 + 273.15;
				break;
			}
			
			default:
			{
				echo "Invalid type specified.";
				break;
			}
		}
	}
	
	//Return number values formatted to two decimal places
	public function getCelsius()
	{
		$celsiusFormat = (round($this->celsiusTemp, 2));
		return $this->celsiusTemp;
	}
	
	//Return number values formatted to two decimal places
	public function getFahren()
	{
		$fahrenFormat = (round($this->fahrenTemp, 2));
		return $this->fahrenTemp;
	}
	
	//Return number values formatted to two decimal places
	public function getKelvin()
	{
	    $kelvinFormat = (round($this->kelvinTemp, 2));
		return $this->kelvinTemp;
	}
	
	//Checks if the current temperature is at or above the boiling point
	public function isBoiling()
	{
		if($this->celsiusTemp >= 100)
		{
			return "True";
		}else{
			return "False";
		}
	}
	
	//Checks if the current temperature is at or below the freezing point
	public function isFreezing()
	{
	    if($this->celsiusTemp <= 0)
		{
			return "True";
		}else{
			return "False";
		}
	}
}
?>