<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Support\Str;

class Merchant extends Authenticable
{
    use HasFactory;

    /**
     * Contains an array of the fieldnames which required to fill when creating new merchant.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'token'];

    public function createToken(): string
    {
//        $string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//        $token = substr(string: str_shuffle(string: $string), offset: 0, length: 30);
        $token = Str::random(length: 30);
        $this->token = hash(algo: 'sha256', data: $token);
        $this->save();

        return $token;
    }
}
