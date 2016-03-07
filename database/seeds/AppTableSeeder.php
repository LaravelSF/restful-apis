<?php

use App\Account;
use App\Channel;
use Illuminate\Database\Seeder;


class AppTableSeeder extends Seeder {

    public $channels = [
        [
            'name' => 'Europe Weather 16:9',
            'description' => 'All the weather for California!',
            'url' => 'https://www.contboxx.com/htmlout/?cucode=87aae183bebb&booking_id=34233460'
        ],
        [
            'name' => 'Boulevard 16:9',
            'description' => 'The latest world news highlights!',
            'url' => 'https://www.contboxx.com/htmlout/?cucode=87aae183bebb&booking_id=24234498'
        ],
        [
            'name' => 'Germany All news',
            'description' => 'All the news from Germany!',
            'url' => 'https://www.contboxx.com/htmlout/?cucode=87aae183bebb&booking_id=24234493'
        ],
        [
            'name' => 'Germany Brennpunkte 16:9',
            'description' => 'Germany highlights!',
            'url' => 'https://www.contboxx.com/htmlout/?cucode=87aae183bebb&booking_id=24234545'
        ],
        [
            'name' => 'Horoskop 16:9',
            'description' => 'German Horoscope',
            'url' => 'https://www.contboxx.com/htmlout/?cucode=87aae183bebb&booking_id=24234794'
        ]
    ];

    public function run()
    {

        $this->createChannels();

        factory(App\User::class, 50)->make()->each(function ($user)
        {
            $user->save();

            if (DB::table('accounts')->count() < 5)
            {
                $account                        = factory(App\Account::class)->make();
                $account->account_owner_user_id = $user->id;
                $account->save();
                $accountId = $account->id;
                $user->accounts()->attach([$account->id]);
            }
            else
            {
                $accountId = array_rand(DB::table('accounts')->pluck('id'));
                //$user->accounts()->sync([$accountId]);
            }

            for ($i = 1, $rand = intval(rand(10, 50)); $i < $rand; $i++)
            {
                $subscription                     = $user->subscriptions()->save(
                    factory(App\Subscription::class)->make()
                );
                $subscription->account_id         = $accountId;
                $subscription->subscriber_user_id = $user->id;
                $subscription->channel_id         = array_rand(DB::table('channels')->pluck('id'));

                $subscription->save();
            }
        });
    }

    public function createChannels()
    {
        foreach ($this->channels as $default)
        {
            $channel              = new Channel();
            $channel->name        = $default['name'];
            $channel->description = $default['description'];
            $channel->url         = $default['url'];
            $channel->save();
        }
    }
}
