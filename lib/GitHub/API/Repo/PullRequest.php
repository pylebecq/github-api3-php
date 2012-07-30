<?php

namespace GitHub\API\Repo;

use GitHub\API\Api;
use GitHub\API\ApiException;
use GitHub\API\AuthenticationException;

/**
 * Repo pull requests
 *
 * @link   http://developer.github.com/v3/pulls/
 * @author Pierre-Yves LEBECQ <pierreyves.lebecq@sensiolabs.com>
 */
class PullRequest extends \GitHub\API\Issue\Issue
{
    /**
     * List all pull requests for repo
     *
     * Authentication Required: false|true
     *
     * @link http://developer.github.com/v3/pulls/#list-pull-requests
     *
     * @param   string  $username         GitHub username
     * @param   string  $repo             Repo name
     * @param   string  $state            State (open|closed)
     * @param   int     $page             Paginated page to get
     * @param   int     $pageSize         Size of paginated page. Max 100
     * @param   string  $format           Response format
     *                                    FORMAT_RAW|FORMAT_TEXT|FORMAT_HTML|FORMAT_FULL
     * @return  array|bool                List of repo issues or FALSE if the request
     *                                    failed
     */
    public function all($username, $repo, $state = 'open', $page = 1, $pageSize = self::DEFAULT_PAGE_SIZE, $format = self::FORMAT_RAW)
    {
        // Merge all params together
        $params   = array_merge(array('state' => $state), $this->buildPageParams($page, $pageSize));

        return $this->processResponse(
            $this->requestGet("repos/$username/$repo/pulls", $params)
        );
    }

    /**
     * Get a pull request
     *
     * Authentication Required: false|true
     *
     * @link http://developer.github.com/v3/pulls/#get-a-single-pull-request
     *
     * @param   string  $username         User GitHub username
     * @param   string  $repo             Repo name
     * @param   int     $id               ID of the PR
     * @param   string  $format           Response format
     *                                    FORMAT_RAW|FORMAT_TEXT|FORMAT_HTML|FORMAT_FULL
     * @return  array|bool                Details of the issue or FALSE if the request failed
     */
    public function get($username, $repo, $id, $format = self::FORMAT_RAW)
    {
        $options = $this->setResponseFormatOptions($format, self::MIME_TYPE_RESOURCE, array());

        return $this->processResponse(
            $this->requestGet("repos/$username/$repo/pulls/$id", array(), $options)
        );
    }
}
