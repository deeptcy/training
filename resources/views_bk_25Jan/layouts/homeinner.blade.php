<!DOCTYPE html>
<html lang="da">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>	{!!$page['pagetitle']!!}</title>
    <meta name="viewport" content="width=device-width">	
	<meta name="title" content ="{!!$page['metaTitle']!!}">
	<meta name="description" content="{!!$page['metaDesc']!!}">
	<meta name="keywords" content="{!!$page['metaKeywords']!!}">
 	<meta name="robots" content="{!!$page['robots']!!}" />
	<link rel="canonical" href="{!!$page['canonical']!!}">	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css?=2') }}">
	
	
	
</head>

@yield('content')

</html>