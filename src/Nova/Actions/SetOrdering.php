<?php

namespace Nickolaich\NovaPortfolio\Nova\Actions;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;

use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Nickolaich\NovaPortfolio\Models\CollectionModel;
use Nickolaich\NovaPortfolio\Nova\Resources\CollectionResource;

class SetOrdering extends Action
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
        $pos = $fields->start_position;

        foreach ($models as $model) {
            //$model->pivot->position = $pos++;
            //$model->pivot->save();
            $collectionId = $model->pivot->collection_id;
            $model->collection()->updateExistingPivot($collectionId, ['position' => $pos++], false);
            //dd($model->pivot);
            //$model->collection()->attach($fields->start_position);
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
            Number::make('Start position', 'start_position'),
            //Text::make('Amount')->withMeta(['type' => 'hidden', 'value'=> 100])->onlyOnForms()
        ];
    }
}