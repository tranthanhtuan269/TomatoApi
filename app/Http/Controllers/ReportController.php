<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Order;
use App\DailyReport;

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

    public function daily(){
        $today = date("Y-m-d");
        $orderList = Order::where('updated_at', '>', $today . ' 00:00:00')->where('updated_at', '<=', $today . ' 23:59:59')->where('state', '=', 2)->get();
        $data = DailyReport::firstOrCreate(['name' => $today]);
        return view('report.daily', ['orderList' => $orderList, 'data' => $data]);
    }

    public function weekly(){

        return view('report.weekly');
    }

    public function monthly(){

        return view('report.monthly');
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
