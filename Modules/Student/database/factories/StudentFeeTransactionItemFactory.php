<?php
namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Student\Models\StudentFee;
use Modules\Student\Models\StudentFeeTransactionItem;
use Modules\Student\Models\StudentFeeTransaction;

class StudentFeeTransactionItemFactory extends Factory
{
    protected $model = StudentFeeTransactionItem::class;

    public function definition()
    {
        $transactionIds = \Modules\Student\Models\StudentFeeTransaction::pluck('id')->toArray();
        $studentFeeIds  = \Modules\Student\Models\StudentFee::pluck('id')->toArray();

        return [
            'transaction_id' => $this->faker->randomElement($transactionIds),
            'student_fee_id' => $this->faker->randomElement($studentFeeIds),
            'amount_paid'    => $this->faker->numberBetween(100, 5000),
        ];
    }
}
