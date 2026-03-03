<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSystemRequest extends FormRequest
{
    /**
     * تحديد ما إذا كان يحق للمستخدم تنفيذ هذا الطلب
     */
    public function authorize(): bool
    {
        // نرجع true لأن أي مستخدم مسجل يحق له إنشاء طلب
        return true;
    }

    /**
     * قواعد التحقق من صحة البيانات
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ];
    }

    /**
     * رسائل الخطأ المخصصة (اختياري، لكن يضيف لمسة احترافية)
     */
    public function messages(): array
    {
        return [
            'title.required' => 'حقل العنوان مطلوب.',
            'description.required' => 'حقل الوصف مطلوب.',
        ];
    }
}
