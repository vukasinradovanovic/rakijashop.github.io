<?php

namespace App\Http\Controllers\Localization;

use Illuminate\Http\Request;

class LocalizationController
{
    /**
     * Build localization payload for shared views.
     */
    public function buildNavigationLocalization(Request $request): array
    {
        $currentLocale = $request->route('locale') ?? app()->getLocale();
        $languageLabels = __('nav.language_labels');
        $segments = $request->segments();
        $queryString = $request->getQueryString();

        $languageSwitches = [];

        foreach ($languageLabels as $localeCode => $localeLabel) {
            $localizedSegments = $segments;
            $localizedSegments[0] = $localeCode;

            $switchUrl = '/' . implode('/', $localizedSegments) . ($queryString ? ('?' . $queryString) : '');

            $languageSwitches[] = [
                'code' => $localeCode,
                'label' => $localeLabel,
                'url' => $switchUrl,
                'is_current' => $currentLocale === $localeCode,
            ];
        }

        return [
            'current_locale' => $currentLocale,
            'language_switches' => $languageSwitches,
        ];
    }
}
