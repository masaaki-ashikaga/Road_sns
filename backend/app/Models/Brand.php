<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function createBrand($request)
    {
        $this->name = $request->name;
        $this->text = $request->text;
        $this->brand_image = $request->brand_image;
        $this->save();
        return;
    }

    public function updateBrand($request, $brand)
    {
        $new_brand = $this::find($brand->id);
        $new_brand->name = $request->name;
        $new_brand->text = $request->text;
        $new_brand->brand_image = $request->brand_image;
        $new_brand->update();
        return;
    }
}
