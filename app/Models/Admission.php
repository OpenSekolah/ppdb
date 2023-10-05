<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Carbon\Carbon;

class Admission extends Model
{
    use HasFactory, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'year',
        'stage',
        'quota',
        'start_date',
        'end_date',
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
        'startDateAt',
        'endDateAt',
    ];
    
	public function getFormattedCreatedAtAttribute($value)
    {
        return Carbon::parse($this->created_at)->translatedFormat('d M Y H:i:s');
    }
        
    public function getFormattedUpdatedAtAttribute($value)
    {
        return Carbon::parse($this->updated_at)->translatedFormat('d M Y H:i:s');
    }

    public function getStartDateAtAttribute($value)
    {
        return Carbon::parse($this->start_date)->translatedFormat('d F Y');
    }

    public function getEndDateAtAttribute($value)
    {
        return Carbon::parse($this->end_date)->translatedFormat('d F Y');
    }

	public function scopeWhereIsActive($query, $search = true)
    {
        $query->where('is_active', $search);
    }

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where('year', 'LIKE', '%'.$term.'%');
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
            return collect(['data' => $query->orderBy('year', 'DESC')->get()]);
        }

        return $query->orderBy('year', 'DESC')->paginate($limit);
    }

	public static function createWebApp($request) {        
        $data = $request->validated();
        $data['start_date'] = Carbon::parse($data['start_date'])->translatedFormat('Y-m-d') ;
        $data['end_date'] = Carbon::parse($data['end_date'])->translatedFormat('Y-m-d');
        if($mdl = self::create($data)) {
			$mdl->fresh();
			//
		}
		
        return $mdl;
    }

    public function updateWebApp($request) {
        $data = $request->validated();
        $data['start_date'] = Carbon::parse($data['start_date'])->translatedFormat('Y-m-d') ;
        $data['end_date'] = Carbon::parse($data['end_date'])->translatedFormat('Y-m-d') ;
        if($this->update($data)) {
			//
		}

        return $this;
    }
}
