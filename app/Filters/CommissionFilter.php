<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CommissionFilter
{
    protected $request;

    /**
     * Create a new class instance.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply filters to the query.
     */
    public function apply(Builder $query): Builder
    {
        return $query
            ->when($this->request->input('house'), function ($q, $houseId) {
                $q->where('dd_house_id', $houseId);
            })
            ->when($this->request->input('for'), function ($q, $for) {
                $q->where('for', $for);
            })
            ->when($this->request->input('type'), function ($q, $type) {
                $q->where('type', $type);
            })
            ->when($this->request->input('month'), function ($q, $month) {
                $q->where('month', $month);
            })
            ->when($this->request->input('receive_date'), function ($q, $receiveDate) {
                $q->where('receive_date', $receiveDate);
            });
    }
}
