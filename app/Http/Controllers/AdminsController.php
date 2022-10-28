<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Service\AdminService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminsController extends Controller
{

    public function __construct(protected AdminService $adminService){
        $this->adminService = $adminService;

    }
    //todo overview
    public function overview(): View|Factory|Application
    {
        return $this->adminService->overview();
    }
    //todo view products
    public function products(): View|Factory|Application
    {
        return $this->adminService->products();
    }
    //todo add view products
    public function addProduct(): View|Factory|Application
    {
        return $this->adminService->addProduct();
    }

    //todo view categories
    public function categories(): View|Factory|Application
    {
        return $this->adminService->categories();
    }
    //todo view staffs
    public function staffs(): View|Factory|Application
    {
        return $this->adminService->staffs();
    }
   //todo view customer
    public function customers(): View|Factory|Application
    {
        return $this->adminService->customers();
    }
}
