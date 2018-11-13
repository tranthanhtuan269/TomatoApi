<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Service;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate(25);
        return view('coupons.index', ['coupons'=>$coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::where('parent_id', 0)->where('active', 1)->pluck('name', 'id');
        return view('coupons.create', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'required',
            'expiration_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the order.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }else{
            $coupon = new Coupon;
            $coupon->name = $request->name;
            $coupon->value = $request->value;
            $coupon->service_id = isset($request->service_id)?$request->service_id:0;
            $coupon->expiration_date = date("Y-m-d H:i:s", strtotime($request->expiration_date));
            $coupon->save();
            return redirect('coupons');
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $services = Service::where('parent_id', 0)->where('active', 1)->pluck('name', 'id');
        return view('coupons.edit', ['services' => $services, 'coupon' => $coupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'value' => 'required',
            'expiration_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the order.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }else{
            $coupon = Coupon::find($id);
            $coupon->name = $request->name;
            $coupon->value = $request->value;
            $coupon->service_id = isset($request->service_id)?$request->service_id:0;
            $coupon->expiration_date = date("Y-m-d H:i:s", strtotime($request->expiration_date));
            $coupon->save();
            return redirect('coupons');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if(isset($coupon)){
            $coupon->delete();
        }
        return back();
    }
}
