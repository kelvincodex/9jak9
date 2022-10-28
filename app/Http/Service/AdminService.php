<?php

namespace App\Http\Service;

use App\Http\Controllers\BrandsController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Util\listUtil\SidebarListUtil;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class AdminService
{
    use SidebarListUtil;

    public ?string $currentRouteName;

    /*todo constructor */
    public function __construct(
        protected CategoryService $categoryService
    )
    {
        $this->currentRouteName = Route::currentRouteName();
    }

    /*todo overview*/
    public function overview(): Factory|View|Application
    {
        return view('admin.dashboard.index', [
            'sidebar'=>$this->sidebarList, 'routeName'=>$this->currentRouteName
        ]);
    }

    /*todo products*/
    public function products(): Factory|View|Application
    {
        return view('admin.product.index',[
            'sidebar'=>$this->sidebarList,
            'routeName'=>$this->currentRouteName
        ]);
    }

    /*todo add products*/
    public function addProduct(): Factory|View|Application
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.add', [
            'sidebar'=>$this->sidebarList,
            'routeName'=>$this->currentRouteName,
            'categories'=>$categories,
            'brands'=>$brands,
        ]);
    }
    /*todo orders*/
    public function orders(): Factory|View|Application
    {
        return view('admin.orderView');
    }


    /*todo staff*/
    public function staffs(): Factory|View|Application
    {
        return view('admin.staffView');
    }

    /*todo delivery*/
    public function deliveries(): Factory|View|Application
    {
        return view('admin.deliveryView');
    }




    /*todo category*/
    public function categories(): Factory|View|Application
    {
        $categories = Category::latest()->get();
        return view('admin.category.index',  [
            'sidebar'=>$this->sidebarList,
            'routeName'=>$this->currentRouteName,
            'categories'=>$categories,
        ]);
    }

    /*todo view customer*/
    public function customers(): Factory|View|Application
    {
        return view('admin.customerView');
    }

}
