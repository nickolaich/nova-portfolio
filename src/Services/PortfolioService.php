<?php

namespace Nickolaich\NovaPortfolio\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Nickolaich\NovaPortfolio\Models\CollectionModel;
use Nickolaich\NovaPortfolio\Models\PortfolioModel;

class PortfolioService extends BaseService
{

    /**
     * Get portfolio details
     * @param $id
     * @return PortfolioModel|null
     */
    public function findPortfolio($id): ?PortfolioModel
    {
        return PortfolioModel::find($id);
    }

    /**
     * Find collection
     * @param $id
     * @return PortfolioModel|null
     */
    public function findCollection($id): ?CollectionModel
    {
        return CollectionModel::find($id);
    }


    /**
     * Get services of portfolio
     * @param $id
     * @return Collection
     */
    public function getServices($id): Collection
    {
        $p = $this->findPortfolio($id);
        return $p ? $p->services : new Collection();
    }

    /**
     * Get testimonials of portfolio
     * @param $id
     * @return Collection
     */
    public function getTestimonials($id): Collection
    {
        $p = $this->findPortfolio($id);
        return $p ? $p->testimonials : new Collection();
    }

    /**
     * Get media of collection
     * @param $id
     * @return Collection
     */
    public function getCollectionMedia($id): Collection
    {
        $c = $this->findCollection($id);
        return ($c ? $this->updateRemoteUrls($c->media) : new Collection())->map(function ($media) {
            if (strpos($media->full_url, 'youtube') || strpos($media->full_url, 'vimeo')) {
                $media->type = 'video';
            } else {
                $media->type = 'photo';
            }
            return $media;
        });
    }

    /**
     * @param $list
     * @return mixed
     */
    public function updateRemoteUrls($list)
    {
        foreach ($list as $m) {
            $update = false;
            if (!$m->full_remote_url) {
                if ($m->full_url) {
                    $m->full_remote_url = $m->full_url;
                } elseif ($m->full) {
                    $m->full_remote_url = Storage::disk(config('nova-portfolio.media_disk'))->url($m->full);
                }
                if ($m->full_remote_url) {
                    $update = true;
                }
            }
            if ($m->preview && !$m->preview_remote_url) {
                $m->preview_remote_url = Storage::disk(config('nova-portfolio.media_disk'))->url($m->preview);
                $update = true;
            }
            if ($update) {
                $m->save();
            }

        }
        return $list;
    }

}