<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscribers';

    protected $fillable = ['email','status'];

    protected $hidden = ['created_at','updated_at'];

    /**
     * Define Relationship
     * /
     *
     * /*
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Custom functions

    public function isASubscriber($email)
    {
        try
        {
            return Subscriber::where('email', $email)
                ->firstOrFail();

        } catch (\Exception $ex)
        {
            return false;
        }

    }

    /**
     * @param $userData
     * @return bool
     */
    public function subscribeUser($email)
    {
        $subscriber = new Subscriber();
        $subscriber->email = $email;
        $subscriber->status = 'Subscribed';

        $subs = $subscriber->save();

        return $subs;
    }

    /**
     * @param $settings
     * @return mixed
     * @internal param $subscriberList
     */
    public function subscribersList($settings)
    {
        $subscriberModel = new Subscriber();

        $skip = $settings['limit'] * ($settings['page'] - 1);
        $subscriberList['result'] = $subscriberModel
            ->groupBy('email')
            ->take($settings['limit'])
            ->offset($skip)
            ->orderBy('created_at', 'desc')
            ->get();

        $subscriberList['count'] = $subscriberModel->get()->count();
        return $subscriberList;
    }

    public function allSubscribers()
    {
        $subscriberModel = new Subscriber();
        return $subscriberModel->all(['email']);
    }


}
