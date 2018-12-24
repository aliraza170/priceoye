<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Expenses
 *
 * @package App
 * @property string $title
*/
class Expenses extends Model
{
    
    protected $fillable = ['amount','category_id','user_id'];
   // protected $fillable = ['category_id'];
    

    public static function storeValidation($request)
    {
        return [
            'amount' => 'max:191|required',
            'category_id' => 'required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'amount' => 'max:191|required',
            'categories_id' => 'integer|required'
        ];
    }
	
	public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    

    
    
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
    
    
}
