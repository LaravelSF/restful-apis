<?php namespace App\Api\V1;

use App\Account;
use App\Http\Controllers\Controller;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;

use App\Http\Requests;

class AccountController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Account::with('users', 'owner', 'subscriptions')->get();
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
        $payload = $request->only('name', 'description', 'account_owner_user_id');

        $validator = app('validator')->make($payload, (new Account())->rulesets['creating']);

        if ($validator->fails())
        {
            throw new StoreResourceFailedException('Could not create new account.', $validator->errors());
        }

        return (new Account($payload))->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Account::findOrFail($id);
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
        $payload = $request->only('name', 'description', 'account_owner_user_id');

        $validator = app('validator')->make($payload, (new Account())->rulesets['updating']);

        if ($validator->fails())
        {
            throw new StoreResourceFailedException('Could not create new account.', $validator->errors());
        }

        $user = $this->show($id);

        $user->username = $payload['username'];
        $user->password = $payload['password'];
        $user->email    = $payload['email'];

        return $user->save();
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
