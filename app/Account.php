<?php

namespace App;

use Esensi\Model\SoftModel;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'account_owner_user_id',
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
        'name'                  => ['required', 'alpha'],
        'description'           => ['required'],
        'account_owner_user_id' => ['required'],
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
            'name'                  => ['required', 'alpha'],
            'description'           => ['required'],
            'account_owner_user_id' => ['required'],
        ],

        'updating' => [
            'name'                  => ['required', 'alpha'],
            'description'           => ['required'],
            'account_owner_user_id' => ['required'],
        ],
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription', 'subscriber_user_id');
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'account_owner_user_id');
    }
}
