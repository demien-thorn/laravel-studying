<?php


namespace App\ViewComposers;


use App\Models\Category;
use Illuminate\View\View;

class CategoriesComposer
{
    public function compose(View $view): void
    {
        $categories = Category::get();
        $view->with(key: 'categories', value: $categories);
    }
}
