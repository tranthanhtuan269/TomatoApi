<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Order;
use App\DailyReport;
use App\WeeklyReport;
use App\MonthlyReport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = DailyReport::paginate(25);
        return view('report.index', ['reports'=>$reports]);
    }

    public function daily(Request $request){
        if(!isset($request->date)){
            $today = date("Y-m-d");
        }else{
            $today =  $request->date;
        }
        $orderList = Order::where('updated_at', '>', $today . ' 00:00:00')->where('updated_at', '<=', $today . ' 23:59:59')->where('state', '=', 2)->get();
        $data = DailyReport::firstOrCreate(['name' => $today]);
        return view('report.daily', ['orderList' => $orderList, 'data' => $data]);
    }

    public function weekly(){
        $week = date("Y-W");
        $day = date('w');
        $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
        $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
        $dailyList = DailyReport::where('updated_at', '>', $week_start . ' 00:00:00')->where('updated_at', '<=', $week_end . ' 23:59:59')->get();
        $data = WeeklyReport::firstOrCreate(['name' => $week]);
        return view('report.weekly', ['dailyList' => $dailyList, 'data' => $data]);
    }

    public function monthly(){
        $month = date("Y-m");
        $today = date("Y-m-d");
        $dailyList = DailyReport::where('updated_at', '>', $month . '-01 00:00:00')->where('updated_at', '<=', $today . ' 23:59:59')->get();
        $data = MonthlyReport::firstOrCreate(['name' => $month]);
        return view('report.monthly', ['dailyList' => $dailyList, 'data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
