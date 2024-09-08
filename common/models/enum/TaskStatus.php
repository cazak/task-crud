<?php

namespace common\models\enum;

enum TaskStatus: int
{
    case Active = 0;
    case Expired = 1;

    public static function getStatuses(): array
    {
        return [
            self::Active->value => self::Active->name,
            self::Expired->value => self::Expired->name,
        ];
    }
}
