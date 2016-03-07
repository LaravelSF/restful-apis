<?php namespace App\Api\V1;

use App\Channel;
use App\Http\Controllers\Controller;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;

use App\Http\Requests;

class ChannelController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Channel::all();
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
        $payload = app('request')->only('name', 'description', 'url');

        $validator = app('validator')->make($payload, (new Channel())->rulesets['creating']);

        if ($validator->fails())
        {
            throw new StoreResourceFailedException('Could not create new channel.', $validator->errors());
        }

        return (new Channel($payload))->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Channel::findOrFail($id);
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
        $payload = $request->only('name', 'description', 'url');

        $validator = app('validator')->make($payload, (new Channel())->rulesets['updating']);

        if ($validator->fails())
        {
            throw new StoreResourceFailedException('Could not create new channel.', $validator->errors());
        }

        $channel = $this->show($id);

        $channel->name        = $payload['name'];
        $channel->description = $payload['description'];
        $channel->url         = $payload['url'];

        return $channel->save();
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
