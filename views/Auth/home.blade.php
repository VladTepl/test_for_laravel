<!DOCTYPE html>
<html>
	<head>
		<title>{{$title}}</title>
		
<style>

div.container4 form {
    margin: 0;
    
    position: absolute;
    top: 20%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%) }
	

	
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #00CCFF;
	 width: 10%;
	 align: center;}

input[type=text], input[type=password], input[type=email] {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #00CCFF;
    box-sizing: border-box;
}

button {
    background-color: #00CCFF;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}
}

		</style>

		
	</head>
<body>

			
		@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
	<p>Здравствуйте @php print Auth::user()->name @endphp ! Вы вошли в систему и находитесь на домашней странице.</P>		

<form action="/logout" method="">
  @csrf

  <div class="container">
    
  

    <button type="submit">Выйти из системы</button>
    
  </div>
</form>

</body>
</html>