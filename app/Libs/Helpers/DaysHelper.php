<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/3/2016
 * Time: 5:02 PM
 */

namespace App\Libs\Helpers;

class DaysHelper extends Helper
{
    public static function convert($dateWithTime)
    {
        $myDate = substr($dateWithTime, 0, 10);
        $daysNumber = DaysHelper::getDays($dateWithTime);

        if($myDate == date('Y-m-d'))
        {
            $oldDateTime = date('h:i A', strtotime($dateWithTime));
            $currentTime = date('h:i A', strtotime(date('Y-m-d h:i:s')));


            $oldTimeAmPm = (substr($oldDateTime,6,6));
            $currentTimeAmPm = (substr($currentTime,6,6));

            if ($oldTimeAmPm == 'AM' && $currentTimeAmPm == 'AM')
            {
                $InsertedHours = (intval(substr($oldDateTime, 3,3)) > 45)?(intval(substr($oldDateTime, 0,2)))+1:intval(substr($oldDateTime, 0,2));

                $currentTimeHours = intval(substr($currentTime,0,2));

                $actualHours =  $currentTimeHours - $InsertedHours;

                return $actualHours .' '.'Hours Ago';
            }
            elseif ($oldTimeAmPm == 'PM' && $currentTimeAmPm == 'PM')
            {
                $InsertedHours = (intval(substr($oldDateTime, 3,3)) > 45)?(intval(substr($oldDateTime, 0,2)))+1:intval(substr($oldDateTime, 0,2));

                $currentTimeHours = intval(substr($currentTime,0,2));

                $actualHours =  $currentTimeHours - $InsertedHours;

                return $actualHours.' '.'Hours Ago';
            }
            elseif ($oldTimeAmPm == 'AM' && $currentTimeAmPm == 'PM')
            {
                $InsertedHours = (intval(substr($oldDateTime, 3,3)) > 45)?(intval(substr($oldDateTime, 0,2)))+1:intval(substr($oldDateTime, 0,2));

                $currentTimeHours = intval(substr($currentTime,0,2));

                $actualHours =  $currentTimeHours + (12 - $InsertedHours);

                return $actualHours.' '.'Hours Ago';
            }
            elseif ($oldTimeAmPm == 'PM' && $currentTimeAmPm == 'AM')
            {
                $InsertedHours = (intval(substr($oldDateTime, 3,3)) > 45)?(intval(substr($oldDateTime, 0,2)))+1:intval(substr($oldDateTime, 0,2));

                $currentTimeHours = intval(substr($currentTime,0,2));

                $actualHours =  $currentTimeHours + (12 - $InsertedHours);

                return $actualHours.' '.'Hours Ago';
            }
        }
        else{
                if($daysNumber ==1)
                {
                    return $daysNumber.' '.'Day Ago';
                }
                else{
                    return $daysNumber.' '.'Days Ago';
                }
        }



    }
    public static function getDays($dateWithTime)
    {
        $startTimeStamp = strtotime(date("Y/m/d"));
        $myDate = substr($dateWithTime, 0, 10);
        $endTimeStamp = strtotime($myDate);
        $timeDiff = abs($endTimeStamp - $startTimeStamp);
        $numberDays = $timeDiff / 86400;
        return $numberDays;
    }

}