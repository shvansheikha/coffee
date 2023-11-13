<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Game()
 * @method static static Product()
 */
final class GroupType extends Enum
{
    const Game = 0;
    const Product = 1;
}
