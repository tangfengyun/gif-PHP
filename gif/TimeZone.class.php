<?php
/**
 * Created by PhpStorm.
 * User: MorBro
 * Date: 2020/4/8
 * Time: 11:19
 * Desc: 存放所有时区
 */

const SHANG_HAI  = 'Asia/Shanghai'; //亚洲-上海
const AMERICA  = 'America/New_York'; //美国-纽约
const T_PST  = 'PST'; //太平洋时间（西部时间）


class TimeZone {

    private static $_timezone;
    /**
     * 根据时区转换时间
     * @param string $time 待转换时间
     * @param string $to_zone 转换时区
     * @param string $from_zone 待转换时间时区
     * @return string
     */
    function translate_time($time, $to_zone, $from_zone='Asia/Shanghai'){
        $cur_time = new Datetime($time, new DateTimeZone($from_zone));
        $cur_time->setTimezone(new DateTimeZone($to_zone));
        return $cur_time->format('Y-m-d H:i:s');
    }

    /**
     * @desc 获取时区
     * @author MorBro
     * @param int $timezone 时区类型
     * @return string
     */
    function get_time_zone($timezone = 0){

        //所有时区，后期可以随意增加
        self::$_timezone = [
            '0' => SHANG_HAI,
            '1' => AMERICA,
            '2' => T_PST,
        ];
        return isset(self::$_timezone[$timezone]) ? self::$_timezone[$timezone] : SHANG_HAI;
    }
}


