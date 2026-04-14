<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Documents
            'documents.view',
            'documents.view-own',
            'documents.create',
            'documents.edit',
            'documents.edit-own',
            'documents.delete',
            'documents.delete-own',
            'documents.download',
            'documents.download-own',

            // Security
            'documents.view-confidential',
            'documents.verify-security',
            'documents.regenerate-security',
            'documents.view-hash',
            'documents.download-qr',

            // Import/Export
            'documents.import',
            'documents.export',
            'documents.export-all',
            'documents.bulk-actions',

            // Archive Classifications
            'archive-classifications.view',
            'archive-classifications.create',
            'archive-classifications.edit',
            'archive-classifications.delete',

            // Categories
            'categories.view',
            'categories.manage',

            // Audit
            'audit-logs.view',
            'audit-logs.view-all',

            // Users Management - BARU
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'users.assign-roles',

            // Roles & Permissions - BARU
            'roles.view',
            'roles.manage',

            // System
            'system.settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Super Admin Role
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Create User Role
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
            'documents.view-own',
            'documents.create',
            'documents.edit-own',
            'documents.delete-own',
            'documents.download-own',
            'documents.verify-security',
            'documents.view-hash',
            'archive-classifications.view',
            'categories.view',
            'audit-logs.view',
        ]);

        // Assign super admin to first user (optional)
        $adminUser = \App\Models\User::first();
        if ($adminUser) {
            $adminUser->assignRole('super_admin');
        }
    }
}
