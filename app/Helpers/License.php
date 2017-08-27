<?php

//remove invisible HTML tags, including invisible text such as style and script code, embedded objects, and others (strip_tags would only remove tags but leave content between them)
function removeInvisibleHtml($content)
    {
	$content=preg_replace(
    array(
        '@<!--[^>]*?.*?-->@siu',
        '@<applet[^>]*?.*?</applet>@siu',
        '@<area[^>]*?.*?</area>@siu',
        '@<audio[^>]*?.*?</audio>@siu',
        '@<button[^>]*?.*?</button>@siu',
        '@<canvas[^>]*?.*?</canvas>@siu',
        '@<datalist[^>]*?.*?</datalist>@siu',
        '@<embed[^>]*?.*?</embed>@siu',
        '@<fieldset[^>]*?.*?</fieldset>@siu',
        '@<form[^>]*?.*?</form>@siu',
        '@<frame[^>]*?.*?</frame>@siu',
        '@<frameset[^>]*?.*?</frameset>@siu',
        '@<head[^>]*?>.*?</head>@siu',
        '@<iframe[^>]*?.*?</iframe>@siu',
        '@<input[^>]*?.*?>@siu',
        '@<keygen[^>]*?.*?</keygen>@siu',
        '@<map[^>]*?.*?</map>@siu',
        '@<noembed[^>]*?.*?</noembed>@siu',
        '@<noframes[^>]*?.*?</noframes>@siu',
        '@<noscript[^>]*?.*?</noscript>@siu',
        '@<object[^>]*?.*?</object>@siu',
        '@<output[^>]*?.*?</output>@siu',
        '@<script[^>]*?.*?</script>@siu',
        '@<select[^>]*?.*?</select>@siu',
        '@<textarea[^>]*?.*?</textarea>@siu',
        '@<track[^>]*?.*?</track>@siu',
        '@<video[^>]*?.*?</video>@siu'
    ),
    array(
        "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""
    ),
    $content); //remove invisible/dangerous tags (and content between them) that should never be used in any string ()

	return trim($content); //return clean content
    }
