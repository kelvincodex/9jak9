<?php

namespace App\Util\listUtil;

trait SidebarListUtil
{
    public array $sidebarList = array(
        [
            'icon' => 'bi bi-grid',
            'heading' => '',
            'navItem' => 'OverView',
            'child' =>[
                [
                    'icon' => 'bi bi-book-half',
                    'title' => 'Overview',
                    'link' => 'overview',
                ],
            ],
        ],
        [
            'icon' => 'bi bi-person-square',
            'heading' => 'Staff Management',
            'navItem' => 'Staffs',
            'child' =>[
                [
                    'icon' => 'bi bi-book-half',
                    'title' => 'View Staffs',
                    'link' => 'staffs',
                ],
                [
                    'icon' => 'bi bi-person-plus',
                    'title' => 'Add Staff',
                    'link' => 'addStaff',
                ],

            ],
        ],
        [
            'icon' => 'bi bi-person-square',
            'heading' => 'Customer Management',
            'navItem' => 'Customers',
            'child' =>[
                [
                    'icon' => 'bi bi-book-half',
                    'title' => 'View Users',
                    'link' => 'customers',
                ],
            ],
        ],
        [
            'icon' => 'bi bi-bag',
            'heading' => 'Product',
            'navItem' => 'Products',
            'child' =>[
                [
                    'icon' => 'bi bi-bag',
                    'title' => 'View Products',
                    'link' => 'products',
                ],
                [
                    'icon' => 'bi bi-bag-plus',
                    'title' => 'Add Product',
                    'link' => 'addProduct',
                ],
            ],
        ],
        [
            'icon' => 'bi bi-bounding-box-circles',
            'heading' => 'Brand',
            'navItem' => 'Brands',
            'child' =>[

                [
                    'icon' => 'bi bi-bounding-box-circles',
                    'title' => 'View Brands',
                    'link' => 'brands',
                ],

            ],
        ],
        [
            'icon' => 'bi bi-mailbox2',
            'heading' => 'Category',
            'navItem' => 'Categories',
            'child' =>[

                [
                    'icon' => 'bi bi-mailbox2',
                    'title' => 'View Categories',
                    'link' => 'categories',
                ],
            ],
        ],
        [
            'icon' => 'bi bi-shift',
            'heading' => 'Order',
            'navItem' => 'Order',
            'child' =>[
                [
                    'icon' => 'bi bi-shift',
                    'title' => 'View Orders',
                    'link' => 'orders',
                ],
            ],
        ],
        [
            'icon' => 'bi bi-bucket',
            'heading' => 'Delivery',
            'navItem' => 'Deliveries',
            'child' =>[
                [
                    'icon' => 'bi bi-bucket',
                    'title' => 'View Deliveries',
                    'link' => 'deliveries',
                ],
            ],
        ],
        );
}
