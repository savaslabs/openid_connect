<?php

/**
 * @file
 * Hooks provided by the OpenID Connect module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Specify if a new user may be created via OpenID Connect.
 *
 * @param array $userinfo
 *   An array containing user data from the external authentication service. An
 *   example array may look like:
 *   $userinfo = array(
 *     'kind' => 'plus#personOpenIdConnect',
 *     'sub' => '10610823446148356481571'
 *     'name' => 'Some One'
 *     'email' => 'some@one.com',
 *   );
 * @param string $client_info
 *  The name of the OpenID Connect Client being used, e.g. 'google'.
 *
 * @return bool
 *   Return TRUE if user creation may proceed, FALSE otherwise. You may also use
 *   `drupal_set_message()` to present a message to the user as to why their
 *   account was not created.
 */
function hook_openid_connect_allow_user_create($userinfo, $client_name) {
  if ($userinfo['name'] == 'Some One') {
    drupal_set_message('Sorry, Some One is not allowed on this site.', 'error');
    return FALSE;
  }
  return TRUE;
}

/**
 * Perform an action after a successful authorization.
 *
 * @param array $tokens
 *   ID token and access token that we received as a result of the OpenID
 *   Connect flow.
 * @param object $account
 *   The user account that has just been logged in.
 * @param array $userinfo
 *   The user claims returned by the OpenID Connect provider.
 * @param string $client_name
 *   The machine name of the OpenID Connect client plugin.
 */
function hook_openid_connect_post_authorize($tokens, $account, $userinfo, $client_name) {
  drupal_set_message('Welcome back!');
}

/**
 * Alter the list of possible scopes and claims.
 *
 * @see openid_connect_claims
 *
 * @param array &$claims
 */
function hook_openid_connect_claims_alter(array &$claims) {
  $claims['my_custom_claim'] = array(
    'scope' => 'profile',
  );
}

/**
 * Define plugins for OpenID Connect providers.
 *
 * @see openid_connect_openid_connect_plugins();
 */
function hook_openid_connect_plugins() {
  return array(
    'yourservice' => array(
      'title' => t('Your Service'),
      'class' => 'OpenIDConnectClientYourService',
      'file' => 'OpenIDConnectClientYourService.class.php',
      'module' => 'your_module',
    ),
  );
}

/**
 * @} End of "addtogroup hooks".
 */
