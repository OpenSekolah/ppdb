<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SerialNumberFormatter;
use App\Traits\Uuid;
use Carbon\Carbon;

class RegisterForm extends Model
{
    use HasFactory, Uuid, SerialNumberFormatter;

	/**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'admission_id',
        'user_id',
        'competence_first',
        'competence_second',
        'sequence_number',
        'register_number',
        'name',
        'nisn',
        'place_of_birth',
        'date_of_birth',
        'address',
        'from_school',
        'status',  
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
        'dateOfBirthAt',
        'statusAt',
    ];
    
    public function admission() {
        return $this->hasOne(Admission::class, 'id', 'admission_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function competencefirst() {
        return $this->hasOne(SkillCompetence::class, 'id', 'competence_first');
    }

    public function competencesecond() {
        return $this->hasOne(SkillCompetence::class, 'id', 'competence_second');
    }
    
	public function getFormattedCreatedAtAttribute($value)
    {
        return Carbon::parse($this->created_at)->translatedFormat('d M Y H:i:s');
    }
        
    public function getFormattedUpdatedAtAttribute($value)
    {
        return Carbon::parse($this->updated_at)->translatedFormat('d M Y H:i:s');
    }

    public function getDateOfBirthAtAttribute($value)
    {
        return Carbon::parse($this->date_of_birth)->translatedFormat('d M Y');
    }

    public function getStatusAtAttribute($value)
    {
        $status = "";
        if($this->status == 'verified') {
            $status = "Diverifikasi";
        } else if($this->status == 'accepted') {
            $status = "Diterima";
        } else if($this->status == 'reserved') {
            $status = "Dicadangkan";
        }

        return $status;
    }

	public function scopeWhereIsActive($query, $search = true)
    {
        $query->where('is_active', $search);
    }

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where('name', 'LIKE', '%'.$term.'%')
                ->orWhere('nisn', 'LIKE', '%'.$term.'%');
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
        $data = $request->validated();
        if($this->update($data)) {
			//
		}

        return $this;
    }
}
