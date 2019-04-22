<?php

namespace Nickolaich\NovaPortfolio\Nova\Invokables;
use Illuminate\Http\Request;
use Finfo;
use Illuminate\Support\Facades\Storage;

class StoreMedia
{
    protected $prefix = '';
    protected $opts = [];

    public function __construct($prefix, $opts = [])
    {
        $this->prefix = $prefix;
        $this->opts = $opts;
    }

    public function __invoke(Request $request, $model)
    {
        $pref = $this->prefix;
        $p = $request->{$pref};
        $disk = config('nova-portfolio.media_disk');
        $finfo = new Finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($p);
        $data = [];
        $data[$pref] = $nameInStorage = $p->store('/', $disk);
        $withExtra = array_key_exists('with_extra', $this->opts) ? $this->opts['with_extra'] : true;
        if ($withExtra) {
            $extra = [
                $pref . '_file_name_original' => $p->getClientOriginalName(),
                $pref . '_size' => $p->getSize(),
                $pref . '_disk' => $disk,
                $pref . '_mime_type' => $mimeType,
                $pref . '_remote_url' => Storage::disk($disk)->url($nameInStorage),
            ];
        } else {
            $extra = [];
        }
        return array_merge($data, $extra);
    }
}