<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // поля таблицы USERS
    protected $fillable = [
        'email',
        'username',
        'password',
        'first_name',
        'last_name',
        'location',
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
    ];

    //мой пользовательский метод
    public function getName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }
        if ($this->first_name) {
            return "{$this->first_name} ";
        }
        return null;
    }
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }
    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower((trim($this->email)))) . "?d=mp&s=40";
    }
    //устанавливаем внешний ключ ?
    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }
    public function friendOf()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }
    //
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }
    public function friendsRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }
    #запрос на ожидание друга
    public function friendsRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }
    #есть ли запрос на добавление в друзя
    public function hasfriendsRequestsPending(User $user)
    {
        return (bool) $this->friendsRequestsPending()->where('id', $user->id)->count();
    }

    #получил запрос дружбы
    public function hasFriendsRequestReceived(User $user)
    {
        return (bool) $this->friendsRequests()->where('id', $user->id)->count();
    }

    # добавить друга
    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    # принять запрос на дружбу
    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot()->update([
            'accepted' => true
        ]);
    }

    # пользователь уже в друзьях
    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }
}
