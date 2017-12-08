# yii2-filter-auth-cookie

CookieAuth is an action filter that supports the cookie based authentication method.

 You may use CookieAuth by attaching it as a behavior to a controller or module, like the following:

 ```php
 public function behaviors()
 {
   return [
       'cookieAuth' => [
             'class' => \macfly\yii\webserver\auth\CookieAuth::className(),
         ],
     ];
}
```

The default implementation of CookieAuth uses the [[\yii\web\User::loginByAccessToken()|loginByAccessToken()]] method of the `user` application component.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist "macfly/yii2-filter-auth-cookie" "*"
```

or add

```
"macfly/yii2-filter-auth-cookie": "*"
```

to the require section of your `composer.json` file.
