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
    # получить имя и фамилию или  только имя
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
    # получить имя и фамилию или логин
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }
    # получить имя или логин
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }
    # получить аватарку из граватар
    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower((trim($this->email)))) . "?d=mp&s=40";
    }
    //устанавливаем внешний ключ ?
    # один ко многим у юзера много статусов
    public function statuses(){
        return $this->hasMany('App\Models\Status','user_id');
    }
    # устанавливаем отношение многие ко многим , мои друзья
    public function friendsOfMine()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }
    # устанавливаем отношение многие ко многим , мои друг
    public function friendOf()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }
    # получить друзей
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }
    # запросы в друзья
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }
    # запрос на ожидание друга
    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    # есть запрос на добавление в друзья
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    # получил запрос о дружбе
    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    # добавить друга
    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }
    # удалить из друзей
    public function DeleteFriend(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    # принять запрос на дружбу
    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }

    # пользователь уже в друзьях
    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    # получить лайки пользователя
    public function likes()
    {
            return $this->hasMany('App\Models\Like', 'user_id');
    }
    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->likes
          ->where('user_id', $this->id)
          ->count();
    }
}
