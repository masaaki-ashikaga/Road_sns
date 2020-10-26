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
        $file_name = $request->file('brand_image')->store('public/images');
        $this->name = $request->name;
        $this->text = $request->text;
        $this->brand_image = basename($file_name);
        $this->save();
        return;
    }

    public function updateBrand($request, $brand)
    {
        $new_brand = $this::find($brand->id);
        $file_name = $request->file('brand_image')->store('public/images');
        $new_brand->name = $request->name;
        $new_brand->text = $request->text;
        $new_brand->brand_image = basename($file_name);
        $new_brand->update();
        return;
    }
}
