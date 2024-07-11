<!DOCTYPE html>
<html>
<head>
    <title>Multi Language Website with Laravel 9</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center">
        <h2>Multi Language Website with Laravel 9</h2>
        <hr>
        <div class="row">
         <div class="col-md-3"></div>
            <div class="col-md-6">
                <strong>Select Language: </strong>
                <select class="form-control lang-change">
                    <option value="en" {{ session()->get('lang_code')=='en' ? 'selected' : ''}}>English</option>
                    <option value="ur" {{ session()->get('lang_code')=='ur' ? 'selected' : ''}}>Urdu</option>
                </select>
            </div>
        </div>
        <h4 class="mt-5">{{ __('text.content') }}</h4>
    </div>
</body>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
 
  var url = "{{ route('lang.change') }}";

    $('.lang-change').change(function(){
     let lang_code = $(this).val();
      window.location.href = url + "?lang="+ lang_code;
    });

</script>
</html>