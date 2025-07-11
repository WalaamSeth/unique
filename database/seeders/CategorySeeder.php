<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Электроника',
            'Компьютеры',
            'Бытовая техника',
            'Смартфоны',
            'Телевизоры',
            'Наушники',
            'Фототехника',
            'Офисная техника',
            'Игровые консоли',
            'Аксессуары',
            'Мебель',
            'Освещение',
            'Текстиль',
            'Посуда',
            'Кухонные принадлежности',
            'Сантехника',
            'Инструменты',
            'Строительные материалы',
            'Автотовары',
            'Велосипеды',
            'Спортивные товары',
            'Туризм',
            'Охота и рыбалка',
            'Книги',
            'Канцтовары',
            'Игрушки',
            'Творчество',
            'Музыкальные инструменты',
            'Антиквариат',
            'Сувениры'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
        }
    }
}
