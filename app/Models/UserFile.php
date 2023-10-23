<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;

class UserFile extends Model
{
    use HasFactory, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'register_form_id',
        'name',
        'file',
        'file_type',
    ];

	public $timestamps = true;

    public $incrementing = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];

	/**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    public static function createWebApp($request) {        
        $data = $request;
        if($user = self::updateOrCreate(['register_form_id' => $data['register_form_id']], $data)) {
            $user->fresh();
            $rgform = RegisterForm::find($user->register_form_id);
            $rgform->address = $user->address;
            $rgform->save();
		}
		
        return $user;
    }
}
