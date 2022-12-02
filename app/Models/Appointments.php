<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    public static function findByDate($date)
    {
        $allItems = [];
        foreach (self::all() as $item) {
            if ($item['date'] == $date) {

                $allItems[] = $item;
            }
        }
        return $allItems;
    }
    public static function existInterval($data)
    {
        $day = self::findByDate($data['date']);
        $start = explode(":", explode(" - ", $data['interval'])[0])[0] * 2;
        $start += explode(":", explode(" - ", $data['interval'])[0])[1] == 30 ? 1 : 0;
        foreach ($day as $details) {
            $lockInterval = explode(":", explode(" - ", $details['interval'])[0])[0] * 2;
            $lockInterval += explode(":", explode(" - ", $details['interval'])[0])[1] == 30 ? 1 : 0;
            if ($lockInterval <= $start + 4 && $start < $lockInterval + 4) {
                return true;
            }
        }
        return false;
    }
    public static function validator($items)
    {
        foreach ($items as $item) {
            if ($item == null) {
                return false;
            }
        }
        return $items;
    }
}