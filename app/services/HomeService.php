<?php

namespace App\Services;

use App\Models\HomeModel;

class HomeService
{
    private HomeModel $model;

    public function __construct()
    {
        $this->model = new HomeModel();
    }

    public function getHomePageData(): array
    {
        $siteInfo = $this->model->getSiteInfo();

        return [
            'pageTitle' => $siteInfo['title'],
            'siteInfo' => $siteInfo
        ];
    }
}
