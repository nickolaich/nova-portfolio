<?php

namespace Nickolaich\NovaPortfolio\Nova\Resources;


use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource as NovaResource;
use Nickolaich\NovaPortfolio\Models\PortfolioModel;

class PortfolioResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = PortfolioModel::class;

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
        'id', 'name',
    ];

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

            Text::make(trans('nova-portfolio::messages.forms.portfolio_name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(trans('nova-portfolio::messages.forms.portfolio_label'), 'label')
                ->sortable()
                ->rules('required', 'max:255', 'unique:portfolios,label,{{resourceId}}')->resolveUsing(function ($slug) {
                    return str_slug($slug);
                }),

            BelongsTo::make('Slider Collection', 'sliderCollection', CollectionResource::class),
            BelongsTo::make('Main Collection', 'mainCollection', CollectionResource::class),
            BelongsToMany::make('Media', 'media', MediaResource::class),
            HasMany::make('Services', 'services', ServiceResource::class),
            HasMany::make('Testimonials', 'testimonials', TestimonialResource::class),

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
        return [];
    }

    public static function label() {
        return trans('nova-portfolio::messages.resources.portfolio_label');
    }

}
