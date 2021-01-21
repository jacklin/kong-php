<?php

namespace TheRealGambo\Kong\Apis;

final class Plugin extends AbstractApi implements PluginInterface
{
    /**
     * Array of valid body options
     *
     * @var array
     */
    private $pluginAllowedOptions = ['name', 'consumer_id'];

    /**
     * Add a plugin globally to every API on Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#add-plugin
     *
     * @param array $body
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function add(array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->pluginAllowedOptions);
        $body = $this->createRequestBody($body);

        return $this->postRequest('plugins', $body, $headers);
    }

    /**
     * Remove a plugin from an API
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#delete-plugin
     *
     * @param string $api_identifier
     * @param string $identifier
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function delete($uri, $identifier, array $headers = [])
    {
        return $this->deleteRequest($uri . 'plugins/' . $identifier, $headers);
    }

    /**
     * Retrieve information about a specific plugin from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#retrieve-plugin
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function get($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('plugins/' . $identifier, $params, $headers);
    }

    /**
     * Retrieve all available plugins from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#retrieve-enabled-plugins
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function getEnabledPlugins(array $params = [], array $headers = [])
    {
        return $this->getRequest('plugins/enabled', $params, $headers);
    }

    /**
     * Retrieve the schema for a specific plugin from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#retrieve-plugin-schema
     *
     * @param string $identifier
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function getPluginSchema($identifier, array $params = [], array $headers = [])
    {
        return $this->getRequest('plugins/schema/' . $identifier, [], $headers);
    }

    /**
     * Retrieve all plugins configured from Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#list-all-plugins
     *
     * @param array $params
     * @param array $headers
     *
     * @return array|\stdClass
     */
    public function list(array $params = [], array $headers = [])
    {
        return $this->getRequest('plugins', $params, $headers);
    }
    /**
     * new list 2.2.x 
     *
     * @see  https://docs.konghq.com/2.2.x/admin-api/#list-routes
     * 
     * BaZhang Platform
     * @Author   Jacklin@shouyiren.net
     * @DateTime 2021-01-20T15:53:22+0800
     * @param    string                   $uri     ./services/{service name or id}/ |routes/{route name or id}/ consumers/{consumer name or id}/
     * @param    array                    $params  [description]
     * @param    array                    $headers [description]
     * @return   [type]                            [description]
     */
    public function nlist($uri='', array $params = [], array $headers = [])
    {
        return $this->getRequest($uri.'plugins', $params, $headers);
    }

    /**
     * Update a plugins configuration on Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#update-plugin
     *
     * @param string $uri
     * @param string $identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function update($uri, $identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions($this->pluginAllowedOptions);
        $body = $this->createRequestBody($body);
        return $this->patchRequest($uri . 'plugins/' . $identifier, $body, $headers);
    }

    /**
     * Update or create a plugin on Kong
     *
     * @see https://getkong.org/docs/0.13.x/admin-api/#update-or-add-plugin
     *
     * @param string $api_identifier
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function updateOrAdd($api_identifier, array $body = [], array $headers = [])
    {
        $this->setAllowedOptions(array_merge($this->pluginAllowedOptions, ['id']));
        $body = $this->createRequestBody($body);

        return $this->putRequest('apis/' . $api_identifier . '/plugins', $body, $headers);
    }
}
