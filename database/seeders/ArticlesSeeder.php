<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Article::create([
                'title' => 'Управление ролями и разрешениями',
                'content' => '<p><strong>1. Начало работы</strong></p>
<p>Для начала работы перейдите в раздел <strong>"Пакеты разрешений"</strong>.</p>

<p><strong>2. Создание пакета разрешений</strong></p>
<p>Находясь в <strong>"Пакетах разрешений"</strong>:</p>
<ul>
<li>Задайте имя новому пакету разрешений</li>
<li>Выберите необходимые разрешения</li>
<li>При наличии всех разрешений пользователь автоматически получит статус <strong>"Модератор"</strong></li>
</ul>

<p><strong>3. Назначение прав администратора</strong></p>
<p>В этом же разделе находится ползунок <strong>"Администратор"</strong>. При его активации:</p>
<ul>
<li>Обладатель пакета получит уникальные права (подробнее в статье <strong>"Уникальные права"</strong>)</li>
<li>Получит статус <strong>"Администратор"</strong></li>
<li>Ему автоматически будут присвоены все базовые разрешения</li>
</ul>

<p><strong>4. Работа с ролями</strong></p>
<p>После создания пакета разрешений перейдите в раздел <strong>"Роли"</strong>:</p>
<ul>
<li>Укажите имя для новой роли</li>
<li>Выберите соответствующий пакет разрешений</li>
<li>Один пакет разрешений может быть закреплен за несколькими ролями</li>
<li>После создания роли изменения вступают в силу немедленно</li>
</ul>

<p><strong>5. Назначение ролей пользователям</strong></p>
<p>После создания роли:</p>
<ul>
<li>Передайте роль любому пользователю в разделе <strong>"Пользователи"</strong></li>
<li>После сохранения пользователя:</li>
<ul>
<li>Роль</li>
<li>Соответствующие права</li>
<li>Статус</li>
</ul>
<li>будут присвоены ему немедленно</li>
</ul>',
                'images' => null,
            ]);
        }
}
