# Plex Information

_Documentation updated: 2020-12-29_

## Plex Server IP Address
The IP address of your Plex server on your network.

    10.0.0.50

## Plex Token
<a href="https://support.plex.tv/articles/204059436-finding-an-authentication-token-x-plex-token"> Plex Documentation: Finding an authentication token / X-Plex-Token </a>

### Finding the Token
Finding a temporary token is pretty simple:
1. <a href="https://support.plex.tv/articles/200933616-plex-account/">Sign in to your Plex account</a> in the Plex Web App
2. Browse to a library item and <a href="https://support.plex.tv/articles/201998867-investigate-media-information-and-formats/">view XML</a> for it
3. Look in the URL and find the token as the <code>X-Plex-Token</code> value
<p>

![](xml_info_token.png)

## Plex Server Direct
If you would like to us SSL for the connection to your Plex server then you will need to select the Plex SSL option and provide the "secure" URL to the Plex server.

Open Plex in a web browser and navigate any media file and select "Get Info".  Once in the Media Info page, select "View XML" in the lower left of the page.  Once the XML page is opened, review the URL within the address bar and the value will be formatted as such below.

1. <a href="https://support.plex.tv/articles/200933616-plex-account/">Sign in to your Plex account</a> in the Plex Web App
2. Browse to a library item and <a href="https://support.plex.tv/articles/201998867-investigate-media-information-and-formats/">view XML</a> for it
<p>
    
    https://10-0-0-50.985e1d4de4ed407fb5a7dd4950005f6c.plex.direct:32400

The value we require is the "https://<code>10-0-0-50.985e1d4de4ed407fb5a7dd4950005f6c.plex.direct</code>:32400".

## Plex Movie Selection(s)
Currently this must be a numeric value (Comma Separated with no Spaces).

1. <a href="https://support.plex.tv/articles/200933616-plex-account/">Sign in to your Plex account</a> in the Plex Web App
2. Browse to a library
3. Look in the URL and find the library ID as the <code>source</code> value
<p>

    ...=list&context=content.library&source=4

The value we require is the "...source=<code>4</code>".