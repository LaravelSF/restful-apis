<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'account_id',
        'subscriber_user_id',
        'channel_id',
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
        'name'               => ['required', 'alpha'],
        'description'        => ['required'],
        'start_date'         => ['required', 'date'],
        'end_date'           => ['required', 'date'],
        'account_id'         => ['required'],
        'subscriber_user_id' => ['required'],
        'channel_id'         => ['required'],
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
            'name'               => ['required', 'alpha'],
            'description'        => ['required'],
            'start_date'         => ['required', 'date'],
            'end_date'           => ['required', 'date'],
            'account_id'         => ['required'],
            'subscriber_user_id' => ['required'],
            'channel_id'         => ['required'],
        ],

        'updating' => [
            'name'               => ['required', 'alpha'],
            'description'        => ['required'],
            'start_date'         => ['required', 'date'],
            'end_date'           => ['required', 'date'],
            'account_id'         => ['required'],
            'subscriber_user_id' => ['required'],
            'channel_id'         => ['required'],
        ],
    ];

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function subscriber()
    {
        return $this->belongsTo('App\User', 'subscriber_user_id');
    }

    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }
}
