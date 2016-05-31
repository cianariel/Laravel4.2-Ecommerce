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

    protected $fillable = ['email', 'status'];

    protected $hidden = ['created_at', 'updated_at'];

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
        try {
            return Subscriber::where('email', $email)
                             ->firstOrFail();

        } catch (\Exception $ex) {
            return false;
        }

    }

    /**
     * @param $userData
     * @return bool
     */
    public function subscribeUser($data)
    {
        $existingEmail = Subscriber::where('email', $data['Email']);

        if ($existingEmail->count() == 0) {
            $subscriber = new Subscriber();
            $subscriber->email = $data['Email'];
            $subscriber->source = empty($data['Source']) ? '' : $data['Source'];

            $subscriber->status = 'Subscribed';

            $subs = $subscriber->save();

            return $subs;
        } else {
            return $existingEmail->first();
        }
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

    public function totalSubscriberBySource($data)
    {

        if (empty($data['Source'])) {
            $query = new Subscriber();
        } else {
            $query = new Subscriber();
            $query = $query->where('source', $data['Source']);
        }

        $subscriberCount = $query->groupBy('email')
                                 ->orderBy('created_at', 'desc')
                                 ->get()
                                 ->count();
        // dd($subscriberList);
        return $subscriberCount;

    }


    public function allSubscribers()
    {
        $subscriberModel = new Subscriber();

        return $subscriberModel
            ->groupBy('email')
            ->orderBy('email')
            ->get(['email']);

        //return $subscriberModel->all(['email']);
    }


}
