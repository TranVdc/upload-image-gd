<html>
<head>
	<title>Laravel5.4 - Image upload with validation</title>
	<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="content">
			<h1>File Upload</h1>
			<form action="{{ URL::to('upload') }}" method="post" enctype="multipart/form-data">
				<label>Select image to upload:</label>
				<input type="hidden" value="{{ csrf_token() }}" name="_token">
				<input type="file" name="image" id="file">
				@if ($errors->has('image'))
	            	<span class="help-block">
	                	<strong>{{ $errors->first('image') }}</strong>
	            	</span>
	        	@endif
				<input type="submit" value="Upload" name="submit">
			</form>
		</div>
	</div>
</body>
</html>