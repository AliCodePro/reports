<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'reports_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'report_create',
            ],
            [
                'id'    => 19,
                'title' => 'report_edit',
            ],
            [
                'id'    => 20,
                'title' => 'report_show',
            ],
            [
                'id'    => 21,
                'title' => 'report_delete',
            ],
            [
                'id'    => 22,
                'title' => 'report_access',
            ],
            [
                'id'    => 23,
                'title' => 'category_create',
            ],
            [
                'id'    => 24,
                'title' => 'category_edit',
            ],
            [
                'id'    => 25,
                'title' => 'category_show',
            ],
            [
                'id'    => 26,
                'title' => 'category_delete',
            ],
            [
                'id'    => 27,
                'title' => 'category_access',
            ],
            [
                'id'    => 28,
                'title' => 'faq_create',
            ],
            [
                'id'    => 29,
                'title' => 'faq_edit',
            ],
            [
                'id'    => 30,
                'title' => 'faq_show',
            ],
            [
                'id'    => 31,
                'title' => 'faq_delete',
            ],
            [
                'id'    => 32,
                'title' => 'faq_access',
            ],
            [
                'id'    => 33,
                'title' => 'section_create',
            ],
            [
                'id'    => 34,
                'title' => 'section_edit',
            ],
            [
                'id'    => 35,
                'title' => 'section_show',
            ],
            [
                'id'    => 36,
                'title' => 'section_delete',
            ],
            [
                'id'    => 37,
                'title' => 'section_access',
            ],
            [
                'id'    => 38,
                'title' => 'chapter_create',
            ],
            [
                'id'    => 39,
                'title' => 'chapter_edit',
            ],
            [
                'id'    => 40,
                'title' => 'chapter_show',
            ],
            [
                'id'    => 41,
                'title' => 'chapter_delete',
            ],
            [
                'id'    => 42,
                'title' => 'chapter_access',
            ],
            [
                'id'    => 43,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
