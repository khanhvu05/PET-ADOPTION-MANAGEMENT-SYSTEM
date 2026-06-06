<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key'    => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        $this->cloudinary = new Cloudinary();
    }

    /**
     * Upload ảnh lên Cloudinary
     * @return array{url: string, public_id: string}|null
     */
    public function uploadImage(UploadedFile $file, string $folder = 'petjam/pets'): ?array
    {
        try {
            $result = $this->cloudinary->uploadApi()->upload(
                $file->getRealPath(),
                [
                    'folder'          => $folder,
                    'transformation'  => [
                        ['width' => 1200, 'height' => 900, 'crop' => 'limit', 'quality' => 'auto', 'fetch_format' => 'auto'],
                    ],
                ]
            );

            return [
                'url'       => $result['secure_url'],
                'public_id' => $result['public_id'],
            ];
        } catch (\Exception $e) {
            Log::error('Cloudinary upload failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Xóa ảnh khỏi Cloudinary theo public_id
     */
    public function deleteImage(string $publicId): bool
    {
        try {
            $this->cloudinary->uploadApi()->destroy($publicId);
            return true;
        } catch (\Exception $e) {
            Log::error('Cloudinary delete failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy public_id từ URL Cloudinary
     */
    public function extractPublicId(string $url): ?string
    {
        // Dạng URL: https://res.cloudinary.com/{cloud_name}/image/upload/{version}/{public_id}.{ext}
        if (preg_match('/upload\/(?:v\d+\/)?(.+?)(?:\.[a-z]+)?$/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
