<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Transformers\OrderTransformer;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = fractal()
                ->collection(Order::get())
                ->parseIncludes(['user'])
                ->transformWith(new OrderTransformer)
                ->toArray();

        return response()->json([
            'status_code' => 200,
            'message' => 'List orders',
            'orders' => $orders
        ], 200);
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
            'address' => 'required|string|max:255',
            'note' => 'required|string|max:255',
            'start_time' => 'required|string|max:255',
            'end_time' => 'required|string|max:255',
            'price' => 'required',
            'list_packages' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to create the job.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $order = new Order([
            'user_id' => $request->user()->id,
            'address' => $request->address,
            'note' => $request->note,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'user_id' => $request->user()->id,
            'state' => 0,
            'price' => $request->price,
            'pay_type' => $request->pay_type
        ]);

        if($order->save()){
            $list_package = json_decode($request->list_packages);
            
            $order->packages()->attach($request->package);
            $item = fractal()
                ->item($job)
                ->transformWith(new JobTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 201,
                'message' => 'The job has been created',
                'job' => $item
            ], 201);    
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Failed to create a new job.',
            ], 200);
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
        $job = Job::find($id);
        if($job){
            $finder = fractal()
                ->item($job)
                ->parseIncludes(['user'])
                ->transformWith(new JobTransformer)
                ->toArray();

            return response()->json([
                'status_code' => 200,
                'message' => 'OK',
                'job' => $finder
            ], 200);
        }else{
            return response()->json([
                'status_code' => 204,
                'message' => 'Not found this job.'
            ], 200);
        }
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
            'address' => 'required|string|max:255',
            'note' => 'required|string|max:255',
            'start_time' => 'required|string|max:255',
            'end_time' => 'required|string|max:255',
            'price' => 'required',
            'package' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'status_code' => 422,
                    'message' => 'Failed to update the job.',
                    'errors' => $validator->errors()->all()
                ], 200);
        }

        $job = Job::find($id);

        if($job){
            $job->address = $request->address;
            $job->note = $request->note;
            $job->start_time = $request->start_time;
            $job->end_time = $request->end_time;
            $job->user_id = $request->user()->id;
            $job->state = 0;

            $job->save();

            $order = Order::where('user_id', $request->user()->id)
                            ->where('job_id', $id)
                            ->first();

            if(isset($order)){
                $order->price = $request->price;
                $order->pay_type = $request->pay_type;
                if($order->save()){
                    $request->user()->jobs()->attach($job->id);
                    $job->packages()->attach($request->package);
                    $item = fractal()
                        ->item($job)
                        ->transformWith(new JobTransformer)
                        ->toArray();

                    return response()->json([
                        'status_code' => 201,
                        'message' => 'The job has been updated',
                        'job' => $item
                    ], 201);    
                }else{
                    return response()->json([
                        'status_code' => 202,
                        'message' => 'Failed to update a job',
                    ], 200);
                }
            }else{
                $item = fractal()
                        ->item($job)
                        ->transformWith(new JobTransformer)
                        ->toArray();

                    return response()->json([
                        'status_code' => 201,
                        'message' => 'The job has been updated',
                        'job' => $item
                    ], 201); 
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this job.',
            ], 200);
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
        $job = Job::find($id);
        if($job){
            if($job->delete()){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Delete this job successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 202,
                    'message' => 'Failed to delete this job.',
                ], 202);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Not found this job.',
            ], 200);
        }
    }
}
