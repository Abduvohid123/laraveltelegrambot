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
                'title' => 'category_create',
            ],
            [
                'id'    => 18,
                'title' => 'category_edit',
            ],
            [
                'id'    => 19,
                'title' => 'category_show',
            ],
            [
                'id'    => 20,
                'title' => 'category_delete',
            ],
            [
                'id'    => 21,
                'title' => 'category_access',
            ],
            [
                'id'    => 22,
                'title' => 'sub_category_create',
            ],
            [
                'id'    => 23,
                'title' => 'sub_category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'sub_category_show',
            ],
            [
                'id'    => 25,
                'title' => 'sub_category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'sub_category_access',
            ],
            [
                'id'    => 27,
                'title' => 'product_create',
            ],
            [
                'id'    => 28,
                'title' => 'product_edit',
            ],
            [
                'id'    => 29,
                'title' => 'product_show',
            ],
            [
                'id'    => 30,
                'title' => 'product_delete',
            ],
            [
                'id'    => 31,
                'title' => 'product_access',
            ],
            [
                'id'    => 32,
                'title' => 'order_create',
            ],
            [
                'id'    => 33,
                'title' => 'order_edit',
            ],
            [
                'id'    => 34,
                'title' => 'order_show',
            ],
            [
                'id'    => 35,
                'title' => 'order_delete',
            ],
            [
                'id'    => 36,
                'title' => 'order_access',
            ],
            [
                'id'    => 37,
                'title' => 'payment_create',
            ],
            [
                'id'    => 38,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 39,
                'title' => 'payment_show',
            ],
            [
                'id'    => 40,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 41,
                'title' => 'payment_access',
            ],
            [
                'id'    => 42,
                'title' => 'location_create',
            ],
            [
                'id'    => 43,
                'title' => 'location_edit',
            ],
            [
                'id'    => 44,
                'title' => 'location_show',
            ],
            [
                'id'    => 45,
                'title' => 'location_delete',
            ],
            [
                'id'    => 46,
                'title' => 'location_access',
            ],
            [
                'id'    => 47,
                'title' => 'yetkazib_berish_create',
            ],
            [
                'id'    => 48,
                'title' => 'yetkazib_berish_edit',
            ],
            [
                'id'    => 49,
                'title' => 'yetkazib_berish_show',
            ],
            [
                'id'    => 50,
                'title' => 'yetkazib_berish_delete',
            ],
            [
                'id'    => 51,
                'title' => 'yetkazib_berish_access',
            ],
            [
                'id'    => 52,
                'title' => 'about_create',
            ],
            [
                'id'    => 53,
                'title' => 'about_edit',
            ],
            [
                'id'    => 54,
                'title' => 'about_show',
            ],
            [
                'id'    => 55,
                'title' => 'about_delete',
            ],
            [
                'id'    => 56,
                'title' => 'about_access',
            ],
            [
                'id'    => 57,
                'title' => 'contact_create',
            ],
            [
                'id'    => 58,
                'title' => 'contact_edit',
            ],
            [
                'id'    => 59,
                'title' => 'contact_show',
            ],
            [
                'id'    => 60,
                'title' => 'contact_delete',
            ],
            [
                'id'    => 61,
                'title' => 'contact_access',
            ],
            [
                'id'    => 62,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
