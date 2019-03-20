<?php

namespace Nickolaich\NovaPortfolio\Nova\Resources;

use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasOne;
use Nickolaich\NovaPortfolio\Nova\Actions\AttachPortfolio;
use Nickolaich\NovaPortfolio\Nova\Fields\LandingMediaFields;
use Nickolaich\NovaPortfolio\Nova\Fields\LandingSectionFields;
use Nickolaich\NovaPortfolio\Nova\Invokables\StoreMedia;
use Nickolaich\NovaPortfolio\Models\LandingModel;
use Spatie\TagsField\Tags;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource as NovaResource;

class LandingResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = LandingModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id'
    ];

    public static $displayInNavigation = true;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(trans('nova-portfolio::messages.forms.landing_name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(trans('nova-portfolio::messages.forms.url_slug'), 'url_slug')
                ->sortable()
                ->rules(
                    'max:255',
                    'unique:landings,url_slug,{{resourceId}}'
                ),

            BelongsTo::make('Collection', 'collection', CollectionResource::class),


            //BelongsTo::make('Portfolio', 'portfolio', 'Nickolaich\NovaPortfolio\Nova\Portfolio'),
            BelongsToMany::make('Section', 'section', SectionResource::class)->fields(new LandingSectionFields()),
            BelongsToMany::make('Media', 'media', MediaResource::class)->fields(new LandingMediaFields())

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
        ];
    }

    public static function label() {
        return trans('nova-portfolio::messages.resources.landing_label');
    }

}
