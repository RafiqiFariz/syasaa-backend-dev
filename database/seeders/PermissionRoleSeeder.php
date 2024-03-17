<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Seeder ini digunakan untuk mendefinisikan hak akses/permissions
 * apa saja yang dimiliki oleh users
 */
class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        $adminPermissions = $permissions;
        Role::findOrFail(1)->permissions()->sync($adminPermissions->pluck('id'));

        $ignoredPrefixes = ['role_', 'permission_'];
        $facultyStaffPermissions = $this->filterPermissions($permissions, $ignoredPrefixes);
        Role::findOrFail(2)->permissions()->sync($facultyStaffPermissions->pluck('id'));

        $ignoredPrefixes = ['user_create', 'user_delete', 'user_restore', 'role_', 'permission_'];
        $lecturerPermissions = $this->filterPermissions($permissions, $ignoredPrefixes);
        Role::findOrFail(3)->permissions()->sync($lecturerPermissions->pluck('id'));

        $ignoredPrefixes = [
            'user_create', 'user_delete', 'user_restore',
            'class_create', 'class_update', 'class_delete', 'class_edit',
            'course_create', 'course_update', 'course_delete', 'course_edit',
            'course_class_create', 'course_class_update', 'course_class_delete',
            'faculty_create', 'faculty_update', 'faculty_delete', 'faculty_edit',
            'major_create', 'major_update', 'major_delete', 'major_edit',
            'role_', 'permission_',
        ];

        $studentPermissions = $this->filterPermissions($permissions, $ignoredPrefixes);
        Role::findOrFail(4)->permissions()->sync($studentPermissions->pluck('id'));
    }

    private function filterPermissions($permissions, $ignoredPrefixes)
    {
        return $permissions->filter(function ($permission) use ($ignoredPrefixes) {
            return !collect($ignoredPrefixes)->contains(function ($prefix) use ($permission) {
                return str_starts_with($permission->name, $prefix);
            });
        });
    }
}
