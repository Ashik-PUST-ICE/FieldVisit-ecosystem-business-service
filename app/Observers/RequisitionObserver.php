<?php

namespace App\Observers;

use App\Enums\Commons\RequisitionStatus\RequisitionStatusEnum;
use App\Models\Requisition;

class RequisitionObserver
{
    /**
     * Handle the Requisition "updating" event.
     */
    public function updating(Requisition $requisition): void
    {

        if ($requisition->isDirty('status') &&
            $requisition->status === RequisitionStatusEnum::APPROVED &&
            empty($requisition->requisition_code)) {

            $requisition->requisition_code = 'SSR-'.now()->format('ymdHis');
            $requisition->approved_at = now();
        }

    }
}
