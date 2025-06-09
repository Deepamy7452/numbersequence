<?php

namespace Amy\Numbersequence\Helpers;

use Amy\numbersequence\Models\NumberSequenceV2;
use Amy\numbersequence\Models\NumberSequenceMapV2;

use Carbon\Carbon;

class NumberSeqHelper
{
    public static function get_next_no($type)
    {
        $map_data = NumberSequenceMapV2::where('map_name', $type)->first();
        if (!$map_data || !$map_data->number_sequence_id) {
            return '';
        }

        // Load from config
        $typeMap = config('numbersequnce.map');
        if (!isset($typeMap[$type])) {
            return '';
        }
        $column = $typeMap[$type]['column'];
        $model = $typeMap[$type]['model'];
        $mod = 'App\Models\\' . $model;
        $sequence = NumberSequenceV2::where('id', $map_data->number_sequence_id)->first();
        $data = $mod::where($column, 'LIKE', "{$sequence->constant_no}%")->orderBy('id', 'DESC')->first();
        $next =1;
        if ($data) {
            $last = $data->$column;
            $start = strlen($last) - $sequence->range_no;
            $next = intval(substr($last, $start, $sequence->range_no)) + 1;
        }
        return strlen($next) <= $sequence->range_no ? $next : 'memory full';
    }

    public static function apply_no_sequence($type, $model, $column)
    {
        $typeMap = config('numbersequnce.map');
        if (!isset($typeMap[$type])) {
            return 0;
        }

        $model = $typeMap[$type]['model'];
        $column = $typeMap[$type]['column'];
        $mod = 'App\Models\\' . $model;
        $next = 1;
        $map_data = NumberSequenceMapV2::where('map_name', $type)->first();

        if (!$map_data?->number_sequence_id) {
            return 0;
        }

        $sequence = NumberSequenceV2::where('id', $map_data->number_sequence_id)->first();
            if (!$sequence?->range_no) {
            return 0;
        }

         // 1. Get all existing sequence values that match the prefix
        $existingCodes = $mod::where($column, 'LIKE', "{$sequence->constant_no}%") ->pluck($column)
        ->map(function ($val) use ($sequence){
            return (int) substr($val, strlen($sequence->constant_no));
        })
        ->filter()
        ->unique()
        ->sort()
        ->values();

        $next = 1;
        foreach ($existingCodes as $val) {
            if ($val == $next) {
                $next++;
            } elseif ($val > $next) {
                break;  // found a gap
            }
        }
          if ($next <= $existingCodes->last()) {
            // If a missing number was found in the middle
          }elseif($existingCodes->isNotEmpty()){
            $next = $existingCodes->last() + 1;
          }
          $new_no = str_pad($next, $sequence->range_no, "0", STR_PAD_LEFT);
          return $sequence->constant_no . $new_no ;
    }
}
