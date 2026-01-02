<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bizby</title>
</head>
<body style="margin:0;padding:0;background:#f6f6f6;font-family:Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center" style="padding:24px;">

    <!-- Email Container -->
    <table width="600" cellpadding="0" cellspacing="0"
           style="background:#ffffff;border-radius:6px;overflow:hidden;">

        <!-- Header -->
        <tr>
            <td style="background:#111827;padding:16px 24px;color:#ffffff;">
                <strong style="font-size:18px;">Bizby</strong>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding:24px;">
                @yield('content')
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="padding:16px 24px;font-size:12px;color:#777;background:#f9fafb;">
                © {{ date('Y') }} Bizby. All rights reserved.<br>
                This is an automated message, please do not reply.
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
