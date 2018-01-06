<?php

namespace App\Wap\Http\Controllers\Exhibition;

use App\Service\Brand\BrandCertificateService;
use App\Service\Product\ProductService;
use App\Service\Provider\ProviderService;
use App\Src\Brand\Infra\Repository\BrandCertificateRepository;
use App\Src\Product\Domain\Model\ProductSpecification;
use App\Src\Provider\Domain\Model\ProviderMainCategoryEntity;
use App\Src\Provider\Domain\Model\ProviderSpecification;
use App\Src\Provider\Domain\Model\ProviderStatus;
use App\Src\Provider\Infra\Repository\ProviderMainCategoryRepository;
use App\Wap\Http\Controllers\BaseController;
use App\Wap\Service\Provider\ProviderWapService;
use App\Wap\Src\Forms\Provider\ProviderSearchForm;
use App\Service\Category\CategoryService;
use App\Src\Category\Domain\Model\CategoryEntity;
use App\Src\Category\Infra\Repository\CategoryRepository;
use App\Service\Brand\BrandSaleService;
use App\Service\Brand\BrandSignListService;
use App\Service\Brand\BrandService;
use App\Service\Brand\BrandServiceService;
use App\Wap\Src\Forms\Provider\ProviderSignListSearchForm;
use App\Src\Brand\Domain\Model\ServiceType;
use App\Src\Brand\Domain\Model\BrandSignListSpecification;
use App\Src\Provider\Domain\Model\ProviderEntity;
use App\Src\Provider\Infra\Repository\ProviderRepository;
use Illuminate\Http\Request;


class ProviderController extends BaseController
{
    public function index(Request $request, ProviderSearchForm $form)
    {
        $data = [];
        $this->title = '供应商列表';
        $this->file_css = 'pages.exhibition.provider.index';
        $this->file_js = 'pages.exhibition.provider.index';
        $form->validate($request->all());
        $per_page = $request->get('per_page', 10);
        $provider_wap_service = new ProviderWapService();
        $data = $provider_wap_service->getProviderList($form->provider_specification, 10);

        $appends = $this->getProviderAppends($form->provider_specification);
        $appends['per_page'] = $per_page;
        $appends['page'] = $data['page']['current_page'] ?? 1;

        $data['appends'] = $appends;

        return $this->view('pages.exhibition.provider.index', $data);
    }

    public function detail(Request $request, $id)
    {
        $data = [];
        $this->title = '供应商详情';
        $this->file_css = 'pages.exhibition.provider.detail';
        $this->file_js = 'pages.exhibition.provider.detail';
        //基本信息
        $provider_wap_service = new ProviderWapService();
        $provider = $provider_wap_service->getProviderDetailById($id);
        $data['provider'] = $provider;

        //服务信息
        $brand_service_service = new BrandServiceService();
        $data['brand_service'] = $brand_service_service->getBrandServiceInfo($id);

        $data['provider_id'] = $id;
        return $this->view('pages.exhibition.provider.detail', $data);
    }

    public function honor(Request $request, $id)
    {
        $data = [];
        $this->title = '供应商列表';
        $this->file_css = 'pages.exhibition.provider.honor';

        //获取证书
        $brand_certificate_service = new BrandCertificateService();

        $certificate_images = $brand_certificate_service->getBrandAndProviderCertificatesById($id);
        $data['certificate_images'] = $certificate_images;
        return $this->view('pages.exhibition.provider.honor', $data);
    }

    public function cases(Request $request, $id)
    {
        $data = [];
        $this->title = '供应商列表';
        $this->file_css = 'pages.exhibition.provider.case';
        //项目清单

        $brand_sign_list_service = new BrandSignListService();
        $data['provider_sign_list'] = $brand_sign_list_service->getBrandSignListListByProviderId($id);

        $data['provider_id'] = $id;
        return $this->view('pages.exhibition.provider.case', $data);
    }


    public function getProviderAppends(ProviderSpecification $spec)
    {
        $appends = [];
        if ($spec->keyword) {
            $appends['keyword'] = $spec->keyword;
        }
        if ($spec->product_category_id) {
            $appends['product_category_id'] = $spec->product_category_id;
        }
        if ($spec->user_id) {
            $appends['keyword'] = $spec->user_id;
        }
        if ($spec->status) {
            $appends['status'] = $spec->status;
        }
        return $appends;
    }


}
