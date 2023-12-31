<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;

class SkillCompetence extends Model
{
    use HasFactory, Uuid;

	/**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'desc',
        'is_active',
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

	public function scopeWhereIsActive($query, $search = true)
    {
        $query->where('is_active', $search);
    }

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where('name', 'LIKE', '%'.$term.'%')
                ->orWhere('desc', 'LIKE', '%'.$term.'%');
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
        if($user = self::create($data)) {
			$user->fresh();
			//
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
