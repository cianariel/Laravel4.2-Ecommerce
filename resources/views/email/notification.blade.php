<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ideaing - Email Verification</title>
    <style type="text/css">
        /* Client-specific Styles */
        #outlook a {
            padding: 0;
        }

        /* Force Outlook to provide a "view in browser" menu link. */
        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }

        /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
        .ExternalClass {
            width: 100%;
        }

        /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
            line-height: 100%;
        }

        /* Force Hotmail to display normal line spacing.*/
        #backgroundTable {
            margin: 0;
            padding: 0;
            width: 100% !important;
            line-height: 100% !important;
        }

        img {
            outline: none;
            text-decoration: none;
            border: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        .image_fix {
            display: block;
        }

        p {
            margin: 0px 0px !important;
        }

        table td {
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        a {
            color: #0a8cce;
            text-decoration: none;
            text-decoration: none !important;
        }

        /*STYLES*/
        table[class=full] {
            width: 100%;
            clear: both;
        }

        /*IPAD STYLES*/
        @media only screen and (max-width: 640px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: #0a8cce; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }

            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #0a8cce !important;
                pointer-events: auto;
                cursor: default;
            }

            table[class=devicewidth] {
                width: 440px !important;
                text-align: center !important;
            }

            table[class=devicewidthinner] {
                width: 420px !important;
                text-align: center !important;
            }

            img[class=banner] {
                width: 440px !important;
                height: 220px !important;
            }

            img[class=colimg2] {
                width: 440px !important;
                height: 220px !important;
            }

        }

        /*IPHONE STYLES*/
        @media only screen and (max-width: 480px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: #0a8cce; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }

            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #0a8cce !important;
                pointer-events: auto;
                cursor: default;
            }

            table[class=devicewidth] {
                width: 280px !important;
                text-align: center !important;
            }

            table[class=devicewidthinner] {
                width: 260px !important;
                text-align: center !important;
            }

            img[class=banner] {
                width: 280px !important;
                height: 140px !important;
            }

            img[class=colimg2] {
                width: 280px !important;
                height: 140px !important;
            }

            td[class=mobile-hide] {
                display: none !important;
            }

            td[class="padding-bottom25"] {
                padding-bottom: 25px !important;
            }

        }

        a.fb {
            display: inline-block;
            height: 35px;
            font-size: 1rem;
            border-radius: 30px;
            padding: 0 10px 0 0 !important;
            color: #5C7CBD;
            text-align: center;
        }

        a.insta, a.gplus, a.pint {
            display: inline-block;
            height: 35px;
            font-size: 1rem;
            border-radius: 30px;
            padding: 0 10px 0 0 !important;
            color: #5C7CBD;
            text-align: center;
        }

        a.fb i.m-icon {
            color: white;
            background: #5C7CBD;
            padding: 5px;
            border-radius: 20px;
            padding-top: 7px;
            padding-left: 7px;
            padding-right: 7px;
            padding-bottom: 6px;
            float: left;
        }

        a.twi {
            display: inline-block;
            height: 35px;
            font-size: 1rem;
            border-radius: 30px;
            padding: 0 10px 0 0 !important;
            color: #079DD1;
            text-align: center;
        }

        a.twi i.m-icon {
            color: white;
            background: #079DD1;
            padding: 5px;
            border-radius: 20px;
            padding-top: 7px;
            padding-left: 7px;
            padding-right: 7px;
            padding-bottom: 6px;
            float: left;
        }

        a.likes {
            display: inline-block;
            height: 35px;
            font-size: 1rem;
            border-radius: 30px;
            padding: 0 10px 0 0 !important;
            color: #fa0033;
            text-align: center;
        }

        a.likes i.m-icon {
            color: white;
            background: #fa0033;
            padding: 5px;
            border-radius: 20px;
            padding-top: 7px;
            padding-left: 7px;
            padding-right: 7px;
            padding-bottom: 6px;
            float: left;
        }

        a.discuss {
            display: inline-block;
            height: 35px;
            font-size: 1rem;
            border-radius: 30px;
            padding: 0 10px 0 0 !important;
            color: #dfdfdf;
            text-align: center;
        }

        a.discuss i.m-icon {
            color: white;
            background: #dfdfdf;
            padding: 5px;
            border-radius: 20px;
            padding-top: 7px;
            padding-left: 7px;
            padding-right: 7px;
            padding-bottom: 6px;
            float: left;
        }

    </style>
</head>
<body bgcolor="#ffffff" style="background-color:#ffffff;">
<!-- Start of header -->
<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable"
       st-sortable="header">
    <tbody>
    <tr>
        <td>
            <table width="600" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" border="0" align="center"
                   class="devicewidth">
                <tbody>
                <tr>
                    <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center"
                               class="devicewidth">
                            <tbody>
                            <!-- Spacing -->
                            <tr>
                                <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                    &nbsp;</td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td>
                                    <!-- logo -->
                                    <table width="140" align="center" border="0" cellpadding="0" cellspacing="0"
                                           class="devicewidth">
                                        <tbody>
                                        <tr>
                                            <td width="218" align="center">
                                                <div class="imgpop">
                                                    <a target="_blank" href="#">
                                                        <img src="https://ideaing.com/assets/images/email/common/logo-email.png"
                                                             alt="" border="0" width="169" height="45"
                                                             style="display:block; border:none; outline:none; text-decoration:none;">
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- end of logo -->
                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                    &nbsp;</td>
                            </tr>
                            <!-- Spacing -->
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- End of Header -->
<!-- Start Full Text -->
<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable"
       st-sortable="full-text">
    <tbody>
    <tr>
        <td>
            <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" align="center"
                   class="devicewidth">
                <tbody>
                <tr>
                    <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center"
                               class="devicewidth">
                            <tbody>
                            <!-- Spacing -->
                            <tr>
                                <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                    &nbsp;</td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td>
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0"
                                           class="devicewidthinner">
                                        <tbody>
                                        <tr>
                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #666666; text-align:center; line-height: 30px;"
                                                st-content="fulltext-content">
                                                <p align="left">
                                                    <span style="font-size: 14pt;" class="im"><br><span
                                                                style="font-size: 14pt;">Hi {{$name}} ! You have

                                                            @if($content == 1)
                                                                1 new notification
                                                            @elseif($content != 0)
                                                                {{$content}} new notifications
                                                            @else
                                                                no notification today
                                                            @endif
                                                            on Ideaing.</span><span
                                                                style="font-size: 14pt;">Click<a
                                                                    style="color:rgb(250,0,51);text-decoration:none"
                                                                    href="{{ env('FULL_DOMAIN')}}/user/notification">
                                                                View Your
                                                                Notifications</a> to see what’s happening.</span> </span>
                                                </p>
                                            </td>
                                        </tr>
                                        <!-- End of content -->
                                        <tr>
                                            <table width="250" align="right" border="0" cellpadding="0" cellspacing="0"
                                                   class="devicewidth">
                                                <tbody>
                                                <!-- Spacing -->

                                                <!-- Spacing -->
                                                <tr>
                                                    <td>
                                                        <!-- start of text content table -->
                                                        <table width="600" align="left" border="0" cellpadding="0"
                                                               cellspacing="0" class="devicewidth">
                                                            <tbody>
                                                            <!-- image -->
                                                            <tr>
                                                                <td width="590" height="160" align="center"
                                                                    class="devicewidth">
                                                                    <div style="margin-top: 20px;
                                                                            border-radius:6px;
                                                                            background-color:rgb(255,255,255);
                                                                            border-color: #FA0033 !important;
                                                                            border-style: solid;
                                                                            box-shadow: none !important;
                                                                            min-height:25px;
                                                                            width:150px;text-align: center;
                                                                            width:202px; line-height:50px;">
                                                                        <a style=" color:#FA0033;font-weight: bold;"
                                                                           href="{{ env('FULL_DOMAIN')}}/user/notification">
                                                                            View
                                                                            Your Notifications</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <!-- end of text content table -->
                                                </tbody>
                                            </table>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                    &nbsp;</td>
                            </tr>
                            <!-- Spacing -->
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- end of full text -->

<!-- 2columns -->
<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable"
       st-sortable="2columns">
    <tbody>
    <tr>
        <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                <tbody>
                <tr>
                    <td width="100%">
                        <table bgcolor="#ffffff" width="600" cellpadding="0" cellspacing="0" border="0" align="center"
                               class="devicewidth">
                            <tbody>
                            <tr>
                                <td>
                                    <!-- start of left column -->
                                    <table width="290" align="left" border="0" cellpadding="0" cellspacing="0"
                                           class="devicewidth">
                                        <tbody>

                                        <tr>
                                            <td>
                                                <!-- start of text content table -->
                                                <table width="290" align="left" border="0" cellpadding="0"
                                                       cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                    <tr>
                                                        <td width="290" height="" align="center" class="devicewidth">
                                                            <p style="text-align: center;">
                                                                <a style="text-decoration: none; color: #007baa"
                                                                   href="http://ideaing.com"><img
                                                                            src="https://ideaing.com/assets/images/email/ideaing.png"
                                                                            width="70px"/></a>
                                                                <a style="text-decoration: none; color: #007baa"
                                                                   href="https://ideaing.com/aboutus"><img
                                                                            src="https://ideaing.com/assets/images/email/about.png"
                                                                            width="70px"/></a>
                                                                <a style="text-decoration: none; color: #808080"
                                                                   href="https://ideaing.com/"><img
                                                                            src="https://ideaing.com/assets/images/email/copyright.png"
                                                                            width="100px"/></a>
                                                            </p>

                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- end of text content table -->
                                        </tbody>
                                    </table>
                                    <!-- end of left column -->
                                    <!-- start of right column -->
                                    <table width="290" align="right" border="0" cellpadding="0" cellspacing="0"
                                           class="devicewidth">
                                        <tbody>

                                        <tr>
                                            <td>
                                                <!-- start of text content table -->
                                                <table width="290" align="left" border="0" cellpadding="0"
                                                       cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                    <!-- image -->
                                                    <tr>
                                                        <td width="290" height="" align="center" class="devicewidth">
                                                            <a class="fb"
                                                               href="https://www.facebook.com/ideaingsmarterliving"><img
                                                                        src="https://ideaing.com/assets/images/email/fb.png"/></a>
                                                            <a class="twi" href="https://twitter.com/ideaing/"><img
                                                                        src="https://ideaing.com/assets/images/email/twitter.jpg"/></a>
                                                            <a class="insta"
                                                               href="https://www.instagram.com/ideaing_com/"><img
                                                                        src="https://ideaing.com/assets/images/email/insta.png"/></a>
                                                            <a class="gplus"
                                                               href="http://google.com/+Ideaingsmarterliving"><img
                                                                        src="https://ideaing.com/assets/images/email/gplus.gif"/></a>
                                                            <a class="pint"
                                                               href="https://www.pinterest.com/ideaing_com"><img
                                                                        src="https://ideaing.com/assets/images/email/pint.png"/></a>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <!-- end of right column -->
                                </td>
                            </tr>
                            <tr>
                                <!-- start of text content table -->
                                <table width="600" align="left" border="0" cellpadding="0" height="10px"
                                       cellspacing="0" class="devicewidth">
                                    <tbody>
                                    <!-- image -->
                                    <tr>
                                        <td width="" height="" align="center" class="devicewidth">
                                            <hr/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="" height="" align="center" class="devicewidth"
                                            style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #666666; text-align:center; line-height: 30px;"
                                            st-content="fulltext-content">
                                            <br/>
                                            <i>Copyright © 2016 Idea Centric LLC,</i> All rights reserved.<br/>
                                            You are on this list because you are a subscriber of Ideaing.<br/>
                                            <br/>
                                            <strong>Our mailing address is:</strong><br/>
                                            Idea Centric LLC<br/>
                                            Gramercy<br/>
                                            Irvine, Ca 92614<br/>
                                            <br/>

                                            Don't want to hear from Ideaing?<br/>
                                            You can <a style="text-decoration: none; color: #0a8cce"
                                                       href="https://ideaing.com/unsubscribe">unsubscribe</a> from this list<br/>

                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                                <!-- end of text content table -->
                            </tr>
                            <!-- Spacing -->

                            <!-- Spacing -->
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!-- end of 2 columns -->
</body>
</html>
