<?php

namespace Nickolaich\NovaPortfolio\Nova\Fields;

use Laravel\Nova\Fields\Text;

class LandingSectionFields
{
    /**
     * Get the pivot fields for the relationship.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            Text::make('Position')->sortable(),
            Text::make('Header')->hideFromIndex()
        ];
    }
}