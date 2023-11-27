<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Email title</title>
</head>

<body class="body" style="margin: 0;">
    <div role="article" aria-roledescription="email" aria-label="email name" lang="en"
        style="font-size:1rem; background-color: #E4E4E4; height: 100%">
        <table role="presentation" align="center" bgcolor="#E4E4E4" border="0" cellpadding="0" cellspacing="0"
            width="100%">
            <tr>
                <td valign="top" style="text-align: center;">
                    <div class="over-mob" style="max-height:0; margin: 0 auto; text-align: center;">
                        <img class="reset" height="300" border="0" alt=""
                            style="width: 100%;vertical-align: middle;background-color:#B17036;" />
                    </div>
                    <img src="<?php echo \Request::root(); ?>/{{ $web_info->detail->image_1->link }}"
                        style="margin-top: 1rem; margin-bottom: 0.5rem" alt="">
                    <table role="presentation" class="faux-absolute reset" align="center" border="0" cellpadding="0"
                        cellspacing="0" width="650" style="position:relative; opacity:0.999;">
                        <tr>
                            <td valign="top">
                                <table role="presentation" style="text-align: left;" class="hero-textbox" border="0"
                                    cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFE" align="center">
                                    <tr>
                                        <td valign="top" style="padding: 10px 40px;">
                                            <h1
                                                style="margin: 0; font-family:sans-serif; font-size:2em; color:#222222; mso-line-height-rule: exactly; line-height: 1.5; text-align:center;">
                                                {{ $book->contentTitle['hvkODllvC4AVOJY'] }}
                                            </h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="padding: 5px 40px;">
                                            <div class="">
                                                <strong
                                                    style="margin: 0; font-family:sans-serif; font-size:1em; color:#222222; mso-line-height-rule: exactly; line-height: 1.5; text-align:center;">{{ $book->contentTitle['ECtxJsVRlvhwWV0'] }}
                                                    {{ $book->firstname . ' ' . $book->surname }}</strong>
                                            </div>
                                            <div class="">
                                                <span
                                                    style="margin: 0; font-family:sans-serif; font-size:1em; color:#222222; mso-line-height-rule: exactly; line-height: 1.5; text-align:center;">
                                                    {{ $book->contentTitle['VPQTHOGuVtZkCNg'] }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="padding: 5px 40px;">
                                            <div class="">
                                                <span
                                                    style="margin: 0; font-family:sans-serif; font-size:1em; color:#222222; mso-line-height-rule: exactly; line-height: 1.5; text-align:center;">
                                                    {{ $book->contentTitle['QKSOpSLNNNfCW3B'] }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="padding: 5px 40px;">
                                            <a href="{{ $web_info->location->google_map->link }}">
                                                <strong
                                                    style="margin: 0; font-family:sans-serif; font-size:1em; color:#222222; mso-line-height-rule: exactly; line-height: 1.5; text-align:center;">{{ $book->contentTitle['siKaFFHb6IYUqmk'] }}</strong>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <table role="presentation"
                                            style="padding: 5px 40px 10px;margin-inline:0;width: 100%;"
                                            class="hero-textbox" border="0" cellpadding="0" cellspacing="0"
                                            width="80%" bgcolor="#FFFFFE" align="center">
                                            <tr>
                                                <td valign="top"
                                                    style="text-align: left; width: 33.33%; padding: 5px; border: 2px solid black;">
                                                    <strong
                                                        style="margin:0;font-family:sans-serif; font-size:1em; color:#222222;line-height: 1.5;">{!! $book->contentTitle['jHO6JuHGtV2uAFC'] !!}</strong>
                                                    <p
                                                        style="text-align: left;margin: 0;font-family:sans-serif; font-size:1em; color:#222222;line-height: 1.5;">
                                                        {{ date('d F Y', strtotime($book->time_booking)) }}</p>
                                                </td>
                                                <td valign="top"
                                                    style="text-align: left; width: 33.33%; padding: 5px; border-top: 2px solid black; border-right: 2px solid black; border-bottom: 2px solid black;">
                                                    <strong
                                                        style="margin:0;font-family:sans-serif; font-size:1em; color:#222222;line-height: 1.5;">{!! $book->contentTitle['UfZDbuMYtfFhUc5'] !!}</strong>
                                                    <p
                                                        style="text-align: left;margin: 0;font-family:sans-serif; font-size:1em; color:#222222;line-height: 1.5;">
                                                        {{ date('H:i', strtotime($book->time_booking)) }}</p>
                                                </td>
                                                <td valign="top"
                                                    style="text-align: left; width: 33.33%; padding: 5px; border-top: 2px solid black; border-right: 2px solid black; border-bottom: 2px solid black;">
                                                    <strong
                                                        style="margin:0;font-family:sans-serif; font-size:1em; color:#222222;line-height: 1.5;">{!! $book->contentTitle['TLOwT0tigVhkOCL'] !!}</strong>
                                                    <p
                                                        style="text-align: left;margin: 0;font-family:sans-serif; font-size:1em; color:#222222;line-height: 1.5;">
                                                        {{ $book->people_number }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table role="presentation"
                                            style="padding: 5px 40px 30px;margin-inline:0;width: 100%"
                                            class="hero-textbox" border="0" cellpadding="0" cellspacing="0"
                                            width="80%" bgcolor="#FFFFFE" align="center">
                                            <tr>
                                                <td valign="top" style="text-align: left; width: 100%">
                                                    <p
                                                        style="text-align: left;margin: 0;font-family:sans-serif; font-size:1em; color:#222222;line-height: 1.5;">
                                                        {!! $book->contentTitle['oDVIjlkRGXNfMG8'] !!}
                                                    </p>
                                                    <p
                                                        style="text-align: left;margin: 0;font-family:sans-serif; font-size:1em; color:#222222;line-height: 2.5;">
                                                        {!! $book->contentTitle['jFbM0f0OXMY9AX7'] !!}
                                                    </p>
                                                    <p
                                                        style="text-align: left;margin: 0;font-family:sans-serif; font-size:1em; color:#222222;line-height: 2.5;">
                                                        {!! $book->contentTitle['JPg2jQwMTEvZjRT'] !!}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table role="presentation" style="padding-bottom: 1rem;margin-top: 1rem;"
                        class="faux-absolute reset" align="center" border="0" cellpadding="0" cellspacing="0"
                        width="650" style="position:relative; opacity:0.999;">
                        <tr>
                            <td valign="top">
                                <table role="presentation" class="hero-textbox" border="0" cellpadding="0"
                                    cellspacing="0" width="80%" align="center">
                                    <tr>
                                        <td valign="top" style="text-align: center;">
                                            <a href="{{ $web_info->contact->link_facebook->link }}"
                                                target="_blank"><img style="color: white;margin-right: 5px;"
                                                    src="<?php echo \Request::root(); ?>/icons/facebook.png" /></a>
                                            <a href="{{ $web_info->contact->link_twitter->link }}"
                                                target="_blank"><img style="color: white;margin-right: 5px;"
                                                    src="<?php echo \Request::root(); ?>/icons/twitter.png" /></a>
                                            <a href="{{ $web_info->contact->link_instagram->link }}"
                                                target="_blank"><img style="color: white;margin-right: 5px;"
                                                    src="<?php echo \Request::root(); ?>/icons/instagram.png" /></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
