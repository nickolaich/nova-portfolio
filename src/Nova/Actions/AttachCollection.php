<?php

namespace Nickolaich\NovaPortfolio\Nova\Actions;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Select;

use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Nickolaich\NovaPortfolio\Models\CollectionModel;
use Nickolaich\NovaPortfolio\Nova\Resources\CollectionResource;

class AttachCollection extends Action
{

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields $fields
     * @param  \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->collection()->attach($fields->collection);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Collection', 'collection', CollectionResource::class)
                ->options(CollectionModel::get()->pluck('name', 'id')),
        ];
    }
}