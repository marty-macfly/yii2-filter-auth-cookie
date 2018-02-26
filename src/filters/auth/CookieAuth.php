<?php
namespace  macfly\yii\filters\auth;

use Yii;
use yii\filters\auth\AuthMethod;

/**
 * CookieAuth is an action filter that supports the cookie authentication method.
 *
 * You may use CookieAuth by attaching it as a behavior to a controller or module, like the following:
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *         'cookieAuth' => [
 *             'class' => \macfly\yii\filters\auth\CookieAuth::className(),
 *         ],
 *     ];
 * }
 * ```
 *
 * The default implementation of CookieAuth uses the [[\yii\web\User::loginByAccessToken()|loginByAccessToken()]]
 * method of the `user` application component.
 *
 * @author Charles Delfly <charles@delfly.fr>
 */
class CookieAuth extends AuthMethod
{
    /**
     * @var string the Cookie name
     */
    public $cookieName = 'x-sso-token';

    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        if ($request->cookies->has($this->cookieName)) {
            $accessToken = $request->cookies->getValue($this->cookieName);
            Yii::debug(sprintf("Cookie %s found value: %s", $this->cookieName, $accessToken));

            if (is_string($accessToken)) {
                $identity = $user->loginByAccessToken($accessToken, get_class($this));
                if ($identity !== null) {
                    return $identity;
                } else {
                    Yii::info(sprintf("Token found in cookie %s with value %s is not valid", $this->cookieName, $accessToken));
                }
            }

            if ($accessToken !== null) {
                $this->handleFailure($response);
            }
        } else {
            Yii::debug(sprintf("No cookie named %s found", $this->cookieName));
        }

        return null;
    }
}
