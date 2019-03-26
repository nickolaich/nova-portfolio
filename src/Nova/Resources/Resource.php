<?php

namespace Nickolaich\NovaPortfolio\Nova\Resources;

use Laravel\Nova\Resource as NovaResource;
use Laravel\Nova\Http\Requests\NovaRequest;

abstract class Resource extends NovaResource
{

    /**
    * Default ordering for index query.
    *
    * @var array
    */
   public static $indexDefaultOrder = [
       'id' => 'asc'
   ];

   /**
    * Build an "index" query for the given resource.
    *
    * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public static function indexQuery(NovaRequest $request, $query)
   {
       if (empty($request->get('orderBy')) && is_array(static::$indexDefaultOrder)) {
           $query->getQuery()->orders = [];
           return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
       }
       return $query;
   }

}