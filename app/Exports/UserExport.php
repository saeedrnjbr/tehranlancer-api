<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromArray, WithHeadings
{

    public $searchQuery;

    public function __construct($request)
    {
        $this->searchQuery = $request;
    }

    public function array(): array
    {

        $rows = User::orderByDesc("created_at")->get();

        $items = [];

        if (! empty($rows)) {

            foreach ($rows as $row) {

                array_push($items, [
                    "mobile"     => $row->mobile,
                    "user_type"  => __("pages." . $row->user_type),
                    "created_at" => $row->created_at,
                ]);

            }

        }

        return $items;
    }

    public function headings(): array
    {
        $headings = [
            "mobile",
            "user_type",
            "created_at",
        ];

        foreach ($headings as $h => $heading) {
            $headings[$h] = __("pages." . $heading);
        }

        return $headings;
    }
}
