<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categories
 *
 * @package App
 * @property string $title
*/
class Categories extends Model
{
    
    protected $fillable = ['name'];
    

    public static function storeValidation($request)
    {
        return [
            'name' => 'max:191|required'
           // 'permission' => 'array|required',
            //'permission.*' => 'integer|exists:permissions,id|max:4294967295|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name' => 'max:191|required'
           // 'permission' => 'array|required',
            //'permission.*' => 'integer|exists:permissions,id|max:4294967295|required'
        ];
    }

    

    
    
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
    
    
}
