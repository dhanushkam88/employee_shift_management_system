<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Shift\ShiftManageRepositoryInterface;
use App\Repositories\Calander\CalanderRepositoryInterface;

class AdminProfileController extends Controller
{
    private $userRepo;
    private $shiftRepo;
    private $calanderRepo;


    public function __construct(
        UserRepositoryInterface $userRepository,
        ShiftManageRepositoryInterface $shiftManageRepository,
        CalanderRepositoryInterface $calanderRepository
    )
    {
        $this->userRepo = $userRepository;
        $this->shiftRepo = $shiftManageRepository;
        $this->calanderRepo = $calanderRepository;
    }

    public function userManagement()
    {
        $user = $this->userRepo->viewAllUser();
        $findUserRoles = $this->userRepo->userRoles();
        return view('user.adminUser.userManagement')->with('user',$user)->with('roles',$findUserRoles);
    }

    public function createEmployee(Request $request)
    {
        $request->validate([
            'fullName' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|max:100|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/
                |
                confirmed:password_confirmation',
            'password_confirmation' =>  'required',
            'contactNumber' => 'required',
            'userRole' => 'required',
        ]);

        $createUser = $this->userRepo->createUser($request);
        Session::flash('message', 'User Create Successfully');
        return back();
    }

    public function viewAllUserProfile()
    {
        $allUsers = $this->userRepo->viewAllUser();
        $findUserRoles = $this->userRepo->userRoles();
        return view('user.adminUser.viewUserProfile')->with('users',$allUsers)
            ->with('userRoles', $findUserRoles);
    }

    public function updateUserProfile(Request $request)
    {
        $request->validate([
            'email' => 'unique:users',
        ]);
        $updateProfile = $this->userRepo->updateProfile($request);
        $allUsers = $this->userRepo->viewAllUser();
        $findUserRoles = $this->userRepo->userRoles();
        Session::flash('message', 'User Updated Successfully');
        return view('user.adminUser.viewUserProfile')->with('users',$allUsers)
            ->with('userRoles', $findUserRoles);
    }

    public function deleteUser()
    {
        $allUsers = $this->userRepo->viewAllUser();
        return view('user.adminUser.deleteUserProfile')->with('users',$allUsers);
    }

    public function deleteUserConfirm(Request $request)
    {
        $variable = 'DELETE';
        $request->validate([
            'userId' => 'required|max:255',
            'confirm' => 'required|in:'.$variable,
        ]);
        $deleteUser = $this->userRepo->deleteUser($request->userId);
        Session::flash('message', 'User Deleted Successfully');
        return back();
    }

    public function calander(Request $request)
    {
        $request->validate([
            'start' => 'required',
            'end' => 'required',
        ]);
        return $this->calanderRepo->calanderInfo($request);
    }

    public function employeeManagement()
    {
        $employees = $this->shiftRepo->allEmployeeList();
        return view('employee.employeeManagement')->with('employees',$employees);
    }

    public function createMyShiftRequest(Request $request)
    {
        $request->validate([
            'date' => 'required'
        ]);
        $createShiftRequest = $this->shiftRepo->shiftCreate($request);
        return view('employee.createEmployeeShift')->with($createShiftRequest);
    }

    public function createMyShift(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'shifts' => 'required',
            'employee' => 'required'
        ]);
        $creatShift = $this->shiftRepo->createMyShift($request);

        Session::flash('message', 'Employee Shift Created Successfully');
        return redirect()->route('employeeManagement');
    }

    public function editMyShiftRequest(Request $request)
    {
        $request->validate([
            'date' => 'required'
        ]);
        $editShiftRequest = $this->shiftRepo->editShiftRequest($request);
        return view('employee.editDeleteEmployeeShift')
            ->with('editShiftRequest',$editShiftRequest['availableShifts'])
            ->with('editUsers',$editShiftRequest['availableUsers']);
    }

    public function editMyShift(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'shift' => 'required',
            'name' => 'required',
            'selectShift' => 'required',
            'date' => 'required'
        ]);
        $editShift = $this->shiftRepo->editShift($request);
        Session::flash('message', 'Employee Shift Update Successfully');
        return response()->json();
    }

    public function deleteMyShift(Request $request)
    {
        $request->validate([
            'text' => [ Rule::in('DELETE')],
            'id' => 'required',
        ]);

        $deleteShift = $this->shiftRepo->deleteMyShift($request);
        Session::flash('message', 'Employee Shift Deleted Successfully');
        return response()->json();
    }
}

