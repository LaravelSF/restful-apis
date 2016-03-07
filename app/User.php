<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Esensi\Model\SoftModel;

class User extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * These are the default rules that the model will validate against.
     * Developers will probably want to specify generic validation rules
     * that would apply in any save operation vs. form or route
     * specific validation rules. For simple models, these rules can
     * apply to all save operations.
     *
     * @var array
     */
    protected $rules = [
        'name'     => ['required', 'alpha'],
        'password' => ['required', 'min:7'],
        'email'    => ['required', 'email'],
    ];

    /**
     * These are the rulesets that the model will validate against
     * during specific save operations. Rulesets should be keyed
     * by either the in progress event name of the save operation
     * or a custom unique key for custom validation.
     *
     * The following rulesets are automatically applied during
     * corresponding save operations:
     *
     *     "creating" after "saving" but before save() is called (on new models)
     *     "updating" after "saving" but before save() is called (on existing models)
     *     "saving" before save() is called (and only if no "creating" or "updating")
     *     "deleting" when calling delete() method
     *     "restoring" when calling restore() method (on a soft-deleting model)
     *
     * @var array
     */
    protected $rulesets = [

        'creating' => [
            'name'     => ['required', 'alpha'],
            'password' => ['required', 'min:7'],
            'email'    => ['required', 'email'],
        ],

        'updating' => [
            'name'     => ['required', 'alpha'],
            'password' => ['required', 'min:7'],
            'email'    => ['required', 'email'],
        ],
    ];

    public function accounts()
    {
        return $this->belongsToMany('App\Account')->withTimestamps();
    }

    public function accountsOwned()
    {
        return $this->hasMany('App\Account', 'account_owner_user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription', 'subscriber_user_id');
    }

    public function channels()
    {
        return $this->subscriptions()->with('channel');
    }
}
