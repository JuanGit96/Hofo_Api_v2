<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "hour",
        "address",
        "amount_people",
        "additional_comments",
        "total_charge",
        "type_order",
        "type_pay",
        "menu_id",
        "diner_id",

        #para servicios agendados
        "modality",
        "chance",
        "food_type",
        "isSchedule",

        "domiciliary"

    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function diner()
    {
        return $this->belongsTo(User::class, 'diner_id');
    }
}
