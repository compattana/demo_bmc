<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use LogsActivity;
    use HasRoles;
    use HasFactory, Notifiable;

	protected $table = 'users';
//	public $incrementing = false;

    const INFO_DB = 'ผู้ใช้ระบบ';

    const ROLE_SUPER_MAN = 'super man';
    const ROLE_SUPER_ADMIN = 'super admin';
    const ROLE_ADMIN = 'admin';
    const ROLE_TECHNICIAN = 'technicians';

    const USER_ACTIVE = 'active';
    const USER_INACTIVE= 'inactive';

    protected static $logAttributes = ['*'];
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
	protected $casts = [
		'id' => 'int'
	];



	protected $dates = [
         'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'username',
		'name',
		'email',
		'email_verified_at',
		'password',
		'active',
		'remember_token'
	];

    public function isTechnician()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == User::ROLE_TECHNICIAN)
            {
                return true;
            }
        }
    }

	public function technicianReports()
	{
		return $this->hasMany(TechnicianReport::class);
	}

    public function technicianPm()
    {
        return $this->hasMany(TechnicianPm::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
