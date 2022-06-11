<?php

namespace Tests\Unit;

use App\Models\Event;
use Tests\TestCase;
use App\Models\User;
use App\Models\shift;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $empRole = Role::create(['name' => 'employee']);
        $empRole->givePermissionTo(Permission::where('id',4)->first());
        $shift = Shift::create([
            'shift_start' => '00:00:00',
            'shift_end' => '08:00:00',
        ]);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        $this->user = User::factory()->create();
        $this->user = $this->user->assignRole("admin");
    }

    public function test_if_admin_can_access_to_calender() : void
    {
        $response = $this->actingAs($this->user)->get(route('fullCalender',[
            'start' => '2022-06-05T00:00:00', 'end' => '2022-06-12T00:00:00',
            '_token' => csrf_token()
        ]))
        ->assertStatus(200);
    }

    public function test_if_admin_can_access_to_user_management_section() : void
    {
        $response = $this->actingAs($this->user)->get(route('userManagement'))->assertStatus(200);
    }

    public function test_if_admin_can_view_all_the_users() : void
    {
        User::factory()->create();
        $this->assertDatabaseCount('users', 2);
        $user = User::role('admin')->first();
        $response = $this->actingAs($this->user)->get(route('viewAllUserProfile', [
            'dashboard' => $user->id,
            '_token' => csrf_token()
            ]))
            ->assertStatus(200);
    }

    public function test_if_admin_can_create_user() : void
    {
        $response = $this->actingAs($this->user)->post(route('createEmployee',[
            '_token' => csrf_token(),
            'fullName' => 'Manisha fernando',
            'email' => 'employee_two@test.com',
            'password' => 'Dhanushka@88',
            'password_confirmation' => 'Dhanushka@88',
            'contactNumber' => '0711330012',
            'userRole' => 2,
        ]))
        ->assertStatus(302);

        $this->assertDatabaseCount('users', 2);
    }

    public function test_if_admin_can_update_user() : void
    {
        User::factory()->create([
            'name' => 'Manisha fernando',
            'email' => 'employee_two@test.com',
            'password' => 'Dhanushka@88',
            'contact' => '0711330012',
        ])->assignRole('employee');

        $this->assertDatabaseCount('users', 2);
        $user = User::role('employee')->first();

        $response = $this->actingAs($this->user)->post(route('updateUserProfile',[
            '_token' => csrf_token(),
            'userId' => $user->id,
            'fullName' => 'Romesh Sugathapala',
            'email' => 'romesh@test.com',
            'password' => 'Dhanushka@88',
            'password_confirmation' => 'Dhanushka@88',
            'contactNumber' => '0711330012',
            'userRole' => 2,
        ]))
        ->assertStatus(200);

        $user = User::role('employee')->first();

        $this->assertDatabaseCount('users', 2);
        $this->assertEquals('Romesh Sugathapala', $user->name);
    }

    public function test_if_admin_can_delete_user() : void
    {
        User::factory()->create()->assignRole('employee');

        $this->assertDatabaseCount('users', 2);

        $customer = User::role('employee')->first();
        $confirm = 'DELETE';

        $response = $this->actingAs($this->user)->post(route('deleteUserConfirm', [
            '_token' => csrf_token(),
            'userId' => $customer->id,
            'confirm' => $confirm,
            ]))
            ->assertStatus(302);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_if_admin_can_access_employee_management_section() : void
    {
        $response = $this->actingAs($this->user)->get(route('employeeManagement'))->assertStatus(200);
    }

    public function test_if_admin_can_create_employee_shift() : void
    {
        $response = $this->actingAs($this->user)->post(route('createMyShift',[
            '_token' => csrf_token(),
            'date' => '2022-06-11',
            'shifts' => '1',
            'employee' => '1',
        ]))
        ->assertStatus(302);

        $this->assertDatabaseCount('events', 1);
    }

    public function test_if_admin_can_edit_employee_shift() : void
    {
        User::factory()->create([
            'name' => 'Manisha fernando',
            'email' => 'employee_two@test.com',
            'password' => 'Dhanushka@88',
            'contact' => '0711330012',
        ])->assignRole('employee');

        $empUser = User::role('employee')->first();
        $shift = Shift::all()->first();

        $event = Event::create([
            'user_id' => $this->user->id,
            'title' => $this->user->name,
            'date' => '2022-06-11',
            'shift_id' => $shift->id,
        ]);

        $response = $this->actingAs($this->user)->post(route('editMyShift', [
            '_token' => csrf_token(),
            'id' => $event->id,
            'shift' => $shift->id,
            'userid' => $this->user->id,
            'name' => $this->user->name,
            'changeEmp' => $empUser->id,
            'selectShift' => '00:00:00 - 08:00:00',
            'date' => '2022-06-11',
            ]))
            ->assertStatus(200);
    }

    public function test_if_admin_can_delete_employee_shift() : void
    {
        $empUser = User::role('employee')->first();
        $shift = Shift::all()->first();

        $event = Event::create([
            'user_id' => $this->user->id,
            'title' => $this->user->name,
            'date' => '2022-06-11',
            'shift_id' => $shift->id,
        ]);

        $response = $this->actingAs($this->user)->post(route('deleteMyShift', [
            '_token' => csrf_token(),
            'id' => $event->id,
            'text' => 'DELETE'
            ]))
            ->assertStatus(200);

        $this->assertDatabaseCount('events', 0);
    }

    public function test_if_employee_can_access_to_calender() : void
    {
        $employee = User::factory()->create()->assignRole("employee");

        $response = $this->actingAs($employee)->get(route('fullCalender',[
            'start' => '2022-06-05T00:00:00', 'end' => '2022-06-12T00:00:00',
            '_token' => csrf_token()
        ]))
        ->assertStatus(200);
    }

    public function test_if_employee_cant_access__to_user_management_section() : void
    {
        $employee = User::factory()->create()->assignRole("employee");
        $response = $this->actingAs($employee)->get(route('userManagement'))->assertStatus(403);
    }

    public function test_if_employee_cant_access_to_employee_management_section() : void
    {
        $employee = User::factory()->create()->assignRole("employee");
        $response = $this->actingAs($employee)->get(route('employeeManagement'))->assertStatus(403);
    }
}
