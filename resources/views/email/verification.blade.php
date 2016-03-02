<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ideaing - Email Notification</title>
    <link rel="stylesheet" href="/assets/fonts/ideaing/style.css">
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
            margin: 0 auto;
            padding: 0;
            line-height: 100% !important;

        }
        #backgroundTable span{
            color:grey;
        }
        #backgroundTableHeader{
            margin: 0 auto;
            padding: 0;
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
    a.fb {
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
      float: left; }
   
  a.twi {
    display: inline-block;
    height: 35px;
    font-size: 1rem;
    border-radius: 30px;
    padding: 0 10px 0 0 !important;
    color: #079DD1;
    text-align: center;}
    a.twi i.m-icon {
      color: white;
      background: #079DD1;
      padding: 5px;
      border-radius: 20px;
      padding-top: 7px;
      padding-left: 7px;
      padding-right: 7px;
      padding-bottom: 6px;
      float: left; }

a.likes {
    display: inline-block;
    height: 35px;
    font-size: 1rem;
    border-radius: 30px;
    padding: 0 10px 0 0 !important;
    color: #fa0033;
    text-align: center;}
    a.likes i.m-icon {
      color: white;
      background: #fa0033;
      padding: 5px;
      border-radius: 20px;
      padding-top: 7px;
      padding-left: 7px;
      padding-right: 7px;
      padding-bottom: 6px;
      float: left; }
      a.discuss {
    display: inline-block;
    height: 35px;
    font-size: 1rem;
    border-radius: 30px;
    padding: 0 10px 0 0 !important;
    color: #dfdfdf;
    text-align: center;}
    a.discuss i.m-icon {
      color: white;
      background: #dfdfdf;
      padding: 5px;
      border-radius: 20px;
      padding-top: 7px;
      padding-left: 7px;
      padding-right: 7px;
      padding-bottom: 6px;
      float: left; }

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

        }
    </style>

</head>
<body bgcolor="#EBEBEB" style="background-color:#EBEBEB;">
<table id="backgroundTableHeader" st-sortable="header" bgcolor="#EBEBEB" border="0" cellpadding="0" cellspacing="0"
       width="600px">
    <tbody>
    <tr>
        <td>
            <table hasbackground="true" class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0"
                   width="600">
                <tbody>
                <tr>
                    <td width="100%">
                        <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0"
                               width="600">
                            <tbody>
                            <!-- Spacing -->
                            <tr>
                                <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">
                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td>
                                    <!-- logo -->

                                    <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0"
                                           width="140">
                                        <tbody>
                                        <tr>
                                            <td height="" align="center" width="218">
                                                <div class="imgpop">
                                                    <a href="#"><img id="kgva7ywpd3"
                                                                     src="http://ideaing.com/assets/images/email/common/logo-email.png"
                                                                     st-image="logo" alt=""
                                                                     style="display:block; border:none; outline:none; text-decoration:none;"
                                                                     height="" border="0" width="218"></a>
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
                                <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">
                                </td>
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
<table id="backgroundTable" st-sortable="header" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0"
       width="600px">
    <tbody>
    
    <tr>
        <td>
            <table hasbackground="true" class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0"
                   width="600">
                <tbody>
                <tr>
                    <td width="100%">
                        <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0"
                               width="600">
                            <tbody>
                            <!-- Spacing -->
                            <tr>
                                <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">
                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td>
                                    <table class="devicewidthinner" align="center" border="0" cellpadding="0"
                                           cellspacing="0" width="500">
                                        <tbody>
                                        <!-- Title -->
                                        <tr>
                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 30px; color: #333333; text-align:center; line-height: 30px;"
                                                st-title="fulltext-heading">
                                                <p align="left">
                                                    <span style="font-size: 14pt;" class="im"><span style="font-size: 14pt;">Hi {{ $name }}
                                                            ,</span><br><br><span style="font-size: 14pt;">You are just one step away.</span><span
                                                                style="font-size: 14pt;"><a
                                                                    style="color:rgb(250,0,51);text-decoration:none"
                                                                    href="{{ url('/verify-email').'/'.$link}}"> Click confirm</a> and join the ideaing family.</span> </span>
                                                </p>
                                            </td>
                                        </tr>
                                        <!-- End of Title --><!-- spacing -->
                                        <tr>
                                            <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;"
                                                height="20" width="100%">
                                            </td>
                                        </tr>
                                        <!-- End of spacing --><!-- content -->
                                        <tr>
                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #666666; text-align:center; line-height: 30px;"
                                                st-content="fulltext-content">
                                                <p>
                                                </p>
                                            </td>
                                        </tr>
                                        <!-- End of content -->
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;" height="20">
                                </td>
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
    <tr>
        <td>
            <table hasbackground="true" class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0"
                   width="500">
                <tbody>
                <tr>
                    <td width="100%">
                        <table class="devicewidth" align="center" bgcolor="#ffffff" border="0" cellpadding="0"
                               cellspacing="0" width="500">
                            <tbody>
                            <tr>
                                <td>
                                    <!-- start of left column -->

                                    <table class="devicewidth" align="left" border="0" cellpadding="0" cellspacing="0"
                                           width="300">
                                        <tbody>
                                        <!-- Spacing -->
                                        <tr>
                                            <td height="20" width="100%">
                                            </td>
                                        </tr>
                                        <!-- Spacing -->
                                        <tr>
                                            <td>
                                                <!-- start of text content table -->

                                                <table class="devicewidth" align="left" border="0" cellpadding="0"
                                                       cellspacing="0" width="">
                                                    <tbody>
                                                    <!-- image -->
                                                    <tr>
                                                        <td class="devicewidth" height="" align="center" width="">
                                                            <div class="imgpop">
                                                                <img id="diasbyt3mu"
                                                                     src="http://ideaing.com/assets/images/email/common/graphic-800x279.png"
                                                                     alt="" st-image="ipad"
                                                                     style="display:block; border:none; outline:none; text-decoration:none;"
                                                                     class="colimg2" height="" border="0"
                                                                     width="250">
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
                                    <!-- end of left column --><!-- start of right column -->
                                    <table class="devicewidth" align="right" border="0" cellpadding="0" cellspacing="0"
                                           width="200">
                                        <tbody>
                                        <!-- Spacing -->
                                        <tr>
                                            <td height="20" width="100%">
                                            </td>
                                        </tr>
                                        <!-- Spacing -->
                                        <tr>
                                            <td>
                                                <!-- start of text content table -->

                                                <table class="devicewidth" align="left" border="0" cellpadding="0"
                                                       cellspacing="0" width="">
                                                    <tbody>
                                                    <!-- image -->
                                                    <tr>
                                                        <td class="devicewidth" align="center" width="">
                                                            <div class="imgpop" style="margin-top: 20px;border-radius:6px;background-color:rgb(250,0,51);min-height:25px;width:150px;text-align: center; line-height:50px;">
                                                                <a style=" color:white;font-weight: bold;" href="{{ url('/verify-email').'/'.$link}}"> Get Started</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Content -->

                                                    <!-- end of Content --><!-- end of content -->
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- end of text content table -->
                                        </tbody>
                                    </table>
                                    <!-- end of right column -->
                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td height="10" width="100%">
                                </td>
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
    <tr>
        <td>
            <table hasbackground="true" class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0"
                   width="600">
                <tbody>
                <tr>
                    <td style="font-size:1px; line-height:1px;" height="30" align="center">
                    </td>
                </tr>
                <tr>
                    <td style="font-size:1px; line-height:1px;" height="1" align="center" bgcolor="#d1d1d1" width="550">
                    </td>
                </tr>
                <tr>
                    <td style="font-size:1px; line-height:1px;" height="30" align="center">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table hasbackground="true" class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0"
                   width="600">
                <tbody>
                <tr>
                    <td width="100%">
                        <table class="devicewidth" align="center" border="0" cellpadding="0" cellspacing="0"
                               width="600">
                            <tbody>
                            <tr>
                                <td width="400px" style="font-family: ideaing; font-size: 14px;color: #666666"
                                    st-content="postfooter" align="center" valign="middle">
                                    <p style="text-align: center;">
                                        <a style="text-decoration: none; color: #007baa"
                                                         href="http://ideaing.com">Ideaing</a>
                                        <a style="text-decoration: none; color: #007baa"
                                         href="http://ideaing.com/unsubscribe">About</a>
                                         <a style="text-decoration: none; color: #808080"
                                         href="http://ideaing.com/unsubscribe">Ideaing</a>
                                    </p>
                                </td>
                                <td>
                                    <a class="fb" href="#"><i class="m-icon m-icon--facebook-id"></i></a>
                                    <a class="twi" href="#"><i class="m-icon  m-icon--twitter-id"></i></a>
                                    <a class="likes" href="#"><i class="m-icon m-icon--heart-solid"></i></a>
                                    <a class="discuss" href="#"><i class="m-icon m-icon--discuss-active"></i></a>
                                </td>
                            </tr>
                            <!-- Spacing -->
                            <tr>
                                <td height="20" width="400px">
                                </td>
                                <td></td>
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
</body>
</html>

