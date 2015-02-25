<?php
/**
 * VtgCalculator based on pay rate value.
 *
 * Date       $Date: 2015-02-25 08:27:07 +0530 (Wed, 25 Feb 2015) $
 * Header     $Header: svn://192.168.1.10/VTGRateCalculator/Developing/index.php 8 2015-02-25 02:57:07Z vivin $
 * @category  Calculator
 * @package   VTG Pay Rate Calculator ajax and front template
 * @author    $Author: vivin $ <vtgtrainees@gmail.com>
 * @copyright 2015 Virtual Tech Gurus Inc.
 * @license   2015 Virtual Tech Gurus Inc.
 * @version   $Id: index.php 8 2015-02-25 02:57:07Z vivin $
 * @link      $HeadURL: svn://192.168.1.10/VTGRateCalculator/Developing/index.php $
 */
?>

<!DOCTYPE html>
<!-- set language -->
<html lang="en">
	<head>

		<meta charset="utf-8">
	   	<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"> -->
		<script type="text/javascript" src="ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript" src="maxcdnbootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	</head>
	<body>

		<!--	`````````````````````````````````````````

				********* VTG PayRate Calculator ********

				`````````````````````````````````````````	-->
		<table>
			<tr>
				<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
						***** VTG Pay Rate ******
					^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
				<td>
					<fieldset class="" style = "width:355px; height:360px;" id = "payrate">
						<legend class="">VTG Pay Rate</legend>
						<!--
								***** this fieldset for billTypes ******
						-->
						<fieldset style = "width:150px;">
							<legend>Bill Type</legend>
								<label>Hourly</label><input type = "radio" name ="payRateBillType" id = "payRateBillTypeHour" value="payRateBillTypeHour" checked="checked">
								<label>Monthly</label><input type = "radio" name ="payRateBillType" id = "payRateBillTypeMonth" value = "payRateBillTypeMonth"><br/>
						</fieldset><br/>
						<!--
								*** this textbox for entering payRate ***
						-->
						<label><b>Bill Rate:</b></label>&nbsp;<input type = "number" name = "payBillRate" id = "payBillRate" style ="width:138px;">&nbsp;&nbsp;
						<!--
								************ submit Button **************
						-->
						<input type = "submit" name = "PayRate1" id = "PayRate1" value="Pay Rate" onclick = "VTG_PayRate()">
						<input type = "button" name = "Reset" id = "Reset" value="Reset" onclick = "resetPayRate()">
						<!--
								#***** this fieldset for category ******#
						-->
						<fieldset class="" style = "width:320px;">
							<legend>Category</legend>
								<label>ALL</label><input type = "radio" name = "payRateCategory" id = "payRateAllCategory" value = "payRateAllCategory" checked="checked">&nbsp;&nbsp;
								<label>1099/C2C</label><input type = "radio" name = "payRateCategory" id = "payRate1099/c2cCategory" value = "payRate1099/c2cCategory">&nbsp;&nbsp;
								<label>W2</label><input type = "radio" name = "payRateCategory" id = "payRateW2Category" value = "payRateW2Category">
							</fieldset><br/>
						<!--
								#****** display the payRate Value ******#
						-->
						<fieldset style = "height:100px;">
							<legend>Maximum Pay Rate</legend>
							<h4 id ="payRateValues"></h4>
						</fieldset>
						<h5><mark>Note<br/>For EMC reduce $3/hour to the above hourly pay</mark></h5>
					</fieldset>
				</td>
			<!--^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
					***** VTG Submission Rate ******
				^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
				<td>
					<fieldset class="" style = "width:400px; height:360px;" id = "submission">
						<legend class="">VTG Submission Rate</legend>
						<!--
								***** this fieldset for billTypes ******
						-->
						<fieldset style = "width:150px;">
							<legend>Pay Type</legend>
								<label>Hourly</label><input type = "radio" name ="billType" id = "billTypeHour" value="billTypeHour" checked="checked">
								<label>Monthly</label><input type = "radio" name ="billType" id = "billTypeMonth" value = "billTypeMonth"><br/>
						</fieldset><br/>
						<!--
								*** this textbox for entering payRate ***
						-->
						<label><b>Pay Rate:</b></label>&nbsp;<input type = "number" name = "billRate" id = "billRate" style ="width:138px;">&nbsp;&nbsp;
						<!--
								************ submit Button **************
						-->
						<input type = "submit" name = "PayRate" id = "PayRate" value="Submission Rate" onclick = "ajaxFunction()">
						<input type = "button" name = "Reset" id = "Reset" value="Reset" onclick = "resetSubmission()">
						<!--
								****** this fieldset for category ******
						-->
						<fieldset class="" style = "width:370px;">
							<legend>Category</legend>
								<label>1099/C2C</label><input type = "radio" name = "category" id = "1099/c2cCategory" value = "1099/c2c" checked="checked">&nbsp;&nbsp;
								<label>W2</label><input type = "radio" name = "category" id = "w2Category" value = "w2">
						</fieldset><br/>
						<!--
								***** display submission the Value ******
						-->
						<fieldset style = "height:100px;">
							<legend>Minimum Submission Rate</legend>
							<h4 id ="values"></h4>
						</fieldset>
					</fieldset>
				</td>
			</tr>
		</table>


		<!--	`````````````````````````````````````````````````````

				~~~~~~~~~~ VTG Submission Ajax Function ~~~~~~~~~~~~~

				`````````````````````````````````````````````````````	-->


		<script type="text/javascript">
		/**
		 * [resetPayRate function reset the Pay Rate elements]
		 * @return {[null]} [description]
		 */
		function resetPayRate()
		{
			document.getElementById("payBillRate").value = "";
			document.getElementById("payRateBillTypeHour").checked = true;
			document.getElementById("payRateAllCategory").checked = true;
			document.getElementById("payRateValues").innerHTML = "";
		}
		/**
		 * [resetSubmission function, reset the Submission Rate elements]
		 * @return {[null]} [description]
		 */
		function resetSubmission()
		{
			document.getElementById("billRate").value = "";
			document.getElementById("billTypeHour").checked = true;
			document.getElementById("1099/c2cCategory").checked = true;
			document.getElementById("values").innerHTML = "";
		}
		/**
		 * [ajaxFunction for intract php file using AJAX]
		 * @return {[type]} [description]
		 */
		function ajaxFunction()
		{
			/**
			 * @type  {[integer]} billRate [store the billRate value from user entering value in textbox]
			 * @type  {[string]}  billType [store the billType value from user selected the radio button]
			 * @type  {[string]}  category [store the category value from user selected the radio button]
			 * @type  {[string]}  xmlHttp  [store the XMLHttpRequest() object.]
			 */
			var billRate;
			var billType;
			var category;
			var xmlHttp;
			billRate = document.getElementById("billRate").value;
			var billRateMatch = billRate.match(/\d+\.\d+|\d+/);
			/**
			 * check the Bill Rate value are entered or not.
			 * if the textbox will not entered the alert msg will display.
			 * the textbox will empty the program return.
			 * @param  {[string]}
			 * @return {[null]}
			 */
			if (billRate == "" || billRate != billRateMatch) {
				alert ("please enter Bill Rate");
				return;
			}
			/**
			* looping the html element which holds the name is "billType".
			* if the user selected the Hour radio button that element
			* value stored in billType variable. only one value stored in billType.
			* like billType = "Hour" or billType = "Month".
			* @param  {[integer]} i [if i value lessthan billType element length the i value will increased]
			* @return {[string]}   [its return the user currently selected radio button value]
			*/
			var billTypes = document.getElementsByName("billType");
			/**
			 * [for description]
			 * @param  {[integer]} i [description]
			 */
				for (i=0; i<billTypes.length; i++) {
					if (billTypes[i].checked) {
						billType = billTypes[i].value;
					}
				}
				/**
				 * check the PayRate Value.
				 * if user select the billType is "Hour"
				 * the user should enter the value between 20 to 200. otherwise it
				 * will show alert message.
				 * if user select the billType is "Month"
				 * the user should enter the value between 8000 to 200000.
				 * if user enter the value below 8000 or above 200000 the program show alert message.
				 * @param  {[string]} billType [check if the user select Hour or Month]
				 * @return {[null]}
				 */
				switch (billType) {
				case 'billTypeHour':
					if (billRate < 20) {
						alert("PayRate Should be above 20");
						return;
					} else if (billRate >= 200) {
						alert("PayRate Should be blow 200");
						return;
					}
					break;
				case 'billTypeMonth':
					if (billRate < 8000) {
						alert("PayRate Should be above 8000");
						return;
					} else if (billRate >= 200000) {
						alert("PayRate Should be below 200000");
						return;
					}
					break;
				}
			/**
			 * [categoryType store the morethan one element which holds the name is category]
			 * @type {[string]} categoryType
			 */
			var categoryType = document.getElementsByName('category');
				/**
				 * looping the html element which holds the name is "category".
				 * if the user selected the 1099/c2c radio button that element
				 * value stored in category variable. only one value stored in category.
				 * like category = "1099/c2c" or category = "w2".
				 * @param  {[integer]} i [if i value lessthan category element length the i value will increased]
				 */
				for (i=0; i<categoryType.length; i++) {
					if (categoryType[i].checked) {
						category = categoryType[i].value;
					}
				}
				/**
				 * [store all user entered value for send method. this method used send the value to action file]
				 * @type {String}
				 */
				var postValue = "billRate="+billRate+"&category="+category+"&billType="+billType;

				/**
				 * [if description]
				 * @param  {[string]} window.XMLHttpRequest [All modern browsers (IE7+, Firefox, Chrome, Safari, and Opera) have a built-in XMLHttpRequest object.]
				 * @return {[string]}                       [return the browser information]
				 */
			if (window.XMLHttpRequest) {
				/**
				 * [store the browsers information into xmlHttp variable]
				 * @type {XMLHttpRequest}
				 */
				xmlHttp = new XMLHttpRequest();
			} else {
				/**
				 * [xmlHttp store the Old versions of Internet Explorer (IE5 and IE6) uses an ActiveX Object:]
				 * @type {ActiveObject}
				 */
				xmlHttp = new ActiveObject("Microsoft.XMLHTTP");
			}
			/**
			 * [When a request to a server is sent, we want to perform some actions based on the response.
			 * The onreadystatechange event is triggered every time the readyState changes.
			 * The readyState property holds the status of the XMLHttpRequest.]
			 * @return {[string]} [request finished and response is ready. status = "OK"]
			 */
			xmlHttp.onreadystatechange =function()
			{
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
					/**
					 * [get the response data as a string]
					 * @type {[string]}
					 */
					document.getElementById("values").innerHTML = xmlHttp.responseText;
				}
			}
			/**
			 * xmlHttp.open(method,url,async)
			 * method: the type of request:POST.
			 * url: the location of the file on the server. "ajax.php".
			 * async: true (asynchronous)
			 */
			xmlHttp.open("POST", "Calculation_PayRate_Submission.php", true);
			/**
			 * setRequestHeader(header,value).
			 * header: specifies the header name.
			 * value: specifies the header value
			 */
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			/**
			 * send(string)
			 * Sends the request off to the server.
			 * string: Only used for POST requests
			 * postValue holds the user selected and entered value.
			 */
			xmlHttp.send(postValue);
		}
		</script>

					<!--	`````````````````````````````````````````````````````

							~~~~~~~~~~ VTG Pay Rate Ajax Function ~~~~~~~~~~~~~~~

							`````````````````````````````````````````````````````	-->


		<script type="text/javascript">
		/**
		 * [intract php file using AJAX]
		 * @return {[type]} [description]
		 */
		function VTG_PayRate()
		{
			/**
			 * @type  {[integer]} billRate [store the billRate value from user entering value in textbox]
			 * @type  {[string]}  billType [store the billType value from user selected the radio button]
			 * @type  {[string]}  category [store the category value from user selected the radio button]
			 * @type  {[string]}  xmlHttp  [store the XMLHttpRequest() object.]
			 */
			var billRate;
			var billType;
			var category;
			var xmlHttp;
			billRate = document.getElementById("payBillRate").value;
			var billRateMatch = billRate.match(/\d+\.\d+|\d+/);
			/**
			 * check the Bill Rate value are entered or not.
			 * if the textbox will not entered the alert msg will display.
			 * the textbox will empty the program return.
			 * @param  {[string]}
			 * @return {[false]}
			 */
			if (billRate == "" || billRate != billRateMatch) {
				alert ("please enter Bill Rate");
				return;
			}
			/**
			* looping the html element which holds the name is "billType".
			* if the user selected the Hour radio button that element
			* value stored in billType variable. only one value stored in billType.
			* like billType = "Hour" or billType = "Month".
			* @param  {[integer]} i [if i value lessthan billType element length the i value will increased]
			* @return {[string]}   [its return the user currently selected radio button value]
			*/
			var billTypes = document.getElementsByName("payRateBillType");
			/**
			 * [for description]
			 * @param  {[type]} i [description]
			 * @return {[type]}   [description]
			 */
				for (i=0; i<billTypes.length; i++) {
					if (billTypes[i].checked) {
						billType = billTypes[i].value;
					}
				}
				/**
				 * check the PayRate Value.
				 * if user select the billType is "Hour"
				 * the user should enter the value between 20 to 200. otherwise it
				 * will show alert message.
				 * if user select the billType is "Month"
				 * the user should enter the value between 8000 to 200000.
				 * if user enter the value below 8000 or above 200000 the program show alert message.
				 * @param  {[string]} billType [check if the user select Hour or Month]
				 * @return {[false]}
				 */
				switch (billType) {
				case 'payRateBillTypeHour':
					if (billRate < 20) {
						alert("PayRate Should be above 20");
						return;
					} else if (billRate >= 200) {
						alert("PayRate Should be blow 200");
						return;
					}
					break;
				case 'payRateBillTypeMonth':
					if (billRate < 8000) {
						alert("PayRate Should be above 8000");
						return;
					} else if (billRate >= 200000) {
						alert("PayRate Should be blow 200000");
						return;
					}
					break;
				}
			/**
			 * [categoryType store the morethan one element which holds the name is category]
			 * @type {[string]} categoryType
			 */
			var categoryType = document.getElementsByName('payRateCategory');
				/**
				 * looping the html element which holds the name is "category".
				 * if the user selected the 1099/c2c radio button that element
				 * value stored in category variable. only one value stored in category.
				 * like category = "1099/c2c" or category = "w2".
				 * @param  {[integer]} i [if i value lessthan category element length the i value will increased]
				 * @return {[string]}   [its return the user currently selected radio button value]
				 */
				for (i=0; i<categoryType.length; i++) {
					if (categoryType[i].checked) {
						category = categoryType[i].value;
					}
				}
				/**
				 * [store all user entered value for send method. this method used send the value to action file]
				 * @type {String}
				 */
				var postValue = "billRate="+billRate+"&category="+category+"&billType="+billType;

				/**
				 * [if description]
				 * @param  {[string]} window.XMLHttpRequest [All modern browsers (IE7+, Firefox, Chrome, Safari, and Opera) have a built-in XMLHttpRequest object.]
				 * @return {[string]}                       [return the browser information]
				 */
			if (window.XMLHttpRequest) {
				/**
				 * [store the browsers information into xmlHttp variable]
				 * @type {XMLHttpRequest}
				 */
				xmlHttp = new XMLHttpRequest();
			} else {
				/**
				 * [xmlHttp store the Old versions of Internet Explorer (IE5 and IE6) uses an ActiveX Object:]
				 * @type {ActiveObject}
				 */
				xmlHttp = new ActiveObject("Microsoft.XMLHTTP");
			}
			/**
			 * [When a request to a server is sent, we want to perform some actions based on the response.
			 * The onreadystatechange event is triggered every time the readyState changes.
			 * The readyState property holds the status of the XMLHttpRequest.]
			 * @return {[string]} [request finished and response is ready. status = "OK"]
			 */
			xmlHttp.onreadystatechange =function()
			{
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
					/**
					 * [get the response data as a string]
					 * @type {[string]}
					 */
					document.getElementById("payRateValues").innerHTML = xmlHttp.responseText;
				}
			}
			/**
			 * xmlHttp.open(method,url,async)
			 * method: the type of request:POST.
			 * url: the location of the file on the server. "ajax.php".
			 * async: true (asynchronous)
			 */
			xmlHttp.open("POST", "Calculation_PayRate_Submission.php", true);
			/**
			 * setRequestHeader(header,value).
			 * header: specifies the header name.
			 * value: specifies the header value
			 */
			xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			/**
			 * send(string)
			 * Sends the request off to the server.
			 * string: Only used for POST requests
			 * postValue holds the user selected and entered value.
			 */
			xmlHttp.send(postValue);
		}
		</script>
	</body>
</html>