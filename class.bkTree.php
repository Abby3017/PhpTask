<?php
class BkTree
{
    public $word;
    public $members;//=array();

    public function __construct($word)
    {
	$this->word = $word;
    }

    public function build(array $words)
    {

	foreach($words as $word)
	{
	    $this->addTerm($word);
	}
	
    }
    
    public function addTerm($t)
    {
     $d = levenshtein($this->word, $t);
	if ($this->members[$d]) 
	{
		$this->members[$d]->addTerm($t);
	}
	else $this->members[$d] = new BkTree($t);
    }
    
    public function disp()
    {
    	print_r($this->members);
    }


    public function query($t, $l, $d=false, $r=false)
    {
	if (!$r) $r = new stdClass();
	$cd = levenshtein($this->word, $t);
	if ( $cd <= $l and $cd > 0 ) $r->matches[] = $this->word;
	if (!$d) $d = levenshtein($t, $this->word);
	for($i=$d-$l; $i<=$d+$l; $i++)
	{
	    if (isset($this->members[$i])) $this->members[$i]->query($t, $l, $d, $r);
	}
	return $r;
    }
}

?>