<?php

namespace App\Scoping;

use Illuminate\Http\Request;
use App\Scoping\Contracts\Scope;

class Scoper
{
    protected $request;

    /**
     * Scoper constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply Scopes by the request for model
     * @param $builder
     * @param $scopes
     * @return mixed
     */
    public function apply($builder, $scopes)
    {
        foreach ($this->limitScopesByRequest($scopes) as $key => $scope){

           if (! $scope instanceof Scope) continue;

            $builder = $scope->apply($builder, $this->request->get($key));
        }

        return $builder;
    }

    /**
     * Fetch only matches scopes with request
     * @param array $scopes
     * @return mixed
     */
    protected function limitScopesByRequest(array $scopes)
    {
        return \Arr::only($scopes, $this->request->keys());
    }
}
