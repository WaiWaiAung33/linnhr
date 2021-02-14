<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'employee-list',
           'employee-create',
           'employee-edit',
           'employee-delete',
           'salary-list',
           'salary-create',
           'salary-edit',
           'salary-delete',
           'job-list',
           'job-create',
           'job-edit',
           'job-delete',
           'branch-list',
           'branch-create',
           'branch-edit',
           'branch-delete',
           'department-list',
           'department-create',
           'department-edit',
           'department-delete',
           'rank-list',
           'rank-create',
           'rank-edit',
           'rank-delete',
           'nrc-code-list',
           'nrc-code-create',
           'nrc-code-edit',
           'nrc-code-delete',
           'nrc-state-list',
           'nrc-state-create',
           'nrc-state-edit',
           'nrc-state-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'dashboard',
           'hostel-list',
           'room-list',
           'hostel-employee-list'
        ];
   
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}