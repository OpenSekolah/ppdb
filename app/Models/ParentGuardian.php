<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;

class ParentGuardian extends Model
{
    use HasFactory;

    use HasFactory, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'register_form_id',
        'status',
        'nik',
        'name',
        'place_of_birth',
        'date_of_birth',
        'education',
        'work',
        'income',
        'phone',
        'data_type',
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
            $query->where('nik', 'LIKE', '%'.$term.'%')
                ->orWhere('name', 'LIKE', '%'.$term.'%');
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
        $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
        if($user = self::updateOrCreate([
            'register_form_id' => $data['register_form_id'],
            'data_type' => $data['data_type'],
        ], $data)) {
			$user->fresh();
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
