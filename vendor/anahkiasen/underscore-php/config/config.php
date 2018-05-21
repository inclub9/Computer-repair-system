<?php

return [
    /**
     * When set to false, activitylog will not
     * save any activities to the database.
     */
    'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),

    /**
     * Running the clean-command will delete all activities
     * older than the number of days specified here.
     */
    'delete_records_older_than_days' => 365,


    /**
     * When not specifying a log name when logging activity
     * we'll using this log name.
     */
    'default_log_name' => 'default',


    /**
     * When set to true, the subject returns soft deleted models.
     */
    'subject_returns_soft_deleted_models' => false,


    /**
     * The model used to log the activities.
     * It should be or extend the Spatie\Activitylog\Models\Activity model.
     */
    'activity_model' => \Spatie\Activitylog\Models\Activity::class,

    // The alias Underscore will be mapped to
    'alias' => 'Underscore',

    // Various aliases for methods, you can specify your own
    'aliases' => [
        'contains' => 'find',
        'getLast' => 'last',
        'select' => 'filter',
        'sortBy' => 'sort',
        'name' => 'original name',
        'text' => 'Lorum',
    ],
    'old' => [
        'name' => 'updated name',
        'text' => 'Lorum',
    ],

];
