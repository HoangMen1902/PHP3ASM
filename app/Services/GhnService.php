<?php
namespace App\Services;

use Illuminate\Container\Attributes\Log;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Http;

class GhnService
{
    protected $token;

    public function __construct()
    {
        $this->token = config('services.ghn.token');
    }

    public function getProvinces()
    {
        try {
            $response = Http::withHeaders([ 'Token' => $this->token ])
                ->get('https://online-gateway.ghn.vn/shiip/public-api/master-data/province');
            
            if ($response->successful()) {
                $data = $response->json();
                return $data ?? []; // Kiểm tra dữ liệu trả về có hợp lệ không
            } else {    
                logger()->error('Error fetching provinces', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'url' => $response->effectiveUri()
                ]);
                return [];
            }
        } catch (\Exception $e) {
            logger()->error('Error fetching provinces', [
                'exception' => $e->getMessage(),
                'url' => 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province'
            ]);
            return [];
        }
    }

    public function getDistricts($province_id)
    {
        try {
            $response = Http::withHeaders(['Token' => $this->token])
                ->post('https://online-gateway.ghn.vn/shiip/public-api/master-data/district', [
                    'province_id' => (int) $province_id,  
                ]);
    
            if ($response->successful()) {
                return $response->json('data');
            } else {
                Logger('Error fetching districts', ['response' => $response->body()]);
                return [];
            }
        } catch (\Exception $e) {
            Logger('Error fetching districts', ['exception' => $e->getMessage()]);
            return [];
        }
    }
    

    public function getWards($district_id)
    {
        try {
            $response = Http::withHeaders([ 'Token' => $this->token ])
                ->post('https://online-gateway.ghn.vn/shiip/public-api/master-data/ward', [
                    'district_id' =>(int) $district_id,
                ]);

            if ($response->successful()) {
                $data = $response->json('data');
                return $data ?? [];
            } else {
                logger()->error('Error fetching wards', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'district_id' => $district_id
                ]);
                return [];
            }
        } catch (\Exception $e) {
            logger()->error('Error fetching wards', [
                'exception' => $e->getMessage(),
                'district_id' => $district_id
            ]);
            return [];
        }
    }
}
