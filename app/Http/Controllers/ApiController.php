<?php

namespace App\Http\Controllers;

use App\planet;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    /**
     * All planets associated with a given user
     *
     * @param Request $request
     * @return mixed
     */
    public function planets(Request $request){
        return $request->user()->planets()->get();
    }

    /**
     * All facility buildings associated with a given planet
     *
     * @param planet $planet Planet Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facilities(Planet $planet){
        return $planet->facilitiesBuildings();
    }

    /**
     * All resources buildings associated with a given planet
     *
     * @param planet $planet Planet Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resources(Planet $planet){
        return $planet->resourcesBuildings();
    }

    /**
     * All planetary defense buildings associated with a given planet
     *
     * @param planet $planet Planet Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planetaryDefenses(Planet $planet){
        return $planet->planetaryDefensesBuildings();
    }

    /**
     * All research buildings associated with a given planet
     *
     * @param planet $planet Planet Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function research(Planet $planet){
        return $planet->researchBuildings();
    }

    /**
     * All shipyard buildings associated with a given planet
     *
     * @param planet $planet Planet Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shipyard(Planet $planet){
        return $planet->shipyardBuildings();
    }
}
