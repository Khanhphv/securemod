<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property string key
 * @property int tool_id
 * @property int package
 * @property int user_id
 * @property int history_id
 */
class Key extends Model
{
    protected $fillable = [
        'key', 'tool_id', 'package','user_id', 'history_id', 'created_at','updated_at'
    ];
    public  function getToolName()
    {
        return $this->belongsTo('App\Tool','tool_id');
    }

    public function getSoldKey(string $startDate, string $endDate)
    {
        DB::connection()->enableQueryLog();
        $result = Key::from('keys as ke')
            ->selectRaw('tl.id, tl.name as name , ke.package, COUNT(ke.id) AS soLuong, sum(hi.amount) AS sum')
            ->join('histories as hi', 'hi.id', 'ke.history_id')
            ->join('tools as tl', 'tl.id' , 'ke.tool_id')
            ->where('ke.sold', '1')
            ->where('ke.updated_at', '>=', $startDate)
            ->where('ke.updated_at', '<', $endDate)
            ->groupBy('ke.tool_id', 'ke.package')
            ->get();
            $queries = DB::getQueryLog();

            \Log::info($queries);
        return $result;
    }
}
