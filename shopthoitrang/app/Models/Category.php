<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_category';
    
    protected $fillable = [
        'name_category',
        'image_category'
    ];

    public static function findCategoryById($id)
    {
        return self::findOrFail($id);
    }

    public static function createCategory($data)
    {
        return self::create([
            'name_category' => $data['name'],
            'image_category' => $data['image_categori'],
        ]);
    }

    public static function updateCategoryById($id, $data)
    {
        $category = self::findCategoryById($id);
        if ($category) {
            $category->name_category = $data['name'];
            if (isset($data['image_categori'])) {
                $category->image_category = $data['image_categori'];
            }
            $category->save();
            return $category;
        }
        return null;
    }

}