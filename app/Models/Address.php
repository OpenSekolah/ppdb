<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;

class Address extends Model
{
    use HasFactory, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'register_form_id',
        'residence',
        'address',
        'rt',
        'rw',
        'village',
        'subdistrict',
        'province',
        'postal_code',
        'address_coordinates',
        'transportation',
        'distance',
        'traveling_time',
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
		'formattedCreatedAt',
        'formattedUpdatedAt',
    ];
    
	public function getFormattedCreatedAtAttribute($value)
    {
        return Carbon::parse($this->created_at)->translatedFormat('d M Y H:i:s');
    }
        
    public function getFormattedUpdatedAtAttribute($value)
    {
        return Carbon::parse($this->updated_at)->translatedFormat('d M Y H:i:s');
    }

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where('residence', 'LIKE', '%'.$term.'%')
                ->orWhere('address', 'LIKE', '%'.$term.'%');
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
            return collect(['data' => $query->orderBy('name', 'ASC')->get()]);
        }

        return $query->orderBy('name', 'ASC')->paginate($limit);
    }

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

    public function updateWebApp($request) {
        $data = $request;
        if($this->update($data)) {
			//
		}

        return $this;
    }
}
