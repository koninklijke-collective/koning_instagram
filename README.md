# Documentation

This extension provides functionality to view Instagram images on your website. It features:

- A backend module to handle authorization
- Storing multiple credentials
- Listing Instagram images filtered by tag
- Easily override the template

# Instagram client setup

The Instagram client setup process consists of the following steps:

- Register for Instagram at [https://www.instagram.com/developer/register/](https://www.instagram.com/developer/register/) if you haven't already
- Add a new client at [https://www.instagram.com/developer/clients/register/](https://www.instagram.com/developer/clients/register/). The redirect URI's fields must contain: ```https://www.yourwebsite.com/?type=type=46782``

# TYPO3 setup

The TYPO3 setup process consists of the following steps:

- Install the extension
- Install guzzle using composer (``composer require guzzlehttp/guzzle``) or include it manually
- Configure the extension in the Extension Manager

**Extension Manager setup**

- ``instagram.baseUrl``: should be ``https://api.instagram.com/``
- ``instagram.clientId``: retrieve the client id from the Instagram client at [https://www.instagram.com/developer/clients/manage/](https://www.instagram.com/developer/clients/manage/)
- ``instagram.clientSecret``: retrieve the client secret from the Instagram client at [https://www.instagram.com/developer/clients/manage/](https://www.instagram.com/developer/clients/manage/)
- ``instagram.redirectUri``: the redirect uri needs to be the same as in the Instagram client and should end with ``?type=46782```

**Credential**

After setting everything up, it's time to add a credential. Use the Instagram / Admin backend module to do so. When successfull, a ``Credential`` record will be added on page 0. On failure, check the error message and review the setup steps.

# Frontend

Add the ``Instagram content`` plugin and select your credential. Add a tag you want to filter images on (mandatory) and specify a limit.

**Override the template**

You can override the template by using standard TypoScript:

    module.tx_koninginstagram {
        view {
            templateRootPaths {
                5 = EXT:your_extension/Resources/Private/Templates
                10 = EXT:koning_instagram/Resources/Private/Templates

            }
            partialRootPaths {
                5 = EXT:your_extension/Resources/Private/Partials
                10 = EXT:koning_instagram/Resources/Private/Partials
            }
            layoutRootPaths {
                5 = EXT:your_extension/Resources/Private/Layouts
                10 = EXT:koning_instagram/Resources/Private/Layouts
            }
        }
    }

# I can't see any images?

Your Instagram client is probably in Sandbox mode. Read more at [https://www.instagram.com/developer/sandbox/](https://www.instagram.com/developer/sandbox/)