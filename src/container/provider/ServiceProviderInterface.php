<?php

/**
*   ServiceProviderInterface
*
*   @ver 170210
*   @see https://github.com/ecfectus/container
**/

declare(strict_types=1);

namespace Movement\container\provider;

use Movement\container\ContainerAwareInterface;

interface ServiceProviderInterface extends ContainerAwareInterface
{
    /**
    *   サービス名有無またはサービス名取得
    *
    *   @param string $service
    *   @return bool | array
    *   @example $service == nullの場合、全サービス配列
    **/
    public function provides($service = null);
    
    /**
    *   サービスコンテナ登録
    *
    **/
    public function register();
}
