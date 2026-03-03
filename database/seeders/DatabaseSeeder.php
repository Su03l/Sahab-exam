<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SystemRequest;
use App\Enums\UserRole;
use App\Enums\RequestStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء المدير
        $manager = User::create([
            'name' => 'مدير النظام',
            'email' => 'manager@sahab.com',
            'password' => Hash::make('password'),
            'role' => UserRole::MANAGER,
        ]);

        // 2. إنشاء الموظف
        $employee = User::create([
            'name' => 'موظف تجريبي',
            'email' => 'employee@sahab.com',
            'password' => Hash::make('password'),
            'role' => UserRole::EMPLOYEE,
        ]);

        // 3. إنشاء طلبات تجريبية متنوعة للموظف

        // طلب 1: معلق (Pending)
        SystemRequest::create([
            'title' => 'طلب 1',
            'description' => 'تجربة الطلب رقم 1 وهو في حالة الانتظار (Pending).',
            'status' => RequestStatus::PENDING,
            'created_by' => $employee->id,
        ]);

        // طلب 2: مقبول (Approved)
        SystemRequest::create([
            'title' => 'طلب 2',
            'description' => 'تجربة الطلب رقم 2 وهو في حالة القبول (Approved).',
            'status' => RequestStatus::APPROVED,
            'created_by' => $employee->id,
            'approved_by' => $manager->id,
        ]);

        // طلب 3: مرفوض (Rejected)
        SystemRequest::create([
            'title' => 'طلب 3',
            'description' => 'تجربة الطلب رقم 3 وهو في حالة الرفض (Rejected).',
            'status' => RequestStatus::REJECTED,
            'created_by' => $employee->id,
            'approved_by' => $manager->id,
        ]);
    }
}
