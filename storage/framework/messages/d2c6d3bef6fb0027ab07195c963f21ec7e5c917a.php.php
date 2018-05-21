<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
        html {
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }

        @media    only screen and (max-device-width: 680px), only screen and (max-width: 680px) {
            *[class="table_width_100"] {
                width: 96% !important;
            }

            *[class="border-right_mob"] {
                border-right: 1px solid #dddddd;
            }

            *[class="mob_100"] {
                width: 100% !important;
            }

            *[class="mob_center"] {
                text-align: center !important;
            }

            *[class="mob_center_bl"] {
                float: none !important;
                display: block !important;
                margin: 0px auto;
            }

            .iage_footer a {
                text-decoration: none;
                color: #929ca8;
            }

            img.mob_display_none {
                width: 0px !important;
                height: 0px !important;
                display: none !important;
            }

            img.mob_width_50 {
                width: 40% !important;
                height: auto !important;
            }
        }

        .table_width_100 {
            width: 680px;
        }
    </style>
</head>
<body style="padding: 0px; margin: 0px;">
<div id="mailsub" class="notification" align="center">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;">
        <tr>
            <td align="center" bgcolor="#eff3f8">
                <table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%"
                       style="max-width: 680px; min-width: 300px;">
                    <tr>
                        <td align="center" bgcolor="#f9fafc">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#ffffff">
                            <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <div style="height: 100px; line-height: 100px; font-size: 10px;">&nbsp;</div>
                                        <div style="line-height: 44px;">

                                            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e;">
                                                <?php echo $__env->yieldContent('title'); ?>
                                            </span>
                                        </div>
                                        <div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <div style="line-height: 30px;">
                                            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 17px; color: #4db3a4;">
                                                <?php echo $__env->yieldContent('subtitle'); ?>
                                            </span>
                                        </div>
                                        <div style="height: 35px; line-height: 35px; font-size: 10px;">&nbsp;</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table width="80%" align="center" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center">
                                                    <div style="line-height: 24px;">
                                                        <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                                                              <?php echo $__env->yieldContent('content'); ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div style="height: 45px; line-height: 45px; font-size: 10px;">&nbsp;</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <div style="line-height:24px;">
                                            <?php echo $__env->yieldContent('button'); ?>
                                        </div>
                                        <div style="height: 100px; line-height: 100px; font-size: 10px;">&nbsp;</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                                            <?php echo $__env->yieldContent('footer'); ?>
									    </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#f9fafc">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center">
                                        <div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
                                        <table width="80%" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" valign="middle"
                                                    style="font-size: 12px; line-height:22px;">
                                                    <span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #5b9bd1;">

                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
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