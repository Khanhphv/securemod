<?php


namespace App\Service;


use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use PragmaRX\Countries\Package\Countries;

class CountryStateService
{
    public $countries;

    public function __construct()
    {
        $this->countries = new Countries();
    }

    public function getAllCountry(): array
    {
        $allCountry = $this->countries->all()
            ->map(function ($country) {
                $commonName = $country->name->common;

                $languages = $country->languages ?? collect();

                $language = $languages->keys()->first() ?? null;

                $nativeNames = $country->name->native ?? null;

                if (
                    filled($language) &&
                    filled($nativeNames) &&
                    filled($nativeNames[$language]) ?? null
                ) {
                    $native = $nativeNames[$language]['common'] ?? null;
                }

                if (blank($native ?? null) && filled($nativeNames)) {
                    $native = $nativeNames->first()['common'] ?? null;
                }

                $native = $native ?? $commonName;

                if ($native !== $commonName && filled($native)) {
                    $native = "$native";
                }

                return ["key" =>$country->cca2, "value" => $commonName ];
            })
            ->values()
            ->toArray();

        return $allCountry;
    }

    public function getStateByCountry(string $name)
    {
        $stateList = [];
        $data = $this->countries->where('name.common', $name)
            ->first()
            ->hydrateStates()
            ->states
            ->sortBy('name_en');
        foreach ($data as $item) {
            $stateList[] = ["key" => $item['iso_3166_2'] , "value" => $item['alt_names'][0]];

        }

        return $stateList;
    }
}
