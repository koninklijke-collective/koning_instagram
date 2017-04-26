<?php
namespace KoninklijkeCollective\KoningInstagram\Service;

/**
 * Service: Instagram
 *
 * @package KoninklijkeCollective\KoningInstagram\Service
 */
class InstagramService
{
    const BASE_URL = 'https://api.instagram.com/oembed/';
    const CACHE_KEY = 'koning_instagram_embedcode';

    /**
     * @var \TYPO3\CMS\Core\Cache\CacheManager
     * @inject
     */
    protected $cacheManager;

    /**
     * @param array $params
     * @return string
     */
    public function getEmbedCode(array $params)
    {
        $code = '';

        $query = [
            'url' => $params['url'],
            'maxwidth' => (int)$params['max_width'],
            'hidecaption' => (bool)$params['hide_caption'] ? 'true' : 'false',
            'omitscript' => (bool)$params['omit_script'] ? 'true' : 'false',
        ];

        if (isset($params['json_callback']) && strlen($params['json_callback']) > 0) {
            $query['callback'] = $params['json_callback'];
        }

        $url = self::BASE_URL . '?' . http_build_query($query);
        $cacheIdentifier = md5($url);

        $rawPostInfo = $this->cacheManager->getCache(self::CACHE_KEY)->get($cacheIdentifier);
        if ($rawPostInfo === false) {
            $response = \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($url);

            if ($response !== false) {
                $this->cacheManager->getCache(self::CACHE_KEY)->set($cacheIdentifier, $response);
                $rawPostInfo = $response;
            }
        }

        if ($rawPostInfo !== false) {
            $postInfo = json_decode($rawPostInfo, true);
            if (isset($postInfo['html'])) {
                $code = $postInfo['html'];
            }
        }

        return $code;
    }
}
