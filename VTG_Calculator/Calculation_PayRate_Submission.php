<?php

/**
 * VtgCalculator based on pay rate value.
 *
 * Date       $Date: 2015-02-25 08:27:07 +0530 (Wed, 25 Feb 2015) $
 * Header     $Header: svn://192.168.1.10/VTGRateCalculator/Developing/Calculation_PayRate_Submission.php 8 2015-02-25 02:57:07Z vivin $
 * @category  Calculator
 * @package   VTG Pay Rate Calculator
 * @author    $Author: vivin $ <vtgtrainees@gmail.com>
 * @copyright 2015 Virtual Tech Gurus Inc.
 * @license   2015 Virtual Tech Gurus Inc.
 * @version   $Id: Calculation_PayRate_Submission.php 8 2015-02-25 02:57:07Z vivin $
 * @link      $HeadURL: svn://192.168.1.10/VTGRateCalculator/Developing/Calculation_PayRate_Submission.php $
 */

class VtgCalculator
{
                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                                 #
                            #***************** VTG_SUBMISSION_RATE FUNCTION ******************#
                            #                                                                 #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */
    /**
     * [submissionPayRate calculate the submission value]
     * @param  [type] $rate     [get the Pay Rate value]
     * @param  [type] $category [get the Category value]
     * @param  [type] $type     [get the Bill Type]
     * @return [null]           [description]
     */
    public function submissionPayRate($rate, $category, $type)
    {
        /**
         * the switch case used to based on the user select the criteria
         * the payrate value calculated.
         * @param  {[string]} $category [check if the user select Hour or Month]
        */
        switch ($category) {

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #***** CATEGORY -> "1099/C2C" AND BILLTYPE -> "HOUR" *******#
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

            case '1099/c2c':
            /**
             * if the user selected the category 1099/c2c means
             * @param  {[string]} $category [check the BillType.]
            */
                switch ($type) {
                    /**
                     * if the user select category value is "1099/c2c"
                     * and billType is "Hour" the payRate value divited by 0.75.
                     * then the value stored in another variable called $payRateValuePerHour.
                     * then the payRate value (textbox value) and payRateValuePerHour
                     * values subtracted and stored into $tempValue variable.
                    */
                    case 'billTypeHour':
                        $payRateValuePerHour = $rate / 0.75;
                        $tempValue = $payRateValuePerHour - $rate;
                        /**
                         * the payRateValuePerHour value consider by perhour value.
                         * if the tempValue greater than and equals 20 means
                         * the payRateValuePerHour multiply with 172.
                         * then the value stored in $payRatePerMonth variable
                         * the payRatePerMonth value consider by perMonth value..
                         *
                         * if the tempValue lessthan 20 ($tempValue < 20)
                         * the payRate Value added with 20 like( 50 + 20) then
                         * the value stored in $payratePerHour variable.
                         * then the payRatePerHour value multiply to 172.
                         * then the value stored in $parRatePerMonth variable.
                         * the payRatePerMonth variable consider as perMonth value.
                         *
                         *
                        */
                        if ($tempValue >= 20) {
                            $payRateValuePerMonth  = $payRateValuePerHour * 172;
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerMonth, 2, '.', '')."/Month";
                        } else {
                                $payRateValuePerHour = $rate + 20;
                                $payRateValuePerMonth = $payRateValuePerHour * 172;
                                echo "1099 / C2C : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                                echo "1099 / C2C : $".number_format((float)$payRateValuePerMonth, 2, '.', '')."/Month";
                        }
                        /**
                         * -----------------------------------------------------------------------
                         * Example:
                         * -----------------------------------------------------------------------
                         * CATEGORY -> "1099/C2C" AND BILLTYPE -> "HOUR"
                         * -------------------------
                         * IF THE SOME VALUE >= 20
                         * -------------------------
                         * $rate = 100;
                         * $payRateValuePerHour = $rate / 0.75; =>(100 / 0.75 = 133.333 )
                         * $tempValue = $payRateValuePerHour - $rate; =>(133.33 - 100 = 33.33)
                         * $payRateValuePerMonth = 133.33 * 172 => 22933.333
                         * if ($tempValue >= 20)=>(33.33 >= 20)
                         * -----------------------------------------------------------------------
                         * RESULT
                         * -----------------------------------------------------------------------
                         * 1099 / C2C : $133.33333333333/Hour.
                         * 1099 / C2C : $22933.333333333/Month.
                         * -------------------------
                         * IF THE SOME VALUE < 20
                         * -------------------------
                         * $rate = 50;
                         * $payRateValuePerHour = $rate / 0.75; =>(50 / 0.75 = 66.666 )
                         * $tempValue = $payRateValuePerHour - $rate; =>(66.66 - 50 = 16.66)
                         * if ($tempValue < 20)=>(16.66 < 20)
                         * $payRateValuePerHour = $rate + 20; => 50 + 20 = 70
                         * $payRateValuePerMonth = 70 * 172 => 12040.
                         * ------------------------------------------------------------------------
                         * RESULT
                         * ------------------------------------------------------------------------
                         * 1099 / C2C : $70/Hour.
                         * 1099 / C2C : $12040/Month.
                         * ------------------------------------------------------------------------
                         */
                        break;

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #***** CATEGORY -> "1099/C2C" AND BILLTYPE -> "MONTH" ******#
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

                        /**
                         * if the user select category value is "1099/c2c" and
                         * billType is "Month" the payRate value divited by 172.
                         * then the value stored in $payRateValuePerHour variable.
                         * then the payRatePerHour value divited by 0.75
                         * then the value stored in $payRateValuePerHour1.
                         * $payRateValuePerHour1 value subtracted with $payRateValuePerHour.
                         * then the value stored in $tempValue variable.
                        */
                    case 'billTypeMonth':
                        $payRateValuePerHour = $rate / 172;
                        $payRateValuePerHour1 = $payRateValuePerHour / 0.75;
                        $tempValue = $payRateValuePerHour1 - $payRateValuePerHour;
                        /**
                         * if the tempValue lessthan 20 the payRate Value added with 20
                         * the value stored in $payratePerHour variable
                         * then the payRatePerHour value multiply to 172
                         * then the value stored in $parRatePerMonth variable
                        */
                        if ($tempValue >= 20) {
                            $payRateValuePerMonth = $payRateValuePerHour1 * 172;
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerHour1, 2, '.', '')."/Hour"."<br/>";
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerMonth, 2, '.', '')."/Month";
                        } else {
                            $payRateValuePerHour = $payRateValuePerHour + 20;
                            $payRateValuePerMonth = $payRateValuePerHour * 172;
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerMonth, 2, '.', '')."/Month";
                        }
                        /**
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * Example:
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * CATEGORY -> "1099/C2C" AND BILLTYPE -> "MONTH"
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * $rate = 35000;
                         * $payRateValuePerHour = $rate / 172; =>(35000 / 172 = 203.488 )
                         * $payRateValuePerHour1 = $payRateValuePerHour / 0.75; = > (203.488 / 0.75 = 271.317)
                         * $tempValue = $payRateValuePerHour1 - $payRateValuePerHour; => (271.317 - 203.488 = 40.829) -> the value greaterthan 20
                         * -------------------------
                         * IF THE SOME VALUE >= 20
                         * -------------------------
                         * $payRateValuePerMonth = $payRateValuePerHour1 * 172; => 271.317 * 172 = 46666.66
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * echo "1099 / C2C : $".$payRateValuePerHour1."/Hour"."<br/>";  => "1099 / C2C : $".271.317."/Hour".
                         * echo "1099 / C2C : $".$payRateValuePerMonth."/Month";         => "1099 / C2C : $".46666.66."/Month".
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * 1099 / C2C : $271.31782945736/Hour
                         * 1099 / C2C : $46666.666666667/Month
                         * --------------------------
                         * IF THE SOME VALUE < 20
                         * --------------------------
                         * $rate = 8000;
                         * $payRateValuePerHour = $rate / 172; =>(8000 / 172 = 46.511 )
                         * $payRateValuePerHour1 = $payRateValuePerHour / 0.75; = > (46.511 / 0.75 = 62.015)
                         * $tempValue = $payRateValuePerHour1 - $payRateValuePerHour; => (62.015 - 46.511 = 15.504) -> the value greaterthan 20
                         * $payRateValuePerHour = $payRateValuePerHour + 20;    => (46.511 + 20)  => 66.511.
                         * $payRateValuePerMonth = $payRateValuePerHour * 172;  => (66.511 * 172) => 11439.89.
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * echo "1099 / C2C : $".$payRateValuePerHour."/Hour"."<br/>";  => "1099 / C2C : $".66.511."/Hour".
                         * echo "1099 / C2C : $".$payRateValuePerMonth."/Month";         => "1099 / C2C : $".11439.89."/Month".
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * 1099 / C2C : $ 66.51 / Hour.
                         * 1099 / C2C : $ 11440 / Month.
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         */
                        break;
                }
                break;

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #******** CATEGORY -> "W2" AND BILLTYPE -> "HOUR" **********#
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

            case 'w2':
            /**
             * if the user selected the category w2 means
             * @param  {[string]} $category [check the BillType.]
             */
                switch ($type) {
                /**
                 * if the user select category value is "w2" and billType is "Hour"
                 * the payRate value divited by 0.65. then the value stored in
                 * another variable called $payRateValuePerHour. payRate value
                 * and payRateValuePerHour values subtracted and stored into $tempValue variable.
                */
                    case 'billTypeHour':
                        $payRateValuePerHour = $rate / 0.65;
                        $tempValue = $payRateValuePerHour - $rate;
                        /**
                         * the payRateValuePerHour value consider by perhour value.
                         * if the tempValue greater than and equals 25 means
                         * the payRateValuePerHour multiply with 172.
                         * then the value stored in $payRatePerMonth variable
                         * the payRatePerMonth value consider by perMonth value.
                         *
                         * if the tempValue lessthan 25 ($tempValue < 25)
                         * the payRate Value added with 25 then the value
                         * stored in $payratePerHour variable.
                         * then the payRatePerHour value multiply to 172.
                         * then the value stored in $parRatePerMonth variable.
                         * the payRatePerMonth variable consider as perMonth value.
                         *
                        */
                        if ($tempValue >= 25) {
                            $payRateValuePerMonth  = $payRateValuePerHour * 172;
                            echo "W2 : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                            echo "W2 : $".number_format((float)$payRateValuePerMonth, 2, '.', '')."/Month";
                        } else {
                                $payRateValuePerHour = $rate + 25;
                                $payRateValuePerMonth = $payRateValuePerHour * 172;
                                echo "W2 : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                                echo "W2 : $".number_format((float)$payRateValuePerMonth, 2, '.', '')."/Month";
                        }
                        /**
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * Example:
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * CATEGORY -> "w2" AND BILLTYPE -> "HOUR"
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * IF THE SOME VALUE >= 25
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * $rate = 150;
                         * $payRateValuePerHour = $rate / 0.65; =>(150 / 0.65 = 230.769 )
                         * $tempValue = $payRateValuePerHour - $rate; =>(230.769 - 150 = 80.769) -> the value greaterthan 25
                         * $payRateValuePerMonth  = $payRateValuePerHour * 172; => 230.769 * 172 => 39692.268
                         * if ($tempValue >= 25)=>(80.769 >= 25)
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * echo "W2 : $".$payRateValuePerHour."/Hour"."<br/>"; => "W2 : $".230.769."/Hour."
                         * echo "W2 : $".$payRateValuePerMonth."/Month";       => "W2 : $".39692.268."/Month."
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * W2 : $ 230.76 / Hour.
                         * W2 : $ 39692.30 / Month.
                         * --------------------------
                         * IF THE SOME VALUE < 25
                         * --------------------------
                         * $rate = 40;
                         * $payRateValuePerHour = $rate / 0.65; =>(40 / 0.65 = 61.538 )
                         * $tempValue = $payRateValuePerHour - $rate; =>(61.538 - 40 = 21.538) -> the value lessthan 20
                         * if ($tempValue < 25)=>(21.538 < 25)
                         * $payRateValuePerHour = $rate + 25; => 40 + 25 = 65
                         * $payRateValuePerMonth = 65 * 172 => 11180.
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * echo "W2 : $".$payRateValuePerHour."/Hour"."<br/>"; => "W2 : $".65."/Hour."
                         * echo "W2 : $".$payRateValuePerMonth."/Month";       => "W2 : $".11180."/Month."
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * W2 : $ 65 / Hour.
                         * W2 : $ 11180 / Month.
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         */
                        break;

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #******* CATEGORY -> "W2" AND BILLTYPE -> "MONTH" **********#
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

                        /**
                         * if the user select category value is "w2" and billType is "Month"
                         * the payRate value divited by 172. then the value
                         * stored in $payRateValuePerHour variable. then the
                         * payRatePerHour value divited by 0.65 then the value
                         * stored in $payRateValuePerHour1. the $payRateValuePerHour1
                         * value subtracted with $payRateValuePerHour. after subtration
                         * the value stored in $tempValue variable .
                        */
                    case 'billTypeMonth':
                        $payRateValuePerHour = $rate / 172;
                        $payRateValuePerHour1 = $payRateValuePerHour / 0.65;
                        $tempValue = $payRateValuePerHour1 - $payRateValuePerHour;
                        /**
                         * the payRateValuePerHour value consider by perhour value.
                         * if the tempValue greater than and equals 25 means
                         * the payRateValuePerHour multiply with 172.
                         * after multiply the value stored in $payRatePerMonth variable
                         *
                         * if the tempValue lessthan 25 the payRate Value added with 25
                         * after adding the value stored in $payratePerHour variable
                         * the payRatePerHour value multiply to 172 after myltiply
                         * the value stored in $parRatePerMonth variable
                        */
                        if ($tempValue >= 25) {
                            $payRateValuePerMonth = $payRateValuePerHour1 * 172;
                            echo "W2 : $".number_format((float)$payRateValuePerHour1, 2, '.', '')."/Hour"."<br/>";
                            echo "W2 : $".number_format((float)$payRateValuePerMonth, 2, '.', '')."/Month";
                        } else {
                            $payRateValuePerHour = $payRateValuePerHour + 25;
                            $payRateValuePerMonth = $payRateValuePerHour * 172;
                            echo "W2 : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                            echo "W2 : $".number_format((float)$payRateValuePerMonth, 2, '.', '')."/Month";
                        }
                        /**
                         * -------------------------------------------------------------------------------------------------------------------------------------
                         * Example:
                         * -------------------------------------------------------------------------------------------------------------------------------------
                         * CATEGORY -> "W2" AND BILLTYPE -> "MONTH"
                         * -------------------------------------------------------------------------------------------------------------------------------------
                         * $rate = 28000;
                         * $payRateValuePerHour = $rate / 172; =>(28000 / 172 = 162.790 )
                         * $payRateValuePerHour1 = $payRateValuePerHour / 0.65; = > (162.790 / 0.65 = 250.44)
                         * $tempValue = $payRateValuePerHour1 - $payRateValuePerHour; => (250.44 - 162.790 = 87.657) -> the value greaterthan 20
                         * --------------------------
                         * IF THE SOME VALUE >= 25
                         * --------------------------
                         * $payRateValuePerMonth = $payRateValuePerHour1 * 172; => 250.44 * 172 = 43075.68
                         * ----------------------------------------------------------
                         * echo "1099 / C2C : $".$payRateValuePerHour1."/Hour"."<br/>";  => "1099 / C2C : $".250.44."/Hour".
                         * echo "1099 / C2C : $".$payRateValuePerMonth."/Month";         => "1099 / C2C : $".43075.68."/Month".
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * W2 : $ 250.44 / Hour.
                         * W2 : $ 43076.92 / Month.
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * IF THE SOME VALUE < 25
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * the value should be enter above 8000 so the some of 8000 is greaterthan 25.
                         */
                        break;
                }
                break;
        }
    }

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                                 #
                            #******************** VTG_PAY_RATE FUNCTION **********************#
                            #                                                                 #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

    /**
     * [payRate calculating VTG Pay Rate]
     * @param [interger] $rate
     * @param [string]   $category
     * @param [string]   $type
     */
    public function payRate($rate, $category, $type)
    {
        /**
         * the switch case used to based on the user select the criteria
         * the payrate value calculated.
         * @param  {[string]} $category [check if the user select Hour or Month]
        */
        switch ($category) {

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #******** CATEGORY -> "ALL" AND BILLTYPE -> "HOUR" ******** #
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

            case 'payRateAllCategory':
            /**
             * if the user selected the category ALL means
             * @param  {[string]} $type [check the BillType.]
             *
            */
                switch ($type) {
                    /**
                     * if the user select category value is "ALL" and billType is "Hourly" the payRate
                     * value divited by 0.75. then the value stored $payRateValuePerHour variable.
                     * then the payRate value (textbox value) and payRateValuePerHour
                     * values subtracted and stored into $tempValue variable.
                    */
                    case 'payRateBillTypeHour':
                        $payRateValuePerHour = $rate * 0.75;
                        $tempValue = $rate - $payRateValuePerHour;
                        /**
                         * this condition for 1099/c2c values.
                         * if the tempValue greater than and equals 20 means ($tempValue >= 20)
                         * the 1099/c2c value is $payRateValuePerHour.
                         * if the value lessthen 20 means the payRate value subtracted by 20.
                         * now the the 1099/c2c value is $payRateValuePerHour.
                         */
                        if ($tempValue >= 20) {
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                        } else {
                                $payRateValuePerHour = $rate - 20;
                                echo "1099 / C2C : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                        }
                        /**
                         * this condition for W2 vlaues. the payrate value multiply with 0.65
                         * after multiply the value stored in $payRateValuePerHour.
                         * then the payRate value subtracted with $payRateValuePerHour
                         * after subtraction the value stored in $tempValue variable.
                         * now check the $tempValue value. if the $tempRate value greaterthen 25
                         * the w2 value is $payRateValuePerHour. if the $tempValue lessthen 25
                         * the $payRate value subtracted by 25. after subtration
                         * the value stored in $payRateValuePerHour variable.
                         * now the w2 value is $payRateValuePerHour.
                         *
                         */
                        $payRateValuePerHour = $rate * 0.65;
                        $tempValue = $rate - $payRateValuePerHour;
                        if ($tempValue >= 25) {
                            echo "W2 : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                        } else {
                                $payRateValuePerHour = $rate - 25;
                                echo "W2 : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                        }
                        /**
                         * per Year salary value calculation based on hourly.
                         */
                        $rate = round($rate, 2);
                        echo "Salary : $".number_format((float)$rate * 0.5 *(2000), 2, '.', '')."/Year"."<br/>";
                        /**
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * Example:
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * CATEGORY -> "ALL" AND BILLTYPE -> "HOURLY"
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * $rate = 120;
                         * $payRateValuePerHour = $rate * 0.75; =>(120 * 0.75 = 90 )
                         * $tempValue = $rate - $payRateValuePerHour; => (120 - 90 = 30) -> the value greaterthan 20
                         * --------------------------
                         * IF THE SOME VALUE >= 20
                         * --------------------------
                         * echo "1099 / C2C : $ ".$payRateValuePerHour."/Hour"."<br/>"; => "1099 / C2C : $ ".90."/Hour."
                         * --------------------------
                         * IF THE SOME VALUE < 20
                         * --------------------------
                         * $payRateValuePerHour = $rate - 20; => (120 - 20)
                         * echo "1099 / C2C : $ ".$payRateValuePerHour."/Hour"."<br/>"; => "1099 / C2C : $ ".100."/Hour."
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * NOW GET W2 VALUE FOR CATEGORY ALL
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * $payRateValuePerHour = $rate * 0.65; => (120 * 0.65 = 78)
                         * $tempValue = $rate - $payRateValuePerHour; => (120 - 78 = 42)
                         * --------------------------
                         * IF THE SOME VALUE >= 25
                         * --------------------------
                         * echo "1099 / C2C : $ ".$payRateValuePerHour."/Hour"."<br/>"; => "1099 / C2C : $ ".78."/Hour."
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * --------------------------
                         * IF THE SOME VALUE < 25
                         * --------------------------
                         * $payRateValuePerHour = $rate - 25; => (120 - 25 = 95)
                         * echo "1099 / C2C : $ ".$payRateValuePerHour."/Hour"."<br/>"; => "1099 / C2C : $ ".95."/Hour"
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * SALARY
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * echo "Salary : $ ".$rate * 0.5 *(2000)."/Year"."<br/>"; => (120 * 0.5 * (2000) = 120000 )
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * 1099 / C2C : $ 90.00 / Hour.
                         * W2 : $ 78.00 / Hour.
                         * Salary : $ 120000.00 / Year.
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         */
                        break;

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #******** CATEGORY -> "ALL" AND BILLTYPE -> "Month" ********#
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

                        /**
                         * if the user select category value is "1099/c2c" and billType is "Month"
                         * the payRate value divited by 172. after divition
                         * the value stored in $payRateValuePerHour variable after that
                         * the payRatePerHour value divited by 0.75 then the value stored
                         * in $payRateValuePerHour1. the $payRateValuePerHour1 value
                         * subtracted with $payRateValuePerHour. after subtraction
                         * the value stored in $tempValue variable.
                         *
                        */
                    case 'payRateBillTypeMonth':
                        $payRateValuePerHour = $rate / 172;
                        $payRateValuePerHour1 = $payRateValuePerHour * 0.75;
                        $tempValue = $payRateValuePerHour - $payRateValuePerHour1;
                        /**
                         * if the user select the billType Monthly means the payRate value
                         * divited by 172.then the value stored in $payRateValuePerHour.
                         * then the calculation process like hourly billType.
                        */
                        if ($tempValue >= 20) {
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerHour1, 2, '.', '')."/Hour"."<br/>";
                        } else {
                            $payRateValuePerHour2 = $payRateValuePerHour - 20;
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerHour2, 2, '.', '')."/Hour"."<br/>";
                        }
                        $payRateValuePerHour1 = $payRateValuePerHour * 0.65;
                        $tempValue = $payRateValuePerHour - $payRateValuePerHour1;
                        if ($tempValue >= 25) {
                            echo "W2 : $".number_format((float)$payRateValuePerHour1, 2, '.', '')."/Hour"."<br/>";
                        } else {
                                $payRateValuePerHour2 = $payRateValuePerHour - 25;
                                echo "W2 : $".number_format((float)$payRateValuePerHour2, 2, '.', '')."/Hour"."<br/>";
                        }
                        /**
                         * per Year salary value calculation based on monthly.
                         */
                        $payRateValuePerHour = round($payRateValuePerHour, 2);
                        echo "Salary : $".number_format((float)$payRateValuePerHour * 0.5 *(2000), 2, '.', '')."/Year"."<br/>";
                        /**
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * Example:
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * CATEGORY -> "ALL" AND BILLTYPE -> "MONTHLY"
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * $rate = 8000;
                         * $payRateValuePerHour = $rate / 172; =>(8000 / 172 = 46.511)
                         * $payRateValuePerHour1 = $payRateValuePerHour * 0.75; (46.511 * 0.75 = 34.8832)
                         * $tempValue = $payRateValuePerHour - $payRateValuePerHour1; => (46.511 - 34.8832 = 11.62) -> the value lessthan 20
                         * --------------------------
                         * IF THE SOME VALUE >= 20
                         * --------------------------
                         * echo "1099 / C2C : $".$payRateValuePerHour1."/Hour"."<br/>";
                         * --------------------------
                         * IF THE SOME VALUE < 20
                         * --------------------------
                         * $payRateValuePerHour2 = $payRateValuePerHour - 20; => (46.511 - 20 = 26.511)
                         * echo "1099 / C2C : $".$payRateValuePerHour2."/Hour"."<br/>"; => "1099 / C2C : $".26.511."/Hour"
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * NOW GET W2 VALUE FOR CATEGORY ALL
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * $payRateValuePerHour1 = $payRateValuePerHour * 0.65; => (34.8832 * 0.65 = 22.67)
                         * $tempValue = $payRateValuePerHour - $payRateValuePerHour1; => (34.8832 - 22.67 = 12.209) -> the value lessthan 25
                         * --------------------------
                         * IF THE SOME VALUE >= 25
                         * --------------------------
                         * echo "1099 / C2C : $ ".$payRateValuePerHour."/Hour"."<br/>"; => "1099 / C2C : $ ".78."/Hour."
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * --------------------------
                         * IF THE SOME VALUE < 25
                         * --------------------------
                         * $payRateValuePerHour2 = $payRateValuePerHour - 25; (46.511 - 25 = 21.511)
                         * echo "W2 : $ ".$payRateValuePerHour2."/Hour"."<br/>"; => "W2 : $ ".21.511."/Hour"
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * SALARY
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * echo "Salary : $ ".$payRateValuePerHour * 0.5 *(2000)."/Year"."<br/>"; => (46.511 * 0.5 * (2000) = 46510.00 )
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * 1099 / C2C : $ 26.51 / Hour.
                         * W2 : $ 21.51 / Hour.
                         * Salary : $ 46510.00 / Year.
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         */
                        break;
                }
                break;

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #****** CATEGORY -> "1099/C2C" AND BILLTYPE -> "HOUR" ******#
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

            case 'payRate1099/c2cCategory':
            /**
             * if the user selected the category 1099/c2c means
             * @param  {[string]} $type [check the BillType.]
            */
                switch ($type) {
                    /**
                     * if the user select category value is "1099/c2c" and billType is "Hourly"
                     * the payRate value multiply by 0.75. then the value stored in $payRateValuePerHour.
                     * then the payRate value (textbox value) and payRateValuePerHour values
                     * subtracted and stored into $tempValue variable.
                    */
                    case 'payRateBillTypeHour':
                        $payRateValuePerHour = $rate * 0.75;
                        // $checkts = preg_split('/\./',$payRateValuePerHour);
                        // print_r($checkts);
                        $tempValue = $rate - $payRateValuePerHour;
                        /**
                         * if the $tempValue greaterthan 20 the 1099/c2c value is $payRateValuePerHour.
                         * else the payRate value subtracted by 20 and the value
                         * stored in $payRateValuePerHour variable.
                         * now the 1099/c2c value is $payRateValuePerHour.
                        */
                        if ($tempValue >= 20) {
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                        } else {
                                $payRateValuePerHour = $rate - 20;
                                echo "1099 / C2C : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                        }
                        /**
                         * the 1099/c2c per Year salary value calculation based on hourly.
                         */
                        $rate = round($rate, 2);
                        echo "Salary : $".number_format((float)$rate * 0.5 *(2000), 2, '.', '')."/Year"."<br/>";
                        /**
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * Example:
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * CATEGORY -> "1099/C2C" AND BILLTYPE -> "hourly"
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * $rate = 60;
                         * $payRateValuePerHour = $rate * 0.75; => (60 * 0.75 = 45)
                         * $tempValue = $rate - $payRateValuePerHour; => (60 - 45 = 15)
                         * --------------------------
                         * IF THE SOME VALUE >= 20
                         * --------------------------
                         * echo "1099 / C2C : $ ".$payRateValuePerHour."/Hour"."<br/>"; => "1099 / C2C : $ ".45."/Hour"
                         * --------------------------
                         * IF THE SOME VALUE < 20
                         * --------------------------
                         * $payRateValuePerHour = $rate - 20; =>(60 - 20 = 40)
                         * echo "1099 / C2C : $ ".$payRateValuePerHour."/Hour"."<br/>"; => "1099 / C2C : $ ".40."/Hour"
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * SALARY
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * echo "Salary : $ ".$rate * 0.5 *(2000)."/Year"."<br/>"; => (60 * 0.5 * (2000) = 60000 )
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * 1099 / C2C : $ 40/Hour
                         * Salary : $ 60000/Year
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         *
                        */
                        break;

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #***** CATEGORY -> "1099/C2C" AND BILLTYPE -> "MONTH" ******#
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

                        /**
                         * if the user select the billType Monthly means the payRate value
                         * divited by 172.then the value stored in $payRateValuePerHour.
                         * then the calculation process like category ALL Type.
                        */
                    case 'payRateBillTypeMonth':
                        $payRateValuePerHour = $rate / 172;
                        $payRateValuePerHour1 = $payRateValuePerHour * 0.75;
                        $tempValue = $payRateValuePerHour - $payRateValuePerHour1;
                        /**
                         * if the $tempValue greaterthen and equals 20
                         * the 1099/c2c value is $payRateValuePerHour1.
                         * else the $payRateValuePerHour subtracted by 20
                         * and stored in $payRateValuePerHour2 variable.
                         * now the 1099/c2c value is $payRateValuePerHour2.
                        */
                        if ($tempValue >= 20) {
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerHour1, 2, '.', '')."/Hour"."<br/>";
                        } else {
                            $payRateValuePerHour2 = $payRateValuePerHour - 20;
                            echo "1099 / C2C : $".number_format((float)$payRateValuePerHour2, 2, '.', '')."/Hour"."<br/>";
                        }
                        /**
                         * the 1099/c2c per Year salary value calculation based on Monthly.
                         */
                        $payRateValuePerHour = round($payRateValuePerHour, 2);
                        echo "Salary : $".number_format((float)$payRateValuePerHour * 0.5 *(2000), 2, '.', '')."/Year"."<br/>";
                        /**
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * Example:
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * CATEGORY -> "1099/C2C" AND BILLTYPE -> "MONTHLY"
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * $rate = 9000;
                         * $payRateValuePerHour = $rate / 172; => (9000 / 172 = 52.32)
                         * $payRateValuePerHour1 = $payRateValuePerHour * 0.75; => (52.32 * 0.75 = 39.244)
                         * $tempValue = $payRateValuePerHour - $payRateValuePerHour1; => (52.32 - 39.244 = 13.081) -> the value lessthan 20
                         * --------------------------
                         * IF THE SOME VALUE >= 20
                         * --------------------------
                         * echo "1099 / C2C : $".$payRateValuePerHour1."/Hour"."<br/>"; => "1099 / C2C : $".39.244."/Hour"
                         * --------------------------
                         * IF THE SOME VALUE < 20
                         * --------------------------
                         * $payRateValuePerHour2 = $payRateValuePerHour - 20; => (52.3255 - 20 = 32.3255)
                         * echo "1099 / C2C : $".$payRateValuePerHour2."/Hour"."<br/>"; => "1099 / C2C : $".32.3255."/Hour"
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * SALARY
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * echo "Salary : $ ".$payRateValuePerHour * 0.5 *(2000)."/Year"."<br/>"; => (52.32 * 0.5 * (2000) = 52320)
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * 1099 / C2C : $32.325581395349/Hour
                         * Salary : $ 52325.581395349/Year
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         */
                        break;
                }
                break;
                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #********* CATEGORY -> "W2" AND BILLTYPE -> "HOUR" *********#
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

            case 'payRateW2Category':
            /**
             * if the user selected the category W2 means
             * @param  {[string]} $type [check the BillType.]
            */
                switch ($type) {
                    /**
                     * the value payRate value multiply by 0.65. then the value stored in one variable.
                     * then the payRate value and after multiply value subtracted and stored in on variable.
                    */
                    case 'payRateBillTypeHour':
                        $payRateValuePerHour = $rate * 0.65;
                        $tempValue = $rate - $payRateValuePerHour;
                        /**
                         * after subtraction value greaterthan and equals to 25, the W2 value is ($rate * 0.65).
                         * else if the value lessthen 25, the W2 value is ($rate - 25)
                        */
                        if ($tempValue >= 25) {
                            echo "W2 : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                        } else {
                                $payRateValuePerHour = $rate - 25;
                                echo "W2 : $".number_format((float)$payRateValuePerHour, 2, '.', '')."/Hour"."<br/>";
                        }
                        /**
                         * the W2 per Year salary value calculation based on Hourly.
                         */
                        $rate = round($rate, 2);
                        echo "Salary : $".number_format((float)$rate * 0.5 *(2000), 2, '.', '')."/Year"."<br/>";
                        /**
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * Example:
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * CATEGORY -> "1099/C2C" AND BILLTYPE -> "HOURLY"
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * $rate = 70;
                         * $payRateValuePerHour = $rate * 0.65; => (70 * 0.65 = 45.5)
                         * $tempValue = $rate - $payRateValuePerHour; => (70 - 45.5 = 24.5) -> this value lessthan 25
                         * --------------------------
                         * IF THE SOME VALUE >= 25
                         * --------------------------
                         * echo "W2 : $ ".$payRateValuePerHour."/Hour"."<br/>"; => "W2 : $ ".45.5."/Hour"
                         * --------------------------
                         * IF THE SOME VALUE < 25
                         * --------------------------
                         * $payRateValuePerHour = $rate - 25; =>(70 - 25 = 45)
                         * echo "W2 : $ ".$payRateValuePerHour."/Hour"."<br/>"; => "W2 : $ ".45."/Hour"
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * SALARY
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * echo "Salary : $ ".$rate * 0.5 *(2000)."/Year"."<br/>"; => (7000 * 0.5 * (2000) = 70000 )
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * W2 : $ 45/Hour
                         * Salary : $ 70000/Year
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         */
                        break;

                        /*
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                            #                                                           #
                            #******** CATEGORY -> "W2" AND BILLTYPE -> "MONTH" *********#
                            #                                                           #
                            #^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^#
                        */

                        /**
                         * now the calculation for monthly billType.
                         * now the payRate value divited by 172. after division the value multiply by 0.65.
                         * then the value subtracted.
                        */
                    case 'payRateBillTypeMonth':
                        $payRateValuePerHour = $rate / 172;
                        $payRateValuePerHour1 = $payRateValuePerHour * 0.65;
                        $tempValue = $payRateValuePerHour - $payRateValuePerHour1;
                        /**
                         * after that the value greaterthan and equals 25
                         * the W2 value will be display. or if the value lessthan 25 the value subtracted by 25
                         * then the W2 value dislplay.
                        */
                        if ($tempValue >= 25) {
                            echo "W2 : $".number_format((float)$payRateValuePerHour1, 2, '.', '')."/Hour"."<br/>";
                        } else {
                                $payRateValuePerHour2 = $payRateValuePerHour - 25;
                                echo "W2 : $ ".number_format((float)$payRateValuePerHour2, 2, '.', '')."/Hour"."<br/>";
                        }
                        /**
                         * the W2 per Year salary value calculation based on Monthly.
                         */
                        $payRateValuePerHour = round($payRateValuePerHour, 2);
                        echo "Salary : $".number_format($payRateValuePerHour * 0.5 *(2000), 2, '.', '')."/Year"."<br/>";
                        /**
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * Example:
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * CATEGORY -> "W2" AND BILLTYPE -> "MONTHLY"
                         * ------------------------------------------------------------------------------------------------------------------------------------
                         * $rate = 10500;
                         * $payRateValuePerHour = $rate / 172; => (10500 / 172 = 61.046)
                         * $payRateValuePerHour1 = $payRateValuePerHour * 0.65; => (61.046 * 0.65 = 39.680)
                         * $tempValue = $payRateValuePerHour - $payRateValuePerHour1; => (61.046 - 39.680 = 21.366) -> the value lessthan 25
                         * --------------------------
                         * IF THE SOME VALUE >= 25
                         * --------------------------
                         * echo "W2 : $".$payRateValuePerHour."/Hour"."<br/>"; => "W2 : $".61.046."/Hour"
                         * --------------------------
                         * IF THE SOME VALUE < 25
                         * --------------------------
                         * $payRateValuePerHour2 = $payRateValuePerHour - 25; => (61.046 - 25 = 32.3255)
                         * echo "W2 : $".$payRateValuePerHour2."/Hour"."<br/>"; => "W2 : $".36.046."/Hour"
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * SALARY
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * echo "Salary : $ ".$payRateValuePerHour * 0.5 *(2000)."/Year"."<br/>"; => (61.046 * 0.5 * (2000) = 61046)
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * RESULT
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         * W2 : $ 36.046511627907/Hour
                         * Salary : $ 61046.511627907/Year
                         * -----------------------------------------------------------------------------------------------------------------------------------
                         */
                        break;
                }
                break;
        }
    }
}
/**
 * [$billRate using post method and get the payRate(textbox) value]
 * @var [interger]
 */
$billRate = $_POST['billRate'];
/**
 * [$billCategory using post method and get the category(radio button) value]
 * @var [string]
 */
$billCategory = $_POST['category'];
/**
 * [$billType using post method and get the billType(radio button) value]
 * @var [string]
 */
$billType = $_POST['billType'];
/**
 * [$VTG_Calculator_Object creating object for class]
 * @var VtgCalculator
 */
$VTG_Calculator_Object = new VtgCalculator();
/**
 * call the function using object.
 */
$VTG_Calculator_Object-> submissionPayRate($billRate, $billCategory, $billType);
$VTG_Calculator_Object-> payRate($billRate, $billCategory, $billType);
