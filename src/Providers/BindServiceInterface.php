<?php
namespace Amy\Numbersequence\Providers;
use Illuminate\Support\ServiceProvider;
use Amy\Numbersequence\Services\Interfaces\NumberSequenceInterfaces;
use Amy\Numbersequence\Services\NumberSequenceService;

class BindServiceInterface  extends ServiceProvider{
    public function register(){
        $this->app->bind(NumberSequenceInterfaces::class,NumberSequenceService::class);
    }
}
