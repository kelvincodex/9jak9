<?php

namespace App\Http\Controllers;

use App\Service\AdminService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminsController extends Controller
{

    public function __construct(protected AdminService $adminService){
        //code here
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
    public function gallery(): View|Factory|Application
    {
        return $this->adminService->gallery();
    }
   //todo view customer
    public function subCategory(): View|Factory|Application
    {
        return $this->adminService->subCategory();
    }
}
