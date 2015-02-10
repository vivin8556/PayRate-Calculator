<?php
$str = "this is me";
if(preg_match('/is/i',$GLOBALS['str'],$st)){
	foreach($st as $key=>$value)
	{
		echo $key.'->'.$value;
	}
}
else{
	echo "bad expression";
}
?>