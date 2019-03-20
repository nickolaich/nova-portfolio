<?php

namespace Nickolaich\NovaPortfolio\Nova\Resources;

use Laravel\Nova\Fields\BelongsToMany;
use Nickolaich\NovaPortfolio\Nova\Actions\AttachCollection;
use Nickolaich\NovaPortfolio\Nova\Actions\AttachPortfolio;
use Nickolaich\NovaPortfolio\Nova\Fields\LandingMediaFields;
use Nickolaich\NovaPortfolio\Nova\Invokables\StoreMedia;
use Nickolaich\NovaPortfolio\Models\MediaModel;
use Spatie\TagsField\Tags;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource as NovaResource;

class MediaResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = MediaModel::class;

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
        'id', 'name'
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
        $disk = config('nova-portfolio.media_disk');
        return [
            ID::make()->sortable(),

            Text::make(trans('nova-portfolio::messages.forms.media_name'), 'name')
                ->sortable()
                ->rules('max:255'),

            Image::make('Preview')
                ->disk($disk)
                ->store(new StoreMedia('preview'))
                ->hideFromIndex(),

            Text::make('Full Url', 'full_url')
                ->hideFromIndex(),
            Image::make('Full')
                ->disk($disk)
                ->store(new StoreMedia('full'))
                ->hideFromIndex(),

            Tags::make('Tags'),//->type('my-special-type'),

            BelongsToMany::make('Portfolio', 'portfolio', PortfolioResource::class),

            BelongsToMany::make('Collection', 'collection', CollectionResource::class),

            BelongsToMany::make('Landing', 'landing', LandingResource::class)->fields(new LandingMediaFields())

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
            new AttachPortfolio(),
            new AttachCollection(),
        ];
    }

    public static function label() {
        return trans('nova-portfolio::messages.resources.media_label');
    }

}
