<?php

namespace App\Http\Controllers;

use App\Models\Unity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class UnityController
 * @package App\Http\Controllers
 */
class UnityController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return view('unities.index', [

        ]);
    }

    public function list(Request $request)
    {
        /**
         * @param Builder $query
         * @param string $column
         * @param $value
         */
        $like = function (Builder $query, string $column, $value) {
            $query->orWhere($column, 'like', "%${value}%");
        };

        /**
         * @param Builder $query
         * @param string $column
         * @param $value
         */
        $equal = function (Builder $query, string $column, $value) {
            $query->orWhere($column, '=', $value);
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

        $filter = $request->filter ?: null;

        foreach ($filters as $column => $filterQuery) {
            $query->when($filter, function (Builder $query, $value) use ($column, $filterQuery) {
                $filterQuery($query, $column, $value);
            });
        }

        return view('unities.list', [
            'unities' => $query->paginate($request->per_page ?: 10),
            'filter' => $filter
        ]);
    }
}
