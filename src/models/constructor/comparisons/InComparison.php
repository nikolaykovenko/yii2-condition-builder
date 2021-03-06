<?php

namespace micetm\conditions\models\constructor\comparisons;

use micetm\conditions\models\constructor\attributes\AbstractAttribute;
use micetm\conditions\models\constructor\conditions\Condition;
use micetm\conditions\models\constructor\queries\Query;

class InComparison implements ComparisonInterface
{
    public static function isMaster(Condition $condition): bool
    {
        return AbstractAttribute::MORE_THAN_ONE_IN_COMPARISON === $condition->comparison;
    }

    public function buildFilter(Condition $condition): array
    {
        $query["bool"][Query::OPERATOR_OR][]["terms"][$condition->attribute . ".raw"]
            = is_array($condition->value) ? $condition->value : [$condition->value];
        $query["bool"][Query::OPERATOR_OR][]["terms"][$condition->attribute]
            = is_array($condition->value) ? $condition->value : [$condition->value];
        ;
        return $query;
    }
}
