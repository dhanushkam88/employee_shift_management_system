<?php
namespace App\Repositories\Calander;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\UserLevel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CalanderRepository implements CalanderRepositoryInterface
{
    public function calanderInfo($request)
    {
        $user = Auth::user();

        if($request->ajax())
        {
            $firstDate = strtotime($request->start);
            $secondDate = strtotime($request->end);
            $from_date = date('Y-m-d', $firstDate);
            $to_date = date('Y-m-d', $secondDate);

            if($user->hasRole('employee')) {
                $data = Event::whereBetween('date',[$from_date, $to_date])
                        ->where('user_id',$user->id)
                        ->join('users', 'users.id', '=', 'events.user_id')
                        ->join('shifts', 'shifts.id', '=', 'events.shift_id')
                        ->get();
            } else {
                $data = Event::whereBetween('date',[$from_date, $to_date])
                        ->join('users', 'users.id', '=', 'events.user_id')
                        ->join('shifts', 'shifts.id', '=', 'events.shift_id')
                        ->get();
            }

            $getCalanderData = [];
            foreach($data as $key => $calandersDate) {
                $getCalanderData[$key]['id'] = $calandersDate->id;
                $getCalanderData[$key]['title'] = $calandersDate->name;
                $getCalanderData[$key]['start'] = $calandersDate->date.' '.$calandersDate->shift_start;
                $getCalanderData[$key]['end'] = $calandersDate->date.' '.$calandersDate->shift_end;
            }
            return response()->json($getCalanderData);
        }
    }
}
