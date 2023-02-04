<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publicidade extends Model
{
    use HasFactory;

    public function getPublicidade()
    {
        return DB::select("SELECT * FROM publicidade limit 50");

    }
}