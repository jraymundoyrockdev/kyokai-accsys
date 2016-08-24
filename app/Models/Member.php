<?php

namespace ApiGfccm\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'apellation',
        'firstname',
        'lastname',
        'middlename',
        'gender',
        'birthdate',
        'address',
        'phone_mobile',
        'email'
    ];

    protected $appends = ['full_name', 'full_name_with_apellation'];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucwords($this->attributes['firstname']) . ' ' . ucwords($this->attributes['lastname']);
    }

    /**
     * @return string
     */
    public function getFullNameWithApellationAttribute()
    {
        $apellation = (!empty($this->attributes['apellation']) ? $this->attributes['apellation'] : '');

        return $this->getFullNameAttribute() . ' (' . ucwords($apellation) . ')';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function member_ministry()
    {
        return $this->hasMany(MemberMinistry::class, 'member_id', 'id');
    }
}
