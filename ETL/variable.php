<?php
class myclass
{
	static $new;
	public function __construct()
	{
		
		$this->new ="this is me";
		
	}
	public function another()
	{
	$dd = $this->new;
	echo $dd;
	}
}
$ob = new myclass;
$ob->another();
?>
