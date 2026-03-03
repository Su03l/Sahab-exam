<?php

namespace App\Policies;

use App\Models\SystemRequest;
use App\Models\User;
use App\Enums\UserRole;

class SystemRequestPolicy
{
    /**
     * هل يحق للمستخدم رؤية هذا الطلب؟
     * (يتحقق الشرط إذا كان المستخدم هو صاحب الطلب، أو إذا كان دوره مدير)
     */
    public function view(User $user, SystemRequest $systemRequest): bool
    {
        return $user->id === $systemRequest->created_by || $user->role === UserRole::MANAGER;
    }

    /**
     * هل يحق للمستخدم تغيير حالة الطلب (قبول/رفض)؟
     * (المدير فقط هو من يستطيع ذلك)
     */
    public function manageStatus(User $user): bool
    {
        return $user->role === UserRole::MANAGER;
    }
}
