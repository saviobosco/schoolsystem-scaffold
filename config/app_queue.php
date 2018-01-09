<?php
return [
    'Queue' => [
        // seconds to sleep() when no executable job is found
        'sleeptime' => 10,

        // probability in percent of a old job cleanup happening
        'gcprob' => 10,

        // time (in seconds) after which a job is requeued if the worker doesn't report back
        'defaultworkertimeout' => 240,

        // number of retries if a job fails or times out.
        'defaultworkerretries' => 4,

        // seconds of running time after which the worker will terminate (0 = unlimited)
        'workermaxruntime' => 1800,

        // minimum time (in seconds) which a task remains in the database before being cleaned up.
        'cleanuptimeout' => 2000,

        // instruct a Workerprocess quit when there are no more tasks for it to execute (true = exit, false = keep running)
        'exitwhennothingtodo' => true,

        // determine whether logging is enabled
        'log' => true,

        // set to false to disable (tmp = file in TMP dir)
        'notify' => 'tmp',
    ],
];

?>