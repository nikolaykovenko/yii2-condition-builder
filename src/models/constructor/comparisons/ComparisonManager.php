<?php
namespace micetm\conditions\models\constructor\comparisons;

use micetm\conditions\models\constructor\comparisons\aggregations\SizeComparison;
use micetm\conditions\models\constructor\conditions\Condition;

class ComparisonManager
{
    const AVAILABLE_COMPARISONS = [
        SizeComparison::class,
        RangeComparison::class,
        LikeComparison::class,
        InComparison::class,
        DefaultComparison::class
    ];

    public function getComparison(Condition $condition): ComparisonInterface
    {
        foreach (self::AVAILABLE_COMPARISONS as $className) {
            if ($className::isMaster($condition)) {
                return new $className();
            }
        }
    }
}
