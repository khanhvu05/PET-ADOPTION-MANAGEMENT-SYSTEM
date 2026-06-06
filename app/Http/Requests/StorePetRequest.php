<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isStaff();
    }

    public function rules(): array
    {
        $petId = $this->route('pet'); // null khi create, có giá trị khi update

        return [
            'Ten'              => 'required|string|max:100',
            'Loai'             => 'required|in:cho,meo,khac',
            'Giong'            => 'nullable|string|max:100',
            'Nhom_tuoi'        => 'required|in:so_sinh,nho,truong_thanh,gia',
            'Can_nang'         => 'nullable|numeric|min:0|max:999',
            'Gioi_tinh'        => 'required|in:duc,cai,chua_xac_dinh',
            'Da_tiem_phong'    => 'boolean',
            'Da_triet_san'     => 'boolean',
            'Trang_thai'       => 'required|in:dang_cuu_ho,chua_san_sang,san_sang,da_nhan_nuoi,da_mat',
            'Vi_tri'           => 'nullable|in:noi_tru,phong_kham',
            'Than_thien_nguoi' => 'nullable|boolean',
            'Than_thien_cho'   => 'nullable|boolean',
            'Than_thien_meo'   => 'nullable|boolean',
            'Che_do_an_dac_biet' => 'nullable|string|max:500',
            'Ngay_tiep_nhan'   => 'required|date|before_or_equal:today',
            'Phi_nhan_nuoi'    => 'nullable|numeric|min:0',
            'Noi_bat'          => 'boolean',
            'Mo_ta'            => 'nullable|string|max:3000',
            'Nguoi_phu_trach'  => 'nullable|exists:users,Ma_nguoi_dung',
            'anh_upload'       => ($petId ? 'nullable' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:5120',
            'Mau_long'         => 'nullable|string|max:100',
            'Tinh_cach'        => 'nullable|string|max:255',
            'Thoi_quen'        => 'nullable|string|max:1000',
            'Yeu_thich'        => 'nullable|string|max:1000',
            'thu_vien_anh_upload.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'Ten.required'           => 'Tên thú cưng là bắt buộc.',
            'Ten.max'                => 'Tên không được quá 100 ký tự.',
            'Loai.required'          => 'Vui lòng chọn loài thú cưng.',
            'Loai.in'                => 'Loài thú cưng không hợp lệ.',
            'Nhom_tuoi.required'     => 'Vui lòng chọn nhóm tuổi.',
            'Gioi_tinh.required'     => 'Vui lòng chọn giới tính.',
            'Ngay_tiep_nhan.required' => 'Ngày tiếp nhận là bắt buộc.',
            'Ngay_tiep_nhan.before_or_equal' => 'Ngày tiếp nhận không được là ngày tương lai.',
            'anh_upload.image'       => 'File phải là hình ảnh.',
            'anh_upload.mimes'       => 'Chỉ chấp nhận định dạng JPG, PNG, WEBP.',
            'anh_upload.max'         => 'Kích thước ảnh không được vượt quá 5MB.',
            'thu_vien_anh_upload.*.image' => 'File phải là hình ảnh.',
            'thu_vien_anh_upload.*.mimes' => 'Chỉ chấp nhận định dạng JPG, PNG, WEBP.',
            'thu_vien_anh_upload.*.max'   => 'Kích thước ảnh phụ không được vượt quá 5MB.',
            'Can_nang.numeric'       => 'Cân nặng phải là số.',
            'Phi_nhan_nuoi.numeric'  => 'Phí nhận nuôi phải là số.',
            'Trang_thai.required'    => 'Vui lòng chọn trạng thái.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'Da_tiem_phong'    => $this->boolean('Da_tiem_phong'),
            'Da_triet_san'     => $this->boolean('Da_triet_san'),
            'Noi_bat'          => $this->boolean('Noi_bat'),
            'Than_thien_nguoi' => $this->has('Than_thien_nguoi') ? $this->boolean('Than_thien_nguoi') : null,
            'Than_thien_cho'   => $this->has('Than_thien_cho') ? $this->boolean('Than_thien_cho') : null,
            'Than_thien_meo'   => $this->has('Than_thien_meo') ? $this->boolean('Than_thien_meo') : null,
        ]);
    }
}
