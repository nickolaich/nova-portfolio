<?php

namespace Nickolaich\NovaPortfolio\Nova\Resources;

use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Nickolaich\NovaPortfolio\Models\OfferModel;
use Nickolaich\NovaPortfolio\Nova\Actions\AttachPortfolio;
use Nickolaich\NovaPortfolio\Nova\Fields\LandingSectionFields;
use Nickolaich\NovaPortfolio\Nova\Invokables\StoreMedia;
use Nickolaich\NovaPortfolio\Models\ServiceModel;
use Spatie\TagsField\Tags;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource as NovaResource;

class OfferResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = OfferModel::class;

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
        $disk = config('nova-portfolio.media_disk');
        return [
            ID::make()->sortable(),

            Text::make(trans('nova-portfolio::messages.forms.offer_name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Textarea::make(trans('nova-portfolio::messages.forms.offer_overview'), 'overview')->hideFromIndex(),

            Image::make('Image')
                ->disk($disk)
                ->store(new StoreMedia('image', []))
                ->hideFromIndex(),

            Text::make(trans('nova-portfolio::messages.forms.offer_price'), 'price'),

            Boolean::make(trans('nova-portfolio::messages.forms.offer_on_main'), 'on_main'),

            Text::make(trans('nova-portfolio::messages.forms.offer_url'), 'url')->hideFromIndex(),

            Text::make(trans('nova-portfolio::messages.forms.offer_additional_1'), 'additional_1')->hideFromIndex(),

            Text::make(trans('nova-portfolio::messages.forms.offer_additional_2'), 'additional_2')->hideFromIndex(),

            Text::make(trans('nova-portfolio::messages.forms.offer_position'), 'position')->hideFromIndex(),

            Text::make(trans('nova-portfolio::messages.forms.offer_position_on_main'), 'position_on_main')->hideFromIndex(),

            BelongsTo::make('Portfolio', 'portfolio', PortfolioResource::class),
            //BelongsToMany::make('Media', 'media', Media::class)

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
        return trans('nova-portfolio::messages.resources.offer_label');
    }
}
