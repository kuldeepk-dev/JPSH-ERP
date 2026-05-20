<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('permissions')) {
            return;
        }

        $now = date('Y-m-d H:i:s');

        $boardsPermissionId = DB::table('permissions')
            ->where('route', 'boards')
            ->value('id');

        if (!$boardsPermissionId) {
            $boardsPermissionId = DB::table('permissions')->insertGetId([
                'module' => null,
                'sidebar_menu' => 'system_settings',
                'old_id' => null,
                'section_id' => 1,
                'parent_id' => 0,
                'name' => 'Boards',
                'route' => 'boards',
                'parent_route' => 'general_settings',
                'type' => 2,
                'lang_name' => 'system_settings.boards',
                'icon' => null,
                'svg' => null,
                'status' => 1,
                'menu_status' => 1,
                'position' => 3,
                'is_saas' => 0,
                'relate_to_child' => 0,
                'is_menu' => 1,
                'is_admin' => 1,
                'is_teacher' => 0,
                'is_student' => 0,
                'is_parent' => 0,
                'created_by' => 1,
                'updated_by' => 1,
                'permission_section' => 0,
                'alternate_module' => null,
                'user_id' => null,
                'role_id' => null,
                'school_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->ensurePermission('boards-store', 'boards', 'Add', 1, $now);
        $this->ensurePermission('boards-edit', 'boards', 'Edit', 2, $now);
        $this->ensurePermission('boards-update', 'boards', 'Update', 3, $now);
        $this->ensurePermission('boards-delete', 'boards', 'Delete', 4, $now);

        $this->ensureMenuEntry('sm_menus', $boardsPermissionId, $now);
        $this->ensureMenuEntry('default_menus', $boardsPermissionId, $now);
    }

    public function down(): void
    {
        if (!Schema::hasTable('permissions')) {
            return;
        }

        DB::table('permissions')->whereIn('route', [
            'boards',
            'boards-store',
            'boards-edit',
            'boards-update',
            'boards-delete',
        ])->delete();

        if (Schema::hasTable('sm_menus')) {
            DB::table('sm_menus')->where('route', 'boards')->delete();
        }

        if (Schema::hasTable('default_menus')) {
            DB::table('default_menus')->where('route', 'boards')->delete();
        }
    }

    private function ensurePermission(string $route, string $parentRoute, string $name, int $position, string $now): void
    {
        $exists = DB::table('permissions')->where('route', $route)->exists();
        if ($exists) {
            return;
        }

        DB::table('permissions')->insert([
            'module' => null,
            'sidebar_menu' => null,
            'old_id' => null,
            'section_id' => 1,
            'parent_id' => 0,
            'name' => $name,
            'route' => $route,
            'parent_route' => $parentRoute,
            'type' => 3,
            'lang_name' => null,
            'icon' => null,
            'svg' => null,
            'status' => 1,
            'menu_status' => 1,
            'position' => $position,
            'is_saas' => 0,
            'relate_to_child' => 0,
            'is_menu' => 0,
            'is_admin' => 1,
            'is_teacher' => 0,
            'is_student' => 0,
            'is_parent' => 0,
            'created_by' => 1,
            'updated_by' => 1,
            'permission_section' => 0,
            'alternate_module' => null,
            'user_id' => null,
            'role_id' => null,
            'school_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function ensureMenuEntry(string $table, int $boardsPermissionId, string $now): void
    {
        if (!Schema::hasTable($table)) {
            return;
        }

        $parentId = DB::table($table)
            ->where('route', 'general_settings')
            ->where('role_id', 1)
            ->value('id');

        if (!$parentId) {
            return;
        }

        $exists = DB::table($table)
            ->where('route', 'boards')
            ->where('role_id', 1)
            ->where('parent_id', $parentId)
            ->exists();

        if ($exists) {
            return;
        }

        $academicYearPosition = DB::table($table)
            ->where('route', 'academic-year')
            ->where('role_id', 1)
            ->where('parent_id', $parentId)
            ->value('position');

        $boardsPosition = $academicYearPosition ?: 1;

        DB::table($table)
            ->where('role_id', 1)
            ->where('parent_id', $parentId)
            ->where('position', '>=', $boardsPosition)
            ->increment('position');

        DB::table($table)
            ->where('role_id', 1)
            ->where('parent_id', $parentId)
            ->where('default_position', '>=', $boardsPosition)
            ->increment('default_position');

        DB::table($table)->insert([
            'name' => 'Boards',
            'module' => null,
            'route' => 'boards',
            'lang_name' => 'system_settings.boards',
            'section_id' => null,
            'icon' => null,
            'status' => 1,
            'is_saas' => 0,
            'role_id' => 1,
            'is_alumni' => null,
            'menu_status' => 1,
            'permission_section' => 0,
            'position' => $boardsPosition,
            'default_position' => $boardsPosition,
            'parent' => $parentId,
            'parent_id' => $parentId,
            'school_id' => 1,
            'alternate_module' => null,
            'permission_id' => $boardsPermissionId,
            'ignore' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
};
