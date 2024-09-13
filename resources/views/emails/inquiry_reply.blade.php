<!DOCTYPE html>
<html>
<head>
    <title>Reply to Your Inquiry</title>
</head>
<body>
    
    <h3>Thank you for your inquiry.</h3>
    <p>Dear {{ $inquiry->name }},</p>
    <blockquote>
        {{ $reply }}
    </blockquote>
    <p>Best regards,<br>WOODLAK Customer Support Team</p>
</body>
</html>