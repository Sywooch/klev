<?php

return [
    'develop' => true,
    'adminEmail' => 'kilinanatoly@gmail.com',
    'supportEmail' => 'kilinanatoly@gmail.com',
    'characteristics'=>[
        '0'=>'Текстовое поле',
        '1'=>'Радио кнопка',
        '2'=>'Чекбокс',
        '3'=>'Выпадающий список',
    ],
    'admin_menu'=>[
        'modules'=>[
            'static_pages'=>[
                'url'=>'/admin/pages',
                'icon'=>'static_pages.png',
                'enable'=>true,
                'title'=>'Статичные страницы'
            ],
            /*'obrat-list'=>[
                'url'=>'/admin/obrat-list/index',
                'icon'=>'obrat.png',
                'enable'=>true,
                'title'=>'Обратная связь'
            ],*/
            'obrat-form1'=>[
                'url'=>'/admin/custom-form1/index',
                'icon'=>'obrat.png',
                'enable'=>true,
                'title'=>'Обратная связь'
            ],
            'uslugi'=>[
                'url'=>'/admin/uslugi/index',
                'icon'=>'uslugi.png',
                'enable'=>true,
                'title'=>'Услуги'
            ],
            'objects'=>[
                'url'=>'/admin/objects/index',
                'icon'=>'objects.png',
                'enable'=>true,
                'title'=>'Объекты'
            ],
            'reviews'=>[
                'url'=>'/admin/reviews/index',
                'icon'=>'reviews.png',
                'enable'=>true,
                'title'=>'Отзывы'
            ],
            'licenses'=>[
                'url'=>'/admin/licenses/index',
                'icon'=>'licenses.png',
                'enable'=>true,
                'title'=>'Лицензии'
            ],
            'partners'=>[
                'url'=>'/admin/partners/index',
                'icon'=>'partners.png',
                'enable'=>true,
                'title'=>'Партнеры'
            ],
            'peremena'=>[
                'url'=>'/admin/peremena/index',
                'icon'=>'code.png',
                'enable'=>true,
                'title'=>'Переменные'
            ],
            'characteristics'=>[
                'url'=>'/admin/characteristics/index',
                'icon'=>'code.png',
                'enable'=>true,
                'title'=>'Технические характеристики'
            ],
            'cats'=>[
                'url'=>'/admin/cats/index',
                'icon'=>'code.png',
                'enable'=>true,
                'title'=>'Категории'
            ],
            'products'=>[
                'url'=>'/admin/products/index',
                'icon'=>'code.png',
                'enable'=>true,
                'title'=>'Товары'
            ],
            'Удобства'=>[
                'url'=>'/admin/comfort/index',
                'icon'=>'code.png',
                'enable'=>true,
                'title'=>'Удобства'
            ],
            'fishes'=>[
                'url'=>'/admin/fishes/index',
                'icon'=>'code.png',
                'enable'=>true,
                'title'=>'Рыбы'
            ],
            'users'=>[
                'url'=>'/admin/user/index',
                'icon'=>'code.png',
                'enable'=>true,
                'title'=>'Исполнители'
            ]

        ]
    ],
];
