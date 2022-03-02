<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusType extends Enum
{
    const Open =   "OPEN";
    const Process =   "ON PROCESS";
    const ClosedDebet =   "CLOSED / DEBET";
    const ClosedRepresentment =   "CLOSED / REPRESENTMENT";
    const ClosedLoss =   "CLOSED / LOSS";
    const Closed =   "CLOSED";
}
