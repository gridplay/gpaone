<?php
namespace GPAONE;
use SocialiteProviders\Manager\SocialiteWasCalled;
class GPAOneExtendSocialite {
    public function handle(SocialiteWasCalled $socialiteWasCalled): void {
        $socialiteWasCalled->extendSocialite('gpaone', Provider::class);
    }
}
