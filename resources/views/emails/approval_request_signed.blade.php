<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Dear {{ $approvalRequest->user->name }},</p>

    <p>Your document for {{ $approvalRequest->document_name }} has been signed and is now ready for download.</p>

    {{-- <p>You can download your signed document <a
            href="{{ Storage::url($approvalRequest->signed_document_path) }}">here</a>.</p> --}}

    <p>Anda bisa ke halaman status untuk download file yang sudah di approve</p>

    <p>Thank you.</p>
</body>

</html>
