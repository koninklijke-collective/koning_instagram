# koning_instagram

This extension provides functionality to embed an Instagram post with a TYPO3 plugin. It makes use of the ``/oembed`` API call as documented [here](https://www.instagram.com/developer/embedding/).

# Setup

- Install the extension
- Include static template ``Koning Instagram`` or include manually

# Usage

Add the plugin element ``Embed Instagram post`` to your page. The following options are available:

- ``Post link``: Link to the post, for example [https://www.instagram.com/p/fA9uwTtkSN/](https://www.instagram.com/p/fA9uwTtkSN/)
- ``Max width``: Maximum width of the returned media, must be greater than 320
- ``Hide caption``: Enable this to hide the caption of the post
- ``Omit script``: Enable this if you want to include the ``embeds.js`` script yourself
- ``Callback``: A JSON callback to be invoked

For more information on these parameters, check the [embed manual](https://www.instagram.com/developer/embedding/)
