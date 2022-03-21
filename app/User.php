<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'business_name', 'address', 'vat_number', 'img_path', 'slug', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relazione delle categorie
    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function dishes() {
        return $this->hasMany('App\Dish');
    }

    // Funzione che genera slug unici a partire dal "business_name"
    public static function getUniqueSlugFromTitle($business_name) {
        $slug = Str::slug($business_name);
        $slug_base = $slug;

        $business_name_found = User::where('slug', '=', $slug)->first();
        $counter = 1;
        while ($business_name_found) {
            $slug = $slug_base . '-' . $counter;
            $business_name_found = User::where('slug', '=', $slug)->first();
            $counter++;
        }

        return $slug;
    }
}
