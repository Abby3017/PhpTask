<?php

class Prime {
	public $_low;
	public $_high;
	private $_data=array(); 

	public function setLow($p)
	{
		if(!is_numeric($p) || $p<= 0 )
			throw new Exception ("invalid number");
		$this->_low=$p;
	}

	public function setHigh($p)
	{
		if(!is_numeric($p) || $p <= 0 )
			throw new Exception ("invalid number");
		$this->_high= $p;
	}

	private function Sieve($limit)
	{
		$prime=array();
		$mark=array_fill(0, $limit, true);
		for($i=2;$i*$i<$limit;$i++)
		{
			if($mark[$i] == true)
			{
				for($p=$i*2;$p<$limit;$p+=$i)
					$mark[$p]=false;
			}
		}

		for($i=2;$i<$limit;$i++)
		{
			if ($mark[$i] == true)
			array_push($prime, $i);
		}
		return $prime;
	}

	public function calcPrime()
	{
		$limit = floor(sqrt($this->_high)) + 1;
		//echo $this->_low.PHP_EOL;
		//echo $this->_high.PHP_EOL;
		//echo $limit.PHP_EOL;
		$prime=$this->Sieve($limit,$prime);
		//print_r($prime);
		//echo count($prime).PHP_EOL;
		$low = $limit;
		$high = 2 * $limit;
		while($low < $this->_high)
		{
			$mark=array_fill(0, $limit+1, true);

			for( $i=0; $i<count($prime); $i++)
			{
				$loLim = floor($low/$prime[$i]) * $prime[$i]; //find min number in range low and high that is divisible by prime[i]
				if($loLim < $low )
					$loLim += $prime[$i];
				for($j=$loLim;$j < $high;$j += $prime[$i])
					$mark[$j-$low]=false;
			}
			for($i = $low; $i < $high;$i++)
				if($mark[$i-$low] == true)
				array_push($this->_data, $i);
			$low = $low + $limit;
			$high = $high + $limit;
			if($high >= $this->_high)
				$high = $this->_high;
		}
		//array_push($this->_data, $prime);
		//array_unshift($this->_data, $prime);
		for($k=count($prime)-1;$k>=0;$k--)
		{
			array_unshift($this->_data, $prime[$k]);
		}
	}

	public function getPrime()
	{
		return $this->_data;
	}


}

?>