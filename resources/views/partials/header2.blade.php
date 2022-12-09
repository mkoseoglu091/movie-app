<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        for(let i=1; i<9; i++){
          $("#dButton" + i).click(function(){
            $('div[id^="detail"]').hide();
            $("#detail" + i).show();
        });
        }
      });
    </script>
  </head>
  <body>
    <div id="container">
        <h1 class="h1 mx-3">@yield("title")</h1>