<?php


namespace App\Http\Requests;


use App\Models\Category;

/**
 * @method post(string $attr)
 */
trait CategoryRequest
{

    public function toModel(Category $category = null): Category
    {
        if ($category == null) {
            $category = new Category();
        }
        $attrs = array('code', 'name', 'description', 'parent_id');
        foreach ($attrs as $attr) {
            $category->setAttribute($attr, $this->post($attr));
        }
        $category->setAttribute('status', 1);
        return $category;
    }
}
