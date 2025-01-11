<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Facades\Filament;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use App\Traits\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable, HasProfilePhoto, HasRoles;

    // protected $appends = [
    //     'profile_photo',
    // ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'employment_date',
        'join_ggssa_date',
        'gngc_staff_number',
        'department',
        'gngc_job_title',
        'workstation',
        'date_of_birth',
        'contact_number',
        'whatsapp_number',
        'gngc_email',
        'marital_status',
        'number_of_children',
        'religion',
        'status',
        'profile_set',
        'profile_photo',
        'emergency_contact',
        'password',
        'emergency_contact_name',
        'relationship_with_emergency_contact',
        'next_of_kin',
        'next_of_kin_contact',
        'relationship_with_next_of_kin',
        'ggssa_member_id',
        'email_verified_at',
        'password_changed'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        // return str_ends_with($this->email, '@gmail.com') && $this->hasVerifiedEmail();
        return $this->hasVerifiedEmail();

    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'gngc_staff_number_key', 'gngc_staff_number');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->profile_photo;
    }

    public function isSuperAdmin(): bool
    {
        return Auth::user()->hasRole('super-admin');
        // dd(self::);
    //    return  self::hasRole('super-admin');
    }

 
}
