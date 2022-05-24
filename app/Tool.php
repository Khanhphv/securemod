<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\Game;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tool extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'order', 'logo', 'youtube', 'package', 'link', 'updated', 'active', 'updated_at', 'created_at', 'reseller', 'cost', 'link_backup', 'game_id','description_eng','content_eng'
    ];

    public function key()
    {
        return $this->hasMany(Key::class, 'tool_id');
    }

    public function game()
    {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }

    protected $dates = ['deleted_at'];

    public function getAllTool() {
        $selectData = [
            'tl.id',
            'tl.name',
        ];

        $result = Tool::from('tools as tl')
            ->select($selectData)
            ->get();

        return $result;
    }
    public function getAllWithEachTool(string $startDate, string $endDate, array $key) {
        $selectData = [
            'tl.id',
            DB::raw('count(hi.id) as count')
        ];

        $result = Key::from('keys as ke')
            ->select($selectData)
            ->leftJoin('tools as tl', 'ke.tool_id', 'tl.id')
            ->leftJoin('histories as hi', 'ke.history_id', 'hi.id')
            ->where('hi.action', 'BUY_KEY')
            ->where('hi.updated_at', '>=', $startDate)
            ->where('hi.updated_at', '<=', $endDate)
            ->groupBy('tl.name')
            ->orderBy('tl.id', 'asc');
        if (count($key) > 0) {
            $result->whereIn('tl.id', $key);
        }
        return $result->get();
    }

    public function getAmountKeyByPackage(string $startDate, string $endDate, ?string $key) {
        $selectData = [
            DB::raw('count(hi.id) as "amount"'),
            DB::raw('sum(hi.amount) as money'),
            'ke.package'
        ];

        $result = Tool::from('tools as tl')
            ->select($selectData)
            ->join('keys as ke', 'ke.tool_id', 'tl.id')
            ->leftJoin('histories as hi', 'ke.history_id', 'hi.id')
            ->where('hi.action', 'BUY_KEY')
            ->where('hi.updated_at', '>=', $startDate)
            ->where('hi.updated_at', '<=', $endDate)
            ->where('tl.id', $key)
            ->groupBy('ke.package')
            ->get();
        return $result;
    }
}
