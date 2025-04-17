<?php

namespace Utils;

use Godruoyi\Snowflake\Snowflake;

class SnowFlakeId {
    public static function generate(): string {
        $snowFlake = new Snowflake();
        $snowFlake->setStartTimeStamp((int)strtotime('2025-01-01') * 1000);

        return $snowFlake->id();
    }
}