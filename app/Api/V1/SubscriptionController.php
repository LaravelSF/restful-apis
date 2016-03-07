<?php namespace App\Api\V1;

use App\Http\Controllers\Controller;
use App\Subscription;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;

use App\Http\Requests;

class SubscriptionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Subscription::with('channel', 'subscriber', 'account')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws StoreResourceFailedException
     */
    public function store(Request $request)
    {
        $payload = $request->only(
            'name',
            'description',
            'start_date',
            'end_date',
            'account_id',
            'subscriber_user_id',
            'channel_id'
        );

        $validator = app('validator')->make($payload, (new Subscription())->rulesets['creating']);

        if ($validator->fails())
        {
            throw new StoreResourceFailedException('Could not create new subscription.', $validator->errors());
        }

        return (new Subscription($payload))->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Subscription::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $payload = $request->only('username', 'password', 'email');

        $validator = app('validator')->make($payload, (new Subscription())->rulesets['updating']);

        if ($validator->fails())
        {
            throw new StoreResourceFailedException('Could not create new subscription.', $validator->errors());
        }

        $subscription = $this->show($id);

        $subscription->name               = $payload['name'];
        $subscription->description        = $payload['description'];
        $subscription->start_date         = $payload['start_date'];
        $subscription->end_date           = $payload['end_date'];
        $subscription->account_id         = $payload['account_id'];
        $subscription->subscriber_user_id = $payload['subscriber_user_id'];
        $subscription->channel_id         = $payload['channel_id'];

        return $subscription->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->show($id)->delete();
    }
}
