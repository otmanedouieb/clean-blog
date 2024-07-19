<?php






function format_date($time): string
{
    $time = strtotime($time);
    $month = date('M', $time);
    $day = date('d', $time);
    $year = date('Y', $time);

    return $day . ', ' . $month . ' ' . $year;
}
