<?php
namespace GPa;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
class GPaServiceProvider extends ServiceProvider {
	protected $defer = false;
    public function register() {
    }
    public function provides() {
        return ['gpa'];
    }
    public function boot() {
        //
    }
    protected function packagePath($path = '') {
        return sprintf('%s/../%s', __DIR__, $path);
    }
}