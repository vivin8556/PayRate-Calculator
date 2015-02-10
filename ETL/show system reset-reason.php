<?php
class logAnalyser
{
/* create a member variable for getting database connection from dbConnection.php.
member variable can access all function. */
	static $database;
	public function __construct()
	{
		//get database connection from "dbConnection.php"
			require("logFile/dbConnection.php");
			$this->database = $object->connection;
			/* check database connection. if the program having database connection the "mds_system" Table
			created from "ciscoaudit" database. */
				if($this->database)
				{
				// the "$sql" variable stored sql query for creating table.
					$sql  = "CREATE TABLE IF NOT EXISTS `mds_system`(
							systemId bigint(20) NOT NULL auto_increment,
							systemLogDate date DEFAULT NULL,
							systemSiteKey varchar(100) NOT NULL,
							systemModule varchar(50) DEFAULT NULL,
							systemSlot varchar(50) DEFAULT NULL,
							systemTime varchar(250) DEFAULT NULL,
							systemReason varchar(300) DEFAULT NULL,
							systemService varchar(250)DEFAULT NULL,
							systemVersion varchar(50) DEFAULT NULL,
							#systemStartTime varchar(200) DEFAULT NULL,
							#systemUpTime varchar(200) DEFAULT NULL,
							#systemKernelUpTime varchar(200) DEFAULT NULL,
							PRIMARY KEY (systemId)
							)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;";
					mysqli_query($this->database,$sql);
				}
				else
				{
					echo "failed";
				}
	}
	public function showSystemResetReason(){
			/* get the 20150119_12_49_58-hqsan8-techsupport.txt from local directory 
			using "fopen()" function and stored into $fileOpen variable */
				$fileOpen = fopen("logFile/20150119_12_49_58-hqsan8-techsupport.txt","r");
				$output = fopen("logFile/output.txt","w+");
			//get siteKey from filename using "sha1()" function.
				$siteKey = sha1("20150119_12_49_58-hqsan8-techsupport.txt");
			/* want to check `show system reset-reason` line by line, so we are using
			"fgets()" function. the fgets() function check the string line by line through
			while loop. */

			while(!feof($fileOpen))
			{
				
				//get the string and stored into $getValue property
					$filePointer = fgets($fileOpen);
				/* Check whether the property holds "`show system reset-reason`" or not if
				the property holds the particular string */
				if(preg_match('/(`show system reset-reason`)/i',$filePointer))
				{
					$module= '';
					$slot= '';
					$time = '';
					$Reason = '';
					$Service = '';
					$Version = '';
					$Write = '';
					$data = $this->database;	
					/*if the preg_match function match the string value the condition is true.
					then again looping for get the particular value */
					while(!feof($fileOpen))
					{
						// read the line by line after preg_match() function true.
						$filePointer = fgets($fileOpen);	
						/* then check the condition using preg_match() function for get the modules and slot value
						after getting the value, the value stored into array(). */
						if(preg_match('/(module\s*(\d+))(.*?)(slot\s*(\d+))/i',$filePointer,$str))
						{
							//getting the value from array() and stored into $module_slot property.
							//print_r() function for print the array() value.
							// print_r($str);
							$module = trim($str[1]);
							$slot = trim($str[4]);
							// echo $module.'<br/>';
						}
						 else if(preg_match('/(No\s+\w+\n)|(At\s+.*)/i',$filePointer,$times))
						 {
							$time = trim($times[0]);
							// echo $time."<br/>";
						 }
						else if(preg_match('/Reason:(\s+\w+.*\b)/i',$filePointer,$reasons))
						{
						 	$Reason = trim($reasons[1]);
						 	// echo $Reason."<br/>";	
						}
						
						 else if(preg_match('/Service:(.*)/i',$filePointer,$service))
						 {
						 	$Service = trim($service[1]);
						 	// echo $Service."<br/>";	
						 }
						
						 else if(preg_match('/Version:(.*)/i',$filePointer,$ver))
						 {
						 	$Version = "V-".trim($ver[1]);
						 	// echo $Version."<br/>"."<br/>";
						 	/* check in this program having database connection. if the program having database connection
						 	the values stored in "ciscoaudit" database. */
						 	if($data)
						 	{
						 	//the fetching value stored into "$insert" variable using the sql query.	
						 	$insert = "INSERT INTO mds_system
						 				#(`systemId`,`systemLogDate`,`systemSiteKey`,`systemModule,systemSlot`,`systemTime`,`systemReason`,`systemService`,`systemVersion`,`systemStartTime`,`systemUpTime`,`systemKernelUpTime`)
										VALUES('','$logDate','$siteKey','$module','$slot','$time','$Reason','$Service','$Version');";
							// after storing the value into variable that value push to databse using "mysqli_query()" function.
							mysqli_query($data,$insert);
							}
							/* check in this program having database connection or not, the program not having database connection
							the "if($database)" condition false, so the condition directly comes to else part then the value re-write
							into output.txt file using "fwrite()" function. */
							else
							{
								//the value re-write into "output.txt" file.
								$Write = $logDate.$module.",".$slot.",".$time.",".$Reason.",".$Service.",".$Version.",";
								$Write.= "\r\n";
								fwrite($output, $Write);
							}
						 }
						 else if(preg_match('/`/i',$filePointer))
						{
							break;
						}
					}
				}
				else if(preg_match('/^(`show clock`)/i',$filePointer))
				{			
					while(!feof($fileOpen))
					{
						$filePointer =fgets($fileOpen);
						#12:50:00.879 CST Mon Jan 19 2015
						if(preg_match('/([0-9]*:[0-9]*:[0-9]*\.[0-9]*.*)/i',$filePointer,$date))
						{
							$tempDate = strtotime($date[0]);
							$logDate = date("Y-m-d",$tempDate);
							break;			
				
						}
					}
				}
			
				else if(preg_match('/(`show system uptime`)/i',$filePointer))
				{
					$systemStartTime= '';
					$systemUptime= '';
					$kernalUptime= '';
					while(!feof($fileOpen))
					{
						$filePointer = fgets($fileOpen);
						if(preg_match('/System\s*start\s*time:(.*)/i',$filePointer,$upTime))
						{
							$systemStartTime=trim($upTime[1]);
							echo $systemStartTime."<br/>";
						}
						else if(preg_match('/System\s*uptime:(.*)/i',$filePointer,$Systemuptime))
						{
							$systemUptime=trim($Systemuptime[1]);
							echo $systemUptime."<br/>";
						}
						else if(preg_match('/Kernel\s*uptime:(.*)/i',$filePointer,$Kerneluptime))
						{
							$kernalUptime=trim($Kerneluptime[1]);
							echo $kernalUptime."<br/>";
						}
						 else if(preg_match('/^`/i',$filePointer))
						{
							break;
						}	
						$Write = $systemStartTime.$systemUptime.$kernalUptime.",";
						fwrite($output, $Write);
					}
				}
			}
			
				
		fclose($fileOpen);
	}
}
$obj = new logAnalyser;
$obj->showSystemResetReason();
