<?php

namespace App;

use App\Notifications\SMSVerify;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function recurrings()

    {

        return $this->hasManyThrough(RecurringExpense::class, ExpenseHead::class, 'user_id', 'expense_head_id', 'id', 'id');

    }

    public function expenses()

    {

        return $this->hasManyThrough(Expense::class, ExpenseHead::class, 'user_id', 'expense_head_id', 'id', 'id');

    }

    public function ExpenseHeads()

    {

        return $this->hasMany(ExpenseHead::class, 'user_id', 'id');

    }

    /*
     * Wallets
     * */

    public function wallets()

    {

        return $this->hasMany(Wallet::class, 'user_id', 'id');

    }

    public function earnings()

    {

        return $this->hasMany(Earning::class, 'user_id', 'id');

    }

    /*
     * Education Related
     * */

    public function courses()

    {

        return $this->hasMany(Course::class, 'user_id', 'id');

    }

    public function allCourses()

    {

        return self::where('user_id', $this->id)->orWhere('shared', 'LIKE', '%' . $this->id . '%');

    }

    public function courseMaterials()

    {

        return $this->hasMany(CourseMaterial::class, 'user_id', 'id');

    }

    public function allCourseMaterials()

    {

        return self::where('user_id', $this->id)->orWhere('shared', 'LIKE', '%' . $this->id . '%');

    }
}
