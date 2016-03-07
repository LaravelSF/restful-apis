<?php

namespace App;

use Esensi\Model\SoftModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model {

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'url',
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
        'name'        => ['required', 'alpha'],
        'description' => ['required'],
        'url'         => ['required'],
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
            'name'        => ['required', 'alpha'],
            'description' => ['required'],
            'url'         => ['required'],
        ],

        'updating' => [
            'name'        => ['required', 'alpha'],
            'description' => ['required'],
            'url'         => ['required'],
        ],
    ];
}
