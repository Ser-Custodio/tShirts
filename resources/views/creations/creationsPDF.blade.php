<!doctype html>
<html lang="en">
<style>
    @page{
        header: page-header;
        footer: page-footer;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="align-items: center; text-align: center;">
<htmlpageheader name="page-header">
    <h1 style="text-align: center;">{{ $title }}</h1>
</htmlpageheader>
<br><br><br><br>
<table style="text-align: center; align-items: center;">
    <tr>
        <td>Creation</td>
        <td>Date of Creation</td>
    </tr>
    @foreach($creations as $creation)
        <tr>
            <td>
                <img src="{{ public_path("storage/creations/".$creation->id.".png") }}" style="width: 200px"><br>
            </td>
            <td>{{ $creation->created_at }}</td>
        </tr>
    @endforeach
</table>
<htmlpagefooter name="page-footer">
{PAGENO}
</htmlpagefooter>
</body>
</html>
