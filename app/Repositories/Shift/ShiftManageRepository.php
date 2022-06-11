<?php
namespace App\Repositories\Shift;

use App\Models\User;
use App\Models\Event;
use App\Models\shift;


class ShiftManageRepository implements ShiftManageRepositoryInterface
{
    public function allEmployeeList()
    {
        $user = User::whereHas("roles", function($q){ $q->where("name", "!=", "admin"); })->get();
        return $user;
    }

    public function shiftCreate($data)
    {
        $shiftsInfo = new Event;
        $shift= $shiftsInfo ->where('date',$data->date)->get(['shift_id']);
        $user = $shiftsInfo->where('date',$data->date)->get(['user_id']);
        if(count($shift) > 0) {
            $availableShifts = Shift::whereNotIn('id',$shift)
                ->get(['id','shift_start','shift_end']);
            $availableUsers = User::whereNotIn('id',$user)
                ->get(['id','name']);
            $date = $data->date;
            return ['availableShifts' => $availableShifts, 'availableUsers' => $availableUsers,
                'date' => $date];
        } else {
            $availableShifts = shift::get(['id','shift_start','shift_end']);
            $availableUsers = User::where('status','!=', 1)->get(['id','name']);
            $date = $data->date;
            return ['availableShifts' => $availableShifts, 'availableUsers' => $availableUsers,
                'date' => $date];
        }
    }

    public function createMyShift($data)
    {
        $userInfo = User::where('id',$data->employee)->first();
        $addDataToDb = Event::create([
            'user_id' => $data->employee,
            'title' => $userInfo->name,
            'date' => $data->date,
            'shift_id' => $data->shifts
        ]);
        return $addDataToDb;
    }

    public function editShiftRequest($data)
    {
        $availableShifts = '';
        $shiftsInfo = new Event;
        $shifts = $shiftsInfo->where('date',$data->date)->get();
        $user = $shiftsInfo->where('date',$data->date)->get(['user_id']);
        $availableUsers = User::whereNotIn('id',$user)->get(['id','name']);
        if(count($shifts) >0){
            $availableShifts = [];
            foreach($shifts as $key => $shift) {
                $availableShifts[$key]['id'] = $shift->id;
                $availableShifts[$key]['user_id'] = $shift->user_id;
                $availableShifts[$key]['title'] = $shift->title;
                $availableShifts[$key]['date'] = $shift->date;
                $availableShifts[$key]['shift_id'] = Shift::where('id',$shift->shift_id)->first();
            }
        }

        return ['availableShifts' => $availableShifts, 'availableUsers' => $availableUsers];
    }

    public function editShift($data)
    {
        $event = Event::find($data->id);
        if(!empty($data->changeEmp)){
            $user = User::where('id',$data->changeEmp)->first();
            $event->user_id = $data->changeEmp;
            $event->title = $user->name;
        } else{
            $event->user_id = $data->userid;
            $event->title = $data->name;
        }
        $event->date = $data->date;
        $event->shift_id = $data->shift;
        $event->save();

        return $event;
    }

    public function deleteMyShift($data)
    {
        return Event::where('id',$data->id)->delete();
    }
}
