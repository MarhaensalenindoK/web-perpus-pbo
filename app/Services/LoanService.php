<?php

namespace App\Services;

use App\Models\Loan;

class LoanService
{
    public function getLoans()
    {
        return Loan::all();
    }

    public function getLoanById($id)
    {
        return Loan::find($id);
    }

    public function createLoan(Loan $loan)
    {
        return $loan->save();
    }

    public function updateLoan(Loan $loan)
    {
        return $loan->save();
    }

    public function deleteLoan($id)
    {
        return Loan::destroy($id);
    }
}