<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class Manager extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'formattedCreatedAt',
        'formattedUpdatedAt',
        'photoAt',
    ];

    public function getPhotoAtAttribute($value)
    {
        try {
            if($this->profile_photo_path !== null) {
                $file = "manager_profiles/{$this->profile_photo_path}";
                if(Storage::disk('public')->exists($file)) {
                    return asset("storage/{$file}?"  . time());
                }
            }
            return asset("images/profile.jpg?" . time());
        } catch (\Exception $exception) {
            return asset("images/profile.jpg?" . time());
        }
    }

    public function getFormattedCreatedAtAttribute($value)
    {
        try {
            return Carbon::parse($this->created_at)->format('d F Y H:i:s');
        } catch (\Exception $exception) {
            return null;
        }
    }
    
    public function getFormattedUpdatedAtAttribute($value)
    {
        try {
            return Carbon::parse($this->updated_at)->format('d F Y H:i:s');
        } catch (\Exception $exception) {
            return null;
        }
    }

    public function scopeWhereIsActive($query, $search = true)
    {
        $query->where('is_active', $search);
    }

	public function scopeWhereEmailNotIn($query, $search = [])
    {
        $query->whereNotIn('email', $search);
    }

	public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where('name', 'LIKE', '%'.$term.'%')
                ->orWhere('email', 'LIKE', '%'.$term.'%');
        }
    }
    
    public function scopeApplyFilters($query, array $filters)
    {
        $filters = collect($filters);
        if ($filters->get('search')) {
            $query->whereSearch($filters->get('search'));
        }
    }

    public function scopePaginateData($query, $limit)
    {
        if ($limit == 'all') {
            return collect(['data' => $query->get()]);
        }

        return $query->paginate($limit);
    }

	public static function createWebApp($request) {        
        $data = $request;
        $data['is_active'] = (int) $data['is_active'];

        if(isset($data['password']) && $data['password']) {
			$data['password'] = Hash::make($data['password']);
		}

        if($customer = self::create($data)) {
			$customer->fresh();
		}
        return $customer;
    }

    public function updateWebApp($request) {
        $data = $request->validated();
        $data['is_active'] = (int) $data['is_active'];

		if(isset($data['password']) && $data['password']) {
			$data['password'] = Hash::make($data['password']);
		} else {
			unset($data['password']);
		}
        
        if($this->update($data)) {
            if($request->hasFile('image')) {
                Storage::disk('public')->delete("manager_profiles/{$this->profile_photo_path}");
                
                $file = $request->file('image');
                $filename = md5($this->id) . '.' . $file->getClientOriginalExtension();
                $file->storeAs("manager_profiles/", $filename, ['disk' => 'public']);
                $this->profile_photo_path = $filename;
                $this->save();
            }
		}

        return $this;
    }
}
