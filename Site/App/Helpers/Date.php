<?php
 
class Date
{
    public static function Now()
    {
        return gmdate('Y-m-d H:i:s');
    }

    public static function Timezone($date, $timezone = 0)
    {
        $time = strtotime($date);
        $time += $timezone * 3600;
        return gmdate('Y-m-d H:i:s', $time);
    }

    public static function Format($format, $date)
    {
        return gmdate($format, strtotime($date));
    }

    public static function DiffDays($date1, $date2)
    {
        return abs(floor((strtotime($date1) - strtotime($date2)) / (60 * 60 * 24)));
    }
}

?>