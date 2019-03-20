<?php

namespace Nickolaich\NovaPortfolio\Nova\Invokables;
use Illuminate\Http\Request;
use Finfo;
use Illuminate\Support\Facades\Storage;

class StoreMedia
{
    protected $prefix = '';

    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }

    public function __invoke(Request $request, $model)
    {
        $pref = $this->prefix;
        $p = $request->{$pref};
        $disk = config('nova-portfolio.media_disk');
        $finfo = new Finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($p);
        return [
            $pref => $nameInStorage = $p->store('/', $disk),
            $pref . '_file_name_original' => $p->getClientOriginalName(),
            $pref . '_size' => $p->getSize(),
            $pref . '_disk' => $disk,
            $pref . '_mime_type' => $mimeType,
            $pref . '_remote_url' => Storage::disk($disk)->url($nameInStorage),
        ];
    }
}