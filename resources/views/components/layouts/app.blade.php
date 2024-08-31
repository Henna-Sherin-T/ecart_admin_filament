<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body> 

@if(auth()->user())
<h1>heyy {{auth()->user()?->name}}</h1>
@endif
  {{ $slot }}
</body>
</html>