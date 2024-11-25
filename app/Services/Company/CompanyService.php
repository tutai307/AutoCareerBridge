<?php

namespace App\Services\Company;

use App\Repositories\Company\CompanyRepositoryInterface;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * CompanyController handles company management,
 * @author Hoang Duy Lap, Khuat Van Duy
 * @access public
 * @package Company
 * @see findProfile()
 * @see editProfile()
 * @see getProvinces()
 * @see getDistricts()
 * @see getWards()
 * @see updateProfileService()
 * @see updateAvatar()
 * @see index()
 * @see findUniversity()
 * @see getCompanyBySlug()
 * @see getCompaniesWithJobsAndAddresses()
 * @see getCompaniesWithFilters()
 */
class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function findProfile($userId)
    {
        return $this->companyRepository->findByUserIdAndSlug($userId);
    }

    public function editProfile($slug, $userId)
    {
        return $this->companyRepository->findBySlug($userId, $slug);
    }

    public function getProvinces()
    {
        return $this->companyRepository->getProvinces();
    }public function getDistricts($provinceId)
{
    return $this->companyRepository->getDistricts($provinceId);
}

    public function getWards($districtId)
    {
        return $this->companyRepository->getWards($districtId);
    }

    public function updateProfileService($identifier, $data)
    {
        try {
            return $this->companyRepository->updateProfile($identifier, $data);
        } catch (Exception $e) {
            throw new Exception('Lỗi khi cập nhật thông tin: ' . $e->getMessage());
        }
    }
    public function createCompanyForUser($userId, $data)
    {
        $data['user_id'] = $userId;
        return $this->companyRepository->create($data);
    }

    public function updateAvatar($identifier, $avatar)
    {
        return $this->companyRepository->updateAvatar($identifier, $avatar);
    }

    public function index(){
        return $this->companyRepository->index();
    }
    public function dashboard()
    {
        $user=auth()->guard('admin')->user();
        $companyId=$user->company->id;
         return $this->companyRepository->dashboard( $companyId);
       
    }
    public function findUniversity($request){
        return $this->companyRepository->findUniversity($request);
    }

    public function getAllPaginated($perPage = PAGINATE_LIST_COMPANY)
    {
        $allCompanies = $this->companyRepository->getAll(); // Trả về Collection
        $currentPage = request()->input('page', 1); // Lấy số trang hiện tại từ query string
        $currentItems = $allCompanies->slice(($currentPage - 1) * $perPage, $perPage);
        $addresses = $allCompanies->map(function ($company) {
            return $company->addresses->map(function ($address) {
                // Truy vấn từng quan hệ với Eloquent
                $province = $address->province;  // Giả sử bạn đã thiết lập quan hệ trong Model Company (hasOne, belongsTo...)
                $district = $address->district;  // Tương tự với district và ward
                $ward = $address->ward;

                \Log::info('district', [$district]);
                \Log::info('province', [$province]);
                \Log::info('ward', [$ward]);

                // Tạo địa chỉ đầy đủ
                $fullAddress = $address->specific_address . ', '
                    . ($ward ? $ward->name . ', ' : '')
                    . ($district ? $district->name . ', ' : '')
                    . ($province ? $province->name : '');

                \Log::info('addresses', [$fullAddress]);

                return $fullAddress;
            });
        });
        \Log::info('addresses', [$addresses]);

        return new LengthAwarePaginator(
            $currentItems, // Dữ liệu phân trang
            $allCompanies->count(), // Tổng số phần tử
            $perPage, // Số phần tử trên mỗi trang
            $currentPage, // Trang hiện tại
            ['path' => request()->url(), 'query' => request()->query()] // URL và query string
        );
    }

    public function getCompanyBySlug($slug) {
        return $this->companyRepository->getCompanyBySlug($slug);
    }

    public function getCompaniesWithJobsAndAddresses() {
        return $this->companyRepository->getCompaniesWithJobsAndAddresses();
    }

    public function getCompaniesWithFilters($query, $provinceId, $sortOrder) {
        return $this->companyRepository->getCompaniesWithFilters($query, $provinceId, $sortOrder);
    }
}
