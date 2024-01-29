<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info text-white">
                <p><?=Yii::$app->user->identity->username?Yii::$app->user->identity->username:'User' ?></p>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Kitoblar',
                        'icon' => 'book',                       
                        'items' => [
                            ['label' => 'Kitoblar', 'url' => ['books/index'], 'iconStyle' => 'far'],
                            ['label' => 'Bilimlar sohasi', 'url' => ['knowledge/index'], 'iconStyle' => 'far'],
                            ['label' => 'Fanlar', 'url' => ['subject/index'], 'iconStyle' => 'far'],
                            ['label' => 'Kitoblar turi', 'url' => ['type-book/index'], 'iconStyle' => 'far'],
                            ['label' => 'Kitoblar tili', 'url' => ['language-book/index'], 'iconStyle' => 'far'],
                            ['label' => 'Mualliflar', 'url' => ['author/index'], 'iconStyle' => 'far'],
                            ['label' => 'Kitob-Muallif', 'url' => ['book-author/index'], 'iconStyle' => 'far'],
                            ['label' => 'Mamlakatlar', 'url' => ['country/index'], 'iconStyle' => 'far'],
                            ['label' => 'Kalit so\'zlar', 'url' => ['tag/index'], 'iconStyle' => 'far'],
                            ['label' => 'Kitob-Kalit so\'zlar', 'url' => ['book-tag/index'], 'iconStyle' => 'far'],
                            ['label' => 'Joylashuv', 'url' => ['location/index'], 'iconStyle' => 'far'],
                        ]
                    ],
                    ['label' => 'Kitob-Muallif', 'url' => ['book-author/index'], 'icon' => 'book', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Kitob-Kalit so\'z', 'url' => ['book-tag/index'], 'icon' => 'tags', 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Talabalar',
                        'icon' => 'graduation-cap',                       
                        'items' => [
                            ['label' => 'Olingan kitoblar', 'url' => ['customer/index'], 'iconStyle' => 'far'], 
                            ['label' => 'Kitob berish', 'url' => ['customer/create'], 'iconStyle' => 'far'],
                            ['label' => 'Qarzdorlar ro\'yxati', 'url' => ['customer/debt'], 'iconStyle' => 'far'],                    
                        ]
                    ],
                    [
                        'label' => 'Xodimlar',
                        'icon' => 'user',                       
                        'items' => [
                            ['label' => 'Olingan kitoblar', 'url' => ['customer-employee/index'], 'iconStyle' => 'far'], 
                            ['label' => 'Kitob berish', 'url' => ['customer-employee/create'], 'iconStyle' => 'far'],
                            ['label' => 'Qarzdorlar ro\'yxati', 'url' => ['customer-employee/debt'], 'iconStyle' => 'far'],                    
                        ]
                    ],
                    [
                        'label' => 'Inventar raqamlari',
                        // icon inventory
                        'icon' => 'arrow-up',
                        'items' => [
                            ['label' => 'Inventar raqamlari', 'url' => ['book-inventory/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    
                   
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>