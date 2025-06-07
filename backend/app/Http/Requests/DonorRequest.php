<?php

namespace App\Http\Requests;

use App\Enums\BloodGroup;
use Illuminate\Support\Facades\Auth;

class DonorRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $requiredOrSometimes = $this->isMethod('put') ? 'sometimes' : 'required';
        return [
            'name' => $requiredOrSometimes."|string|min:3|max:150",
            'email' => [
                $requiredOrSometimes,
                'email',
                'unique:users,email' . ($this->isMethod('put') ? ',' . Auth::user()->id : '')
            ],
            'phone' => 'nullable|string|max:20',
            'password' => $requiredOrSometimes . '|string|min:6|confirmed',
            'address' => 'nullable|string|max:255',
            'blood_group' => $requiredOrSometimes."|string|in:" . implode(',', BloodGroup::allGroups()),
            'is_available' => 'boolean',
            'last_donation_date' => 'nullable|date',
            'profession' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0|max:255',
            'medical_conditions' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name cannot exceed 150 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered.',
            'phone.max' => 'Phone number cannot exceed 20 characters.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'blood_group.required' => 'Blood group is required.',
            'blood_group.in' => 'Please select a valid blood group.',
            'address.max' => 'Address cannot exceed 255 characters.',
            'is_available.boolean' => 'Availability must be true or false.',
            'last_donation_date.date' => 'Last donation date must be a valid date.',
            'profession.max' => 'Profession cannot exceed 255 characters.',
            'religion.max' => 'Religion cannot exceed 255 characters.',
            'age.integer' => 'Age must be an integer.',
            'age.min' => 'Age must be at least 0.',
            'age.max' => 'Age cannot exceed 255.',
        ];
    }
}
