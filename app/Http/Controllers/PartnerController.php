<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;

class PartnerController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::paginate(25);
        return view('partners.index', ['partners'=>$partners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partners.create');
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
            'phone' => 'required|string|max:15',
            'email' => 'required|string|max:255'
        ], [
            'name.required' => 'Tên nhà cung cấp không được bỏ trống',
            'name.max' => 'Tên nhà cung cấp không dài quá 255 ký tự',
            'phone.required' => 'Số điện thoại không được bỏ trống',
            'phone.max' => 'Số điện thoại không dài hơn 15 ký tự',
            'email.required' => 'Email không được bỏ trống',
            'email.max' => 'Email không dài hơn 255 ký tự'
        ]);

        if ($validator->fails()) {
            return redirect('partners/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $partner = new Partner;
            $partner->name = $request->name;
            $partner->phone = $request->phone;
            $partner->email = $request->email;
            $partner->active = $request->active;
            $partner->save();
            return redirect('partners');
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
        $partner = Partner::find($id);
        return view('partners.edit', ['partner' => $partner]);
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
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ], [
            'name.required' => 'Tên nhà cung cấp không được bỏ trống',
            'name.max' => 'Tên nhà cung cấp không dài quá 255 ký tự',
            'phone.required' => 'Số điện thoại không được bỏ trống',
            'phone.max' => 'Số điện thoại không dài hơn 15 ký tự',
            'email.required' => 'Email không được bỏ trống',
            'email.max' => 'Email không dài hơn 255 ký tự'
        ]);

        if ($validator->fails()) {
            return redirect('partners/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $partner = Partner::find($id);
            $partner->name = $request->name;
            $partner->phone = $request->phone;
            $partner->email = $request->email;
            $partner->active = $request->active;
            $partner->save();
            return redirect('partners');
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
        $partner = Partner::find($id);
        if(isset($partner)){
            $partner->delete();
        }
        return back();
    }
}
