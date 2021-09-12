<?php


namespace App\Service;
use App\Key;
use App\Model\History;
use App\Tool;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SummaryService
{
    public function getMoney(?string $type, ?string $startDate, ?string $endDate){
        $type = $type ? $type : 'week';
        list($startDate, $endDate) = $this->getStartAndEndDateByConditon($type, $startDate, $endDate);
        $moneySummary = [];
        if ($type === 'week' || $type === 'month' || $type === null) {
            while (strtotime($startDate) <= strtotime($endDate)) {
                if (Carbon::parse($startDate)->isTomorrow()) {
                    break;
                }
                $nextDay = date ("Y-m-d H:i:s", strtotime("+1 day", strtotime($startDate)));
                array_push($moneySummary, [
                    'data' => Carbon::parse($startDate)->format('Y-m-d'),
                    'money' => round(History::whereBetween('created_at', [$startDate, $nextDay])
                        ->whereIn('action', ['CHARGE_VIA_PAYPAL', 'CHARGE_VIA_COINPAYMENTS', 'ADMIN_CONG'])->sum('amount'),2),
                    'revenue' => round(History::whereBetween('updated_at', [$startDate, $nextDay])
                        ->sum('revenue'),2)
                ]);
                $startDate = $nextDay;
            }
        } else {
            $startMonth = (int)(Carbon::parse($startDate)->format('m'));
            $endMonth = (int)Carbon::parse($endDate)->format('m');
            $currentMonth = (int)now()->format('m');
            while ($startMonth <= $endMonth) {
                if ($currentMonth < $startMonth) {
                    break;
                }
                $endDateOfMonth = Carbon::parse($startDate)->endOfMonth()->format('Y-m-d');
                array_push($moneySummary, [
                    'data' => $startMonth,
                    'money' => round(History::whereBetween('created_at', [$startDate, $endDateOfMonth])
                        ->whereIn('action', ['CHARGE_VIA_PAYPAL', 'CHARGE_VIA_COINPAYMENTS', 'ADMIN_CONG'])->sum('amount'),2),
                    'revenue' => round(History::whereBetween('updated_at', [$startDate, $endDateOfMonth])
                        ->sum('revenue'),2)
                ]);
                $startDate = date ("Y-m-d", strtotime("+1 day", strtotime($endDateOfMonth)));
                $startMonth += 1;
            }
        }
        $tool = new Tool();
        $listTool = $tool->getAllTool();
        return [
            'money' => $moneySummary,
            'tool' => $listTool
        ];
    }

    /**
     * Top 5 key trong tháng
     *
     */
    public function getTopKey(?string $type,?string $startDate = ''){
        if($type == 'month') {
            $startDate = Carbon::parse($startDate)->startOfMonth()->format('Y-m-d H:i:s');
            $endDate = Carbon::parse($startDate)->endOfMonth()->format('Y-m-d H:i:s');
        } else {
            $startDate = Carbon::parse($startDate)->startOfDay()->format('Y-m-d H:i:s');
            $endDate = Carbon::parse($startDate)->endOfDay()->format('Y-m-d H:i:s');
        }
        $history = new History();
        $topKey = $history->getKeyTop($startDate, $endDate);
        return $topKey;
    }

    public function getKey(?string $type = '',array $keys, ?string $startDate = '', ?string $endDate = '', ?string $condition) {
        $tool = new Tool();
        $keySummary = [];
        $limit = null;
        sort($keys);
        if ($type === 'week' || $type === 'month' || $type === null) {
            list($startDate, $endDate) = $this->getStartAndEndDateByConditon($type, $startDate, $endDate);
            while (strtotime($startDate) <= strtotime($endDate)) {
                if (Carbon::parse($startDate)->isTomorrow()) {
                    break;
                }
                $nextDay = date ("Y-m-d H:i:s", strtotime("+1 day", strtotime($startDate)));
                $countKey = $tool->getAllWithEachTool($startDate, $nextDay, $keys)->toArray();
                if (count($keys) !== count($countKey)) {
                    foreach ($keys as $key) {
                        if(array_search($key, array_column($countKey, 'id')) === false) {
                            array_push($countKey,[
                                'id' => (int)$key,
                                'count' => 0
                            ]);
                        }
                    }
                }
                $keySummary[] = [
                    'date' => Carbon::parse($startDate)->format('Y-m-d'),
                    'data' => $countKey
                ];
                $startDate = $nextDay;
            }
        } else {
            if (!$condition) {
                list($startDate, $endDate) = $this->getStartAndEndDateByConditon($type, $startDate, $endDate);
                $startMonth = (int)(Carbon::parse($startDate)->format('m'));
                $endMonth = (int)Carbon::parse($endDate)->format('m');
                $currentMonth = (int)now()->format('m');
                while ($startMonth <= $endMonth) {
                    if ($currentMonth < $startMonth) {
                        break;
                    }
                    $endDateOfMonth = Carbon::parse($startDate)->endOfMonth()->format('Y-m-d H:i:s');
                    $countKey = $tool->getAllWithEachTool($startDate, $endDateOfMonth, $keys)->toArray();
                    if (count($keys) !== count($countKey)) {
                        foreach ($keys as $key) {
                            if(array_search($key, array_column($countKey, 'id')) === false) {
                                array_push($countKey,[
                                    'id' => (int)$key,
                                    'count' => 0
                                ]);
                            }
                        }
                    }
                    $keySummary[] = [
                        'date' => $startMonth,
                        'data' => $countKey,
                    ];
                    $startDate = date ("Y-m-d", strtotime("+1 day", strtotime($endDateOfMonth)));
                    $startMonth += 1;
                }
            } else {
                $startMonth = (Carbon::parse($startDate)->startOfMonth()->format('Y-m-d H:i:s'));
                $endDateOfMonth = Carbon::parse($startMonth)->endOfMonth()->format('Y-m-d H:i:s');
                $keySummary = [
                    'date' => $startMonth,
                    'data' =>  $tool->getAmountKeyByPackage($startMonth, $endDateOfMonth, $keys[0])
                ];
            }
        }

        return [
            'result' => true,
            'responseCode' => 1,
            'data' => $keySummary
        ];
    }

    public function getSoldKey(?string $type, ?string $startDate, ?string $endDate)
    {
        if(!isset($type)) {
            $type = 'day';
        }
        try {
            list($startDate, $endDate) = $this->getStartAndEndDateByConditon($type, $startDate, $endDate);
            $key = new Key();
            $keySold = $key->getSoldKey($startDate, $endDate);
        } catch (\Exception $e) {
            return [
              'responseCode' => 0,
              'result' => false,
            ];
        }

        return [
            'responseCode' => 1,
            'result' => true,
            'data' => $keySold
        ];

    }

    private function getStartAndEndDateByConditon(?string $type, ? string $startDate, ? string $endDate): array {

        $initStartDate = $startDate ? Carbon::parse($startDate) : now();
        $initEndDate = $endDate ? Carbon::parse($endDate) : now();
        switch ($type) {
            case 'day':
                $startDate = $initStartDate->startOfDay();
                $endDate = (clone ($initStartDate))->addDay(1)->startOfDay();
                break;
            case 'week':
                $startDate = $initStartDate->startOfWeek();
                $endDate = $initEndDate->endOfWeek();
                break;
            case 'month':
                $startDate = $initStartDate->startOfMonth();
                $endDate = $initEndDate->endOfMonth();
                break;
            case 'year':
                $startDate = $initStartDate->startOfYear();
                $endDate = $initEndDate->endOfYear();
                break;
        }
        $startDate = $startDate->format('Y-m-d H:i:s');
        $endDate = $endDate->format('Y-m-d H:i:s');

        return array($startDate, $endDate);
    }


}
