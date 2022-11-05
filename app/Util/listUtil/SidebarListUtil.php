<?php

namespace App\Util\listUtil;

trait SidebarListUtil
{
    public array $sidebarList = array(
        [
            'icon' => 'bi bi-grid',
            'heading' => '',
            'navItem' => 'OverView',
            'link' => 'overview',
        ],

        [
            'icon' => 'bi bi-bag',
            'heading' => 'Product',
            'navItem' => 'Products',
            'link' => '#',
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
            'icon' => 'bi bi-mailbox2',
            'heading' => 'Category',
            'navItem' => 'Categories',
            'link' => '#',
        ],

        [
            'icon' => 'bi bi-mailbox2',
            'heading' => 'Sub-Categories',
            'navItem' => 'Sub-Categories',
            'link' => '#',
        ],
        [
            'icon' => 'bi bi-shift',
            'heading' => 'Order',
            'navItem' => 'Order',
            'link' => '#',
        ],

        [
            'icon' => 'bi bi-shift',
            'heading' => 'Transaction',
            'navItem' => 'Transaction',
            'link' => '#',
        ],
        );
}
