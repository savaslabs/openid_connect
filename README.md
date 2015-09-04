# OpenID Connect

The OpenID Connect module provides a pluggable client implementation for the
OpenID Connect protocol.

For more information please consult the documentation: https://drupal.org/node/2274339

## Drupal 5 Backport

The Drupal 5.x backport differs in a few ways from the Drupal 7 implementation.

- CTools doesn't exist in Drupal 5, so instead Drupal's hook system provides opportunities for other modules to register
- `hook_username_alter()` doesn't exist in D5, so that functionality is absent from the D5 module
- `tfa` module hasn't been backported to D5. The code referencing it is present in the D5 module, but no guarantees that it would work with a ported TFA module
- The module supports mapping claims for fields added by the core Profile module
