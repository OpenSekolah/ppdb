<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use PDF;

class User extends Authenticatable
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
        'profile_photo_url',
    ];

    public function register_form() {
        return $this->hasOne(RegisterForm::class, 'user_id');
    }

    public function getPdf() {
        
        $register_form = RegisterForm::with([
            'competencefirst',
            'competencesecond',
            'admission',
            'addresses',
            'parent_guardians',
            'user_files',
        ])->where('user_id', $this->id)->first();

        $data = [
            'register_form' => $register_form
        ];

        $pdf = PDF::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->setPaper('A4', 'portrait')
            ->setWarnings(false)
            ->loadView('pdf.user.register', $data);	 

        //return $pdf->stream("invoice-{$this->invoice_number}.pdf");
        return response()->make($pdf->stream(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="invoice-'.$this->invoice_number.'.pdf"',
        ]);
    }

    public static function createWebApp($request) {        
        $adminssion = Admission::where('is_active', true)->get();
        if($adminssion) {
            if(count($adminssion) == 1) {
                $data = $request;
                $data['password'] = Hash::make($data['password']);
                if($user = self::create($data)) {
                    $user->fresh();
                    $data['user_id'] = $user->id;
                    $data['admission_id'] = $adminssion[0]['id'];
                    $user->register_form()->create($data);
                }
                
                return $user;
            }
        }
    }
}
