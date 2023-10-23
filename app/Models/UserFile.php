<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
    protected $appends = [
        'photoAt'
    ];

    public function getPhotoAtAttribute($value)
    {
        try {
            if($this->file !== null) {
                $file = "userfile/{$this->file_type}/{$this->file}";
                if(Storage::disk('public')->exists($file)) {
                    return asset("storage/{$file}?"  . time());
                }
            }
            return asset("images/profile.jpg?" . time());
        } catch (\Exception $exception) {
            return asset("images/profile.jpg?" . time());
        }
    }

    public static function createWebApp($request) {        
        $data = $request->only(['register_form_id', 'file_type']);
        if($request->hasFile('file_photo')) {
            if($mdl = UserFile::updateOrCreate(['register_form_id' => $data['register_form_id'], 'file_type' => $data['file_type']], $data)) {
                Storage::disk('public')->delete("userfile/{$mdl->file_type}/{$mdl->file}");
                $file = $request->file('file_photo');
                $filename = md5($mdl->id) . '.' . $file->getClientOriginalExtension();
                $file->storeAs("userfile/{$mdl->file_type}/", $filename, ['disk' => 'public']);
                $mdl->name = $file->getClientOriginalName();
                $mdl->file = $filename;
                $mdl->save();
            }
        } 

        return true;
    }
}
