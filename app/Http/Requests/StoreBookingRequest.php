<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'customer_name' => ['required', 'string', 'min:3', 'max:100'],
            'customer_phone' => ['required', 'string', 'min:8', 'max:20'],
            'customer_email' => ['nullable', 'email', 'max:100'],
            'service_date' => ['required', 'date', 'after_or_equal:today'],
            'service_time' => ['required', 'string', 'max:20'],
            'service_address' => ['required', 'string', 'min:8', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'vehicle_type' => ['nullable', 'string', 'max:100'],
            'vehicle_model' => ['nullable', 'string', 'max:100'],
            'service_location' => ['nullable', 'string', 'max:100'],
            'property_type' => ['nullable', 'string', 'max:100'],
            'cleaning_focus' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Custom validation messages in Indonesian.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'service_category_id.required' => 'Silakan pilih kategori layanan (Car Wash atau Home Cleaning).',
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_phone.required' => 'Nomor WhatsApp / telepon wajib diisi untuk konfirmasi booking.',
            'service_date.required' => 'Tanggal layanan wajib ditentukan.',
            'service_date.after_or_equal' => 'Tanggal layanan minimal hari ini atau hari berikutnya.',
            'service_time.required' => 'Pilih jam layanan yang diinginkan.',
            'service_address.required' => 'Alamat lengkap wajib diisi agar tim kami dapat menuju lokasi.',
            'service_address.min' => 'Alamat terlalu singkat, mohon tuliskan alamat lebih lengkap.',
        ];
    }
}
