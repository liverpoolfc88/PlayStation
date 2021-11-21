<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpseclib\System\SSH\Agent\Identity;
use App\Room;
use App\RoomTime;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Room::all();
    }

    public function busy(Request $request)
    {
        $room_id = $request['id'];
        $user_id = Auth::id();

        $model = Room::find($room_id);



        if ($model->status == 0) {
            $model_time = new RoomTime();
            $model_time->room_id = $room_id;
            $model_time->on_time = time();
            $model_time->room_sum = $model->price;
            $model_time->created_by = $user_id;
            $model_time->save();
        }else {
            $model_time = RoomTime::where('room_id', $room_id)->whereNull('off_time')->first();
            $model_time->off_time = time();
            $model_time->updated_by = $user_id;
            $model_time->time_range = $model_time->off_time - $model_time->on_time;
            $model_time->sum = $model_time->time_range * $model_time->room_sum;
            $model_time->save();
        }

        $model->status = ($model->status == 1) ? 0 : 1;
        $model->save();

//       $model_time->room_id = $request['id'];
//       $model_time->room_id = $request['id'];


        return [$request['id'], $model_time];
    }

    public function work(Request $request)
    {
        $id = Auth::id();

        $type = $request['type'];

        $model = ($type == 'all') ? Room::where('user_id', $id) : Room::where('user_id', $id)->where('status', $type);

        return $model->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

//    public function update(Request $request)
//    {
//        $model = Futball::find($request->input('id'));
//        if(!$model){
//            $model = new Futball();
//        }
//        else{
//        }
//        $model->name = $request->input('name');
//        $model->age = $request->input('age');
//        $model->rating = $request->input('rating');
//        $model->country = $request->input('country');
//        $model->youtube_link = $request->input('youtube_link');
//        $model->number = $request->input('number');
//        $model->save();
//
//
//        return "delete ishladi!";
//    }
    public function update(Request $request)
    {
        $model = Room::find($request->input('id'));
        $model = (!$model) ? new Room() : $model;
        $model->name = $request['name'];
        $model->price = $request['price'];
//        $model->photo = $request['photo'];
        $model->photo = 'sadasds';
        $model->status = $request['status'];
//        user->id
//        $model->user_id = Auth::user();
        $model->user_id = 1;
        $model->save();

        return 'xamasi ok!';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Room::find($id);
        $model->delete();
    }
}
