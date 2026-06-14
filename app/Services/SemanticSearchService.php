<?php

namespace App\Services;

use App\Models\Pet;

class SemanticSearchService
{
    /**
     * Tìm kiếm ngữ nghĩa cục bộ sử dụng Heuristic Scoring (Keyword & Intent Mapping)
     * Thay thế cho Vector DB / Embeddings API để tiết kiệm chi phí và tài nguyên.
     * 
     * @param string $query Tin nhắn của người dùng
     * @param int $limit Số lượng thú cưng trả về
     * @return \Illuminate\Support\Collection
     */
    public static function search(string $query, int $limit = 5)
    {
        $pets = Pet::where('Trang_thai', 'san_sang')->get([
            'Ma_thu_cung', 'Ten', 'Loai', 'Giong', 'Gioi_tinh', 'Nhom_tuoi', 
            'Can_nang', 'Anh_dai_dien', 'Than_thien_nguoi', 'Than_thien_cho', 
            'Than_thien_meo', 'Mo_ta', 'Tinh_cach', 'Thoi_quen', 'Mau_long', 'Noi_bat'
        ]);

        if (trim($query) === '') {
            return $pets->sortByDesc('Noi_bat')->take($limit)->values();
        }

        $queryStr = mb_strtolower($query, 'UTF-8');
        
        // 1. Từ điển trích xuất Intent (Ý định)
        $intentMap = [
            'cho' => ['chó', 'cún', 'dog', 'chó con', 'giữ nhà'],
            'meo' => ['mèo', 'miu', 'cat', 'mèo con', 'bắt chuột'],
            'nho' => ['nhỏ', 'căn hộ', 'chung cư', 'bé xíu', 'mini', 'tí hon', 'không gian hẹp'],
            'lon' => ['lớn', 'to', 'khỏe', 'giữ nhà', 'sân vườn', 'rộng', 'bảo vệ'],
            'hien' => ['hiền', 'ngoan', 'lành', 'dễ nuôi', 'thân thiện', 'trẻ em', 'quấn chủ'],
            'nang_dong' => ['năng động', 'nghịch', 'chạy nhảy', 'tăng động', 'hoạt bát'],
            'duc' => ['đực', 'trai', 'nam'],
            'cai' => ['cái', 'gái', 'nữ'],
            'so_sinh' => ['sơ sinh', 'mới đẻ', 'chưa cai sữa'],
            'nho_tuoi' => ['nhỏ tuổi', 'vài tháng', 'puppy', 'kitten'],
            'truong_thanh' => ['trưởng thành', 'lớn tuổi', 'đã lớn', 'điềm tĩnh'],
        ];

        // Đánh giá query có chứa các intent nào
        $activeIntents = [];
        foreach ($intentMap as $intentKey => $words) {
            $activeIntents[$intentKey] = false;
            foreach ($words as $word) {
                if (str_contains($queryStr, $word)) {
                    $activeIntents[$intentKey] = true;
                    break;
                }
            }
        }

        // Tách từ để tìm kiếm Keyword-based (BM25 cơ bản)
        $tokens = explode(' ', $queryStr);

        // 2. Chấm điểm từng bé thú cưng
        foreach ($pets as $pet) {
            $score = 0;

            // Loài (Trọng số rất cao)
            if ($activeIntents['cho'] && $pet->Loai === 'cho') $score += 20;
            if ($activeIntents['meo'] && $pet->Loai === 'meo') $score += 20;

            // Giới tính (Trọng số trung bình)
            if ($activeIntents['duc'] && $pet->Gioi_tinh === 'duc') $score += 5;
            if ($activeIntents['cai'] && $pet->Gioi_tinh === 'cai') $score += 5;

            // Kích thước / Không gian sống (Phụ thuộc cân nặng)
            if ($activeIntents['nho'] && $pet->Can_nang < 5) $score += 10;
            if ($activeIntents['lon'] && $pet->Can_nang >= 15) $score += 10;

            // Tính cách - Thân thiện
            if ($activeIntents['hien'] && ($pet->Than_thien_nguoi || $pet->Than_thien_cho || $pet->Than_thien_meo)) $score += 8;

            // Nhóm tuổi
            if ($activeIntents['so_sinh'] && $pet->Nhom_tuoi === 'so_sinh') $score += 5;
            if ($activeIntents['nho_tuoi'] && $pet->Nhom_tuoi === 'nho') $score += 5;
            if ($activeIntents['truong_thanh'] && in_array($pet->Nhom_tuoi, ['truong_thanh', 'gia'])) $score += 5;

            // Gom text mô tả để scan
            $textAttributes = mb_strtolower($pet->Mo_ta . ' ' . $pet->Tinh_cach . ' ' . $pet->Thoi_quen . ' ' . $pet->Giong . ' ' . $pet->Ten, 'UTF-8');
            $mauLong = mb_strtolower($pet->Mau_long ?? '', 'UTF-8');

            // Năng động (Scan trong Text)
            if ($activeIntents['nang_dong']) {
                foreach (['hiếu động', 'nghịch', 'chạy nhảy', 'hoạt bát', 'tăng động'] as $w) {
                    if (str_contains($textAttributes, $w)) {
                        $score += 8;
                        break; // Chỉ cộng 1 lần cho intent này
                    }
                }
            }

            // Keyword Matching trực tiếp (VD: khách gọi đúng tên bé, màu lông, giống)
            foreach ($tokens as $token) {
                $token = trim($token);
                if (mb_strlen($token) > 2) {
                    if (str_contains($textAttributes, $token)) {
                        $score += 2; // Khớp trong mô tả
                    }
                    if ($mauLong && str_contains($mauLong, $token)) {
                        $score += 5; // Khớp màu lông rất quan trọng
                    }
                    if (str_contains(mb_strtolower($pet->Ten, 'UTF-8'), $token)) {
                        $score += 15; // Khớp đúng tên thì cực kỳ ưu tiên
                    }
                    if (str_contains(mb_strtolower($pet->Giong, 'UTF-8'), $token)) {
                        $score += 10; // Khớp giống
                    }
                }
            }

            // Thêm điểm nhỉnh hơn cho các bé nổi bật
            if ($pet->Noi_bat) {
                $score += 2; 
            }

            $pet->semantic_score = $score;
        }

        // 3. Sắp xếp giảm dần theo điểm
        $sortedPets = $pets->sortByDesc('semantic_score');

        // Trả về top K
        return $sortedPets->take($limit)->values();
    }
}
