<?php

namespace App\Http\Controllers;

use App\Models\Unity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class UnityApiController
 * @package App\Http\Controllers
 */
class UnityApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function __invoke(Request $request)
    {
        /**
         * @param Builder $query
         * @param string $column
         * @param $value
         */
        $like = function (Builder $query, string $column, $value) {
            $query->where($column, 'like', "%${value}%");
        };

        /**
         * @param Builder $query
         * @param string $column
         * @param $value
         */
        $equal = function (Builder $query, string $column, $value) {
            $query->where($column, '=', $value);
        };

        $filters = [
            'code' => $like,
            'distributor_name' => $like,
            'owner' => $like,
            'project_class' => $like,
            'sub_group' => $like,
            'modality' => $like,
            'credit_receivers' => $like,
            'city' => $like,
            'state' => $like,
            'postal_code' => $like,
            'connection_date' => $equal,
            'project_type' => $like,
            'source' => $like,
            'power' => $equal,
        ];

        /** @var Builder $query */
        $query = Unity::query();

        foreach ($filters as $column => $filter) {
            $query->when($request[$column], function (Builder $query, $value) use ($column, $filter) {
                $filter($query, $column, $value);
            });
        }

        return $query->paginate($request->per_page ?: 10);
    }
}
