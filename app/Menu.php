<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Menu extends Model
{

    protected $fillable = [
        "nombre","descripcion","precio", "foto", "user_id", "type_menu", 'precio_venta'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where(function($query){

            if(!$query->get()->isEmpty())
            {
                $menu = $query->first();
                $id =$menu->id;
                $created_at = $menu->updated_at->format('Y-m-d');
                $type_menu = $menu->type_menu;

                if($type_menu  == "1")
                {
                    if ($this->isExpired($created_at, "diario"))
                        $query->where('id',"<>", $id);
                }
                else
                {
                    if ($this->isExpired($created_at, "semanal"))
                        $query->where('id',"<>", $id);
                }
            }

        });
    }

    public function isExpired($created_at, $type = null)
    {
        if ($type == "diario")
            $fechaExpiracion = strtotime ( '+1 day' , strtotime ( $created_at ) ) ;
        else
            $fechaExpiracion = strtotime ( '+7 day' , strtotime ( $created_at ) ) ;


        $fechaExpiracion = date ( 'Y-m-j' , $fechaExpiracion );
        $fechaExpiracion = $fechaExpiracion." 23:59:59";

        return ($fechaExpiracion <= Carbon::now()->format('Y-m-j h:i:s'));
    }

}
