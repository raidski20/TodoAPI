<?php

namespace App\Enums;

enum StatusType: string
{
    case IN_PTOGRESS = 'in_progress';
    case FINISHED = 'finished';

    public static function getCasesValues(): array
    {
        return array_column(self::cases(), 'value');
    }

}