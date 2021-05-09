<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * @property string content
 * @property int amount
 * @property int user_id
 * @property string action
 * @property string nl_token
 * @property string created_at
 * @property int id
 * @property string content_eng
 */
class History extends Model
{
    public function getKeyTop(string $startDate, string $endDate){
        $selectData = [
            DB::raw('count(ke.id) as "count"'),
            'tl.name as name',
        ];
        $result = History::from('histories as hi')
            ->select($selectData)
            ->leftJoin('keys as ke', 'ke.history_id', 'hi.id')
            ->leftJoin('tools as tl', 'tl.id', 'ke.tool_id')
            ->where('hi.action', 'BUY_KEY')
            ->where('hi.updated_at', '>=', $startDate)
            ->where('hi.updated_at', '<=', $endDate)
            ->groupBy('ke.tool_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
        return $result;
    }
}
