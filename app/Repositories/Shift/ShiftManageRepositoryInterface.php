<?php

namespace App\Repositories\Shift;

interface ShiftManageRepositoryInterface
{
    public function allEmployeeList();
    public function shiftCreate($data);
    public function createMyShift($data);
    public function editShiftRequest($data);
    public function editShift($data);
    public function deleteMyShift($data);
}
