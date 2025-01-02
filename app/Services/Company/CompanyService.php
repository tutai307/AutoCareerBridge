<?php

namespace App\Services\Company;

use App\Repositories\Company\CompanyRepositoryInterface;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

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

    /**
     * Retrieves the company profile based on the provided user ID.
     * Utilizes the repository to find the company by user ID and slug.
     *
     * @param int $userId
     * @access public
     * @author Hoang Duy Lap
     * @return mixed|null The company profile if found, otherwise null.
     * @throws Exception If an error occurs during retrieval.
     */

     public function getAll() {
        return $this->companyRepository->getAll();
     }

    public function findProfile($userId)
    {
        return $this->companyRepository->findByUserIdAndSlug($userId);
    }

    /**
     * Retrieves a list of all provinces.
     * Uses the repository to fetch all provinces.
     *
     * @access public
     * @author Hoang Duy Lap
     * @return \Illuminate\Database\Eloquent\Collection A collection of provinces.
     */
    public function getProvinces()
    {
        return $this->companyRepository->getProvinces();
    }

    /**
     * Retrieves a list of districts based on the provided province ID.
     * Uses the repository to fetch districts associated with the given province.
     *
     * @param int $provinceId
     * @access public
     * @author Hoang Duy Lap
     * @return \Illuminate\Database\Eloquent\Collection A collection of districts.
     */
    public function getDistricts($provinceId)
    {
        return $this->companyRepository->getDistricts($provinceId);
    }

    /**
     * Retrieves a list of wards based on the provided district ID.
     * Uses the repository to fetch wards associated with the given district.
     *
     * @param int $districtId
     * @access public
     * @author Hoang Duy Lap
     * @return \Illuminate\Database\Eloquent\Collection A collection of wards.
     */
    public function getWards($districtId)
    {
        return $this->companyRepository->getWards($districtId);
    }

    /**
     * Retrieves the company profile for editing.
     * If a slug is provided, it fetches the profile by slug. Otherwise, it retrieves the profile by user ID.
     *
     * @param string|null $slug
     * @param int $userId .
     * @access public
     * @author Hoang Duy Lap
     * @return mixed|null The company profile if found, otherwise null.
     */
    public function editProfile($slug, $userId)
    {
        if ($slug){
            return $this->companyRepository->findBySlug($slug);
        }else
            return $this->companyRepository->findById($userId);
    }

    /**
     * Updates or creates a company profile based on the provided identifier and data.
     * The identifier can either be a user ID or a slug.
     * If the company already exists, it updates the profile; otherwise, it creates a new one.
     *
     * @param mixed $identifier The identifier for the company profile (can be user ID or slug).
     * @param array $data The data to be updated or used to create a new profile.
     * @access public
     * @author Hoang Duy Lap
     * @return mixed The updated or newly created company profile.
     * @throws Exception If an error occurs during the update or creation process.
     */
    public function updateProfileService($identifier, $data)
    {
        try {
            // Kiểm tra và xử lý trường hợp identifier có thể là user_id hoặc slug
            $company = is_numeric($identifier)
                ? $this->companyRepository->findById($identifier)
                : $this->companyRepository->findBySlug($identifier);

            // Nếu không tìm thấy company, buộc phải tạo mới
            if (!$company) {
                $company = $this->companyRepository->updateProfile($identifier, $data);
            } else {
                // Nếu đã tồn tại company thì update
                $company = $this->companyRepository->updateProfile($identifier, $data);
            }

            return $company;
        } catch (Exception $e) {

            throw new Exception('Lỗi khi cập nhật thông tin: '. $e->getFile() . ' - '. $e->getLine() . ' - ' . $e->getMessage());
        }
    }

    public function getUniversity($request)
    {
        return $this->companyRepository->getUniversity($request);
    }

    public function dashboard()
    {
        $user = auth()->guard('admin')->user();
        $companyId = $user->company->id;
        return $this->companyRepository->dashboard($companyId);
    }

    public function getJobStats()
    {
        $user = auth()->guard('admin')->user();
        $companyId = $user->company->id ?? $user->hiring->company_id;
        return $this->companyRepository->getJobStats($companyId);
    }

    public function getChart($companyId, $dateFrom, $dateTo)
    {
        $records =  $this->companyRepository->getChart($companyId, $dateFrom, $dateTo);
        $jobPending = [];
        $jobApperoved = [];
        $jobReject = [];
        $jobDelete = [];
        $date = [];

        foreach ($records as $value) {
            array_push($jobPending, $value->total_pending_jobs);
            array_push($jobApperoved, $value->total_approved_jobs);
            array_push($jobReject, $value->total_reject_jobs);
            array_push($jobDelete, $value->total_deleted_jobs);
            array_push($date, $value->created_date);
        }

        return [
            'jobPending' => $jobPending,
            'jobApperoved' => $jobApperoved,
            'jobReject' => $jobReject,
            'jobDelete' => $jobDelete,
            'date' => $date
        ];
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

    public function getCompanyBySlug($slug)
    {
        return $this->companyRepository->getCompanyBySlug($slug);
    }

    public function getCompaniesWithJobsAndAddresses()
    {
        return $this->companyRepository->getCompaniesWithJobsAndAddresses();
    }

    public function getCompaniesWithFilters($query, $provinceId, $sortOrder)
    {
        return $this->companyRepository->getCompaniesWithFilters($query, $provinceId, $sortOrder);
    }
}
