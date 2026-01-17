<?php

return [

    'examresult' => [

        /* =================================================
           EVALUATION RESULT PUBLISHED
           → source: examresult_evaluation_results
        ================================================= */
        'evaluation_result_published' => [

            'source_table' => 'examresult_evaluation_results',

            /* =========================
             | PREVIEW DATA (DB aligned)
             |=========================*/
            'preview' => [
                'entity_name'   => 'Ravi Sharma',   // Student / User / Employee
                'evaluation_id' => 101,

                // nullable → overall result if null
                'component'     => 'Mathematics',

                'score'         => '78.50',
                'max_score'     => '100.00',

                'grade'         => 'A',
                'result_status' => 'pass', // pass | fail | absent | evaluated

                'result_link'   => 'https://example.com/results/101',
            ],

            /* =========================
             | EMAIL
             |=========================*/
            'email' => [
                'subject' => 'Evaluation Result Published',
                'view'    => 'shared::emails.examresult.evaluation-result-published',
            ],
        ],

    ],

];
